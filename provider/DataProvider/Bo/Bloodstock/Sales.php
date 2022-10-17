<?php

namespace Api\DataProvider\Bo\Bloodstock;

use Api\Constants\Horses as Constants;
use Api\Input\Request\Horses\Bloodstock\Sales as Request;
use Api\DataProvider\HorsesDataProvider;
use Phalcon\DI;

/**
 * Class Sales
 *
 * @package Api\DataProvider\Bo\Bloodstock
 */
class Sales extends HorsesDataProvider
{
    /**
     * @param Request\UpcomingNames $request
     *
     * @return array
     */
    public function getUpcomingNames(Request\UpcomingNames $request)
    {
        $sql = "
            SELECT
                horse_name = bs.horse_name
                , h.horse_uid
                , bs.sire_uid
                , sire_name = bs.sire_name
                , bs.dam_uid
                , dam_name = bs.dam_name
                , damsire_uid = ds.horse_uid
                , damsire_name = bs.sire_of_dam_name
                , vendor_name = bs.seller_name
            FROM
                bloodstock_sale_date bsd
                INNER JOIN venue v ON bsd.venue_uid = v.venue_uid
                INNER JOIN bloodstock_sale bs ON bs.sale_date = bsd.sale_date AND bs.venue_uid = bsd.venue_uid
                LEFT JOIN
                    horse h ON h.horse_name = UPPER(bs.horse_name)
                    AND h.country_origin_code = bs.horse_country_origin_code
                LEFT JOIN horse d ON d.horse_uid = bs.dam_uid
                LEFT JOIN horse ds ON ds.horse_uid = d.sire_uid
                %s
            WHERE
                bs.sale_date BETWEEN :dateFrom AND :dateTo
                AND %s
        ";

        list($sql, $params) = $this->getUpcomingSalesWhere($sql, $request);

        $result = $this->query(
            $sql,
            array_merge(
                [
                    'dateFrom' => $request->getDateFrom(),
                    'dateTo' => $request->getDateTo()
                ],
                $params
            )
        );
        return $result->toArrayWithRows();
    }

    /**
     * @param string                $sql
     * @param Request\UpcomingSales $request
     *
     * @return array
     */
    private function getUpcomingSalesWhere($sql, Request\UpcomingSales $request)
    {
        $join = [];
        $where = [];
        $params = [];

        if (!$request->getSalesAll() && $request->getSales()) {
            $salesWhere = [];

            $sales = $request->getSales();
            $count = count($sales);
            for ($i = 0; $i < $count; $i++) {
                list($saleDate, $venueId) = explode('_', $sales[$i]);

                $dateFrom = $this->getSaleStartDate($venueId, $saleDate);
                $dateTo = $this->getSaleEndDate($venueId, $saleDate);

                if ($dateFrom == $dateTo) {
                    $salesWhere[] = "(bs.sale_date = :dateFromSales{$i}: AND bs.venue_uid = :venueSalesId{$i}:)";
                } else {
                    $salesWhere[] = "(bs.sale_date BETWEEN :dateFromSales{$i}: AND :dateToSales{$i}: AND bs.venue_uid = :venueSalesId{$i}:)";
                    $params['dateToSales' . $i] = $dateTo;
                }
                $params['dateFromSales' . $i] = $dateFrom;
                $params['venueSalesId' . $i] = (int)$venueId;
            }

            if ($salesWhere) {
                $where[] = '(' . implode(' OR ', $salesWhere) . ')';
            }
        }

        if (!empty($request->getLotNo())) {
            $where[] = 'bs.lot_no = :lotNo:';
            $params['lotNo'] = $request->getLotNo();
        }

        if (!empty($request->getLotLetter())) {
            $where[] = 'bs.lot_letter = :lotLetter:';
            $params['lotLetter'] = $request->getLotLetter();
        }

        if (!empty($request->getName())) {
            $where[] = "UPPER(bs.horse_name) LIKE '%'+UPPER(:horseName:)+'%'";
            $params['horseName'] = $request->getName();
        }

        if (!empty($request->getSire())) {
            $where[] = "UPPER(bs.sire_name) LIKE '%'+UPPER(:sireName:)+'%'";
            $params['sireName'] = $request->getSire();
        }

        if (!empty($request->getDam())) {
            $where[] = "UPPER(bs.dam_name) LIKE '%'+UPPER(:damName:)+'%'";
            $params['damName'] = $request->getDam();
        }

        if (!empty($request->getDamSire())) {
            $where[] = "UPPER(bs.sire_of_dam_name) LIKE '%'+UPPER(:damSireName:)+'%'";
            $params['damSireName'] = $request->getDamSire();
        }

        if (!empty($request->getSex())) {
            $where[] = "bs.horse_sex = :sex:";
            $params['sex'] = $request->getSex();
        }

        if ($request->isParameterSet('age')) {
            $age = $request->getAge();
            $where[] = 'bs.horse_age'
                . ((strpos($age, '+') > 0) ? '>=' : '=')
                . ':age:';
            $params['age'] = intval($age);
        }

        if (!empty($request->getVendor())) {
            $where[] = "UPPER(bs.seller_name) LIKE '%'+UPPER(:vendor:)+'%'";
            $params['vendor'] = $request->getVendor();
        }

        if (!empty($request->getWithEntries())) {
            $where[] = "
            EXISTS (
                SELECT
                    ri.race_instance_uid
                FROM
                    horse sire, horse dam, horse h, pre_horse_race hr, race_instance ri, course c
                WHERE
                    sire.searchname = UPPER(STR_REPLACE(STR_REPLACE(bs.sire_name, ' ', null), '''', null)) AND
                    sire.country_origin_code  = bs.sire_country_origin_code AND
                    dam.searchname  = UPPER(STR_REPLACE(STR_REPLACE(bs.dam_name, ' ', null), '''', null)) AND
                    dam.country_origin_code   = bs.dam_country_origin_code AND
                    YEAR(h.horse_date_of_birth) = YEAR(bs.sale_date) - bs.horse_age AND
                    h.dam_uid  = dam.horse_uid AND
                    h.sire_uid = sire.horse_uid AND
                    hr.horse_uid = h.horse_uid AND
                    ri.race_instance_uid = hr.race_instance_uid AND
                    ri.race_status_code  = hr.race_status_code AND
                    ri.race_type_code != " . Constants::RACE_TYPE_P2P . " AND
                    c.course_uid = ri.course_uid
            )";
        }

        if (!empty($request->getRegId())) {
            $ugcDb = DI::getDefault()->getShared('selectors')->getDb()->getUgcDb();
            $join [] = "INNER JOIN {$ugcDb}..reg_bs_sale_shortlist rbss
                    ON bs.venue_uid = rbss.venue_uid
                        AND bs.sale_date = rbss.sale_date
                        AND bs.lot_no = rbss.lot_no
                        AND bs.lot_letter = rbss.lot_letter
                    ";
            $where [] = 'rbss.reg_uid = :reg_uid:';
            $params['reg_uid'] = $request->getRegId();
        }

        if (!empty($request->getDateFrom()) && !empty($request->getDateTo())) {
            $params['dateFrom'] = $request->getDateFrom();
            $params['dateTo'] = $request->getDateTo();
            $where[] = 'bs.sale_date BETWEEN :dateFrom: AND :dateTo';
        }

        if (!empty($request->getVenueId())) {
            $where [] = 'bs.venue_uid = :venueId:';
            $params['venueId'] = $request->getVenueId();
        }

        return [
            sprintf(
                $sql,
                empty($join) ? '' : implode(' ', $join),
                empty($where) ? ' 1=1 ' : implode(' AND ', $where)
            ),
            $params
        ];
    }

    /**
     * @param int    $venueId
     * @param string $saleDate
     *
     * @return string
     */
    private function getSaleStartDate($venueId, $saleDate)
    {
        $saleDate = (new \DateTime($saleDate))->setTime(0, 0, 0);
        $startDate = (clone $saleDate);
        $startDate->sub(new \DateInterval('P20D'));

        $rtn = $this->getEntries($venueId, $startDate, $saleDate);
        $entities = $this->getSortedEntities($rtn);
        $saleDate = $this->calculateSaleDate($saleDate, $entities, true);

        return $saleDate->format('Y-m-d H:i:s');
    }

    /**
     * @param int    $venueId
     * @param string $dateFrom
     * @param string $dateTo
     *
     * @return array
     *
     */
    private function getEntries($venueId, $dateFrom, $dateTo)
    {
        $sql = "
            SELECT
                bsd.sale_date,
                bsd.venue_uid,
                sale_name = (
                    CASE
                        WHEN bsd.sale_name IS NULL OR bsd.sale_name = ''
                        THEN v.venue_desc ELSE bsd.sale_name
                    END
                )
            FROM
                bloodstock_sale_date bsd
                INNER JOIN venue v ON (bsd.venue_uid = v.venue_uid)
            WHERE
                bsd.sale_date BETWEEN :dateFrom AND :dateTo
                AND bsd.venue_uid = :venueId
            ORDER BY bsd.sale_date
        ";

        $result = $this->query($sql, [
            'dateFrom' => $dateFrom->format('Y-m-d H:i:s'),
            'dateTo' => $dateTo->format('Y-m-d H:i:s'),
            'venueId' => (int)$venueId,
        ]);

        return $result->toArrayWithRows();
    }

    /**
     * @param $rows
     *
     * @return array
     */
    private function getSortedEntities($rows)
    {
        $entities = [];

        foreach ($rows as $entity) {
            $key = $entity->venue_uid . ' - ' . $entity->sale_name;

            if (array_key_exists($key, $entities)) {
                foreach ($entities[$key] as &$value) {
                    if ($this->checkDate($value['endDate'], $entity->sale_date)) {
                        $value['endDate'] = $entity->sale_date;
                    }
                }
                unset($value);
            } else {
                $entities[$key][] = [
                    'startDate' => $entity->sale_date,
                    'endDate' => $entity->sale_date
                ];
            }
        }
        return $entities;
    }

    /**
     * @param $baseDate
     * @param $newDate
     *
     * @return bool
     */
    private function checkDate($baseDate, $newDate)
    {
        $base = new \DateTime($baseDate);
        $new = new \DateTime($newDate);

        return $base->add(new \DateInterval('P1D')) == $new;
    }

    /**
     * @param $saleDate
     * @param $entities
     * @param $fromStart
     *
     * @return \DateTime
     */
    private function calculateSaleDate($saleDate, $entities, $fromStart)
    {
        foreach ($entities as $sales) {
            foreach ($sales as $sale) {
                $startDate = new \DateTime($sale['startDate']);
                $endDate = new \DateTime($sale['endDate']);
                if ($saleDate >= $startDate && $saleDate <= $endDate) {
                    return $fromStart
                        ? $startDate
                        : $endDate;
                }
            }
        }
        return $saleDate;
    }

    /**
     * @param $venueId
     * @param $saleDate
     *
     * @return string
     */
    private function getSaleEndDate($venueId, $saleDate)
    {
        $saleDate = (new \DateTime($saleDate))->setTime(0, 0, 0);
        $endDate = (clone $saleDate);
        $endDate->add(new \DateInterval('P20D'));

        $rtn = $this->getEntries($venueId, $saleDate, $endDate);
        $entities = $this->getSortedEntities($rtn);
        $saleDate = $this->calculateSaleDate($saleDate, $entities, false);

        return $saleDate->format('Y-m-d H:i:s');
    }

    /**
     * @param Request\SalesResults $request
     *
     * @return array
     */
    public function getSalesResults(Request\SalesResults $request)
    {
        $selectors = $this->getDI()->getShared('selectors');
        $currencySqlCriteria = $selectors->getCurrencySqlCriteria();

        $sql = "
        SELECT
            h.horse_uid
            , horse_name = CASE WHEN h.horse_name IS NOT NULL THEN h.horse_name ELSE bs.horse_name END
            , horse_style_name = h.style_name
            , dam_date_of_birth = d.horse_date_of_birth
            , dam_style_name = d.style_name
            , sire_style_name = s.style_name
            , sire_of_dam_style_name = sd.style_name
            , bs.horse_country_origin_code
            , bs.horse_first_colour_code
            , bs.horse_sex
            , bs.horse_age
            , bs.sire_uid
            , bs.sire_name
            , bs.sire_country_origin_code
            , bs.dam_uid
            , bs.dam_name
            , bs.dam_country_origin_code
            , sire_of_dam_uid = sd.horse_uid
            , bs.sire_of_dam_name
            , bs.sire_of_dam_ctry_org_code
            , v.venue_desc
            , v.venue_uid
            , sale_name = (CASE WHEN bsd.sale_name IS NULL OR bsd.sale_name = '' THEN v.venue_desc ELSE bsd.sale_name END)
            , bsd.sale_date
            , bs.seller_name
            , bs.catalogue_pedigree_pdf_url
            , bs.lot_no
            , bs.lot_letter
            , bs.price
            , lot_price = (CASE WHEN cc.exchange_rate IS NOT NULL THEN bs.price / cc.exchange_rate ELSE bs.price END)
            , currency = c.cur_code
            , bs.buyer_detail
            , yob = year(bs.sale_date) - bs.horse_age
            , bs.sirecam_video_html
            , entered = CASE WHEN EXISTS (SELECT
                1
            FROM race_instance ri
            JOIN pre_horse_race phr ON ri.race_instance_uid = phr.race_instance_uid
              AND  phr.race_status_code = ri.race_status_code
            WHERE
                ri.race_datetime >= CONVERT(DATETIME, CONVERT(DATE, GETDATE()))
                AND phr.horse_uid = h.horse_uid
                AND ri.race_type_code != (" . Constants::RACE_TYPE_P2P . ")
            ) THEN 'Y' ELSE 'N' END
            , entered_races = NULL
        FROM
            bloodstock_sale_date bsd
            JOIN venue v ON bsd.venue_uid = v.venue_uid
            JOIN bloodstock_sale bs ON bs.sale_date = bsd.sale_date AND bs.venue_uid = bsd.venue_uid
            LEFT JOIN horse h ON h.sire_uid = bs.sire_uid AND h.dam_uid = bs.dam_uid
                AND bs.horse_age = YEAR(bs.sale_date) - YEAR(h.horse_date_of_birth)
                AND 1 = (SELECT COUNT(h1.horse_uid) FROM horse h1 WHERE h1.horse_uid = h.horse_uid)
            JOIN currencies c ON c.cur_code = {$currencySqlCriteria}
             LEFT JOIN country_currencies cc ON cc.cur_uid = c.cur_uid AND cc.year = YEAR(bs.sale_date)
             LEFT JOIN horse d ON d.horse_uid = bs.dam_uid
             LEFT JOIN horse sd ON sd.horse_uid = d.sire_uid
             LEFT JOIN horse s ON s.horse_uid = bs.sire_uid
             %s
        WHERE
            %s
        ORDER BY
            2 DESC, bs.lot_no
        PLAN '(use optgoal allrows_dss)(use merge_join off)(nl_join (i_scan bs)(i_scan bsd))'    
        ";

        list($sql, $params) = $this->getSalesResultsWhere($sql, $request);

        $result = $this->query(
            $sql,
            $params
        );

        return $result->toArrayWithRows();
    }

    /**
     * @param                      $sql
     * @param Request\SalesResults $request
     *
     * @return array
     */
    private function getSalesResultsWhere($sql, Request\SalesResults $request)
    {
        $join = [];
        $where = [];
        $params = [];

        if (!empty($request->getResultsWithSold())) {
            $where[] = "UPPER(bs.buyer_detail) NOT IN ('NOT SOLD','WITHDRAWN', 'VENDOR')";
            $where[] = 'bs.idx_buyer_detail IS NOT NULL';
        }

        if (!empty($request->getLotNo())) {
            $where[] = 'bs.lot_no = :lotNo:';
            $params['lotNo'] = $request->getLotNo();
        }

        if (!empty($request->getLotLetter())) {
            $where[] = 'bs.lot_letter = :lotLetter:';
            $params['lotLetter'] = $request->getLotLetter();
        }

        if (!empty($request->getName())) {
            $where[] = "(UPPER(h.horse_name) LIKE '%'+UPPER(:horseName:)+'%' 
                OR UPPER(bs.horse_name) LIKE '%'+UPPER(:horseName:)+'%')";
            $params['horseName'] = $request->getName();
        }

        if (!empty($request->getVendor())) {
            $where[] = "UPPER(bs.seller_name) LIKE '%'+UPPER(:vendor:)+'%'";
            $params['vendor'] = $request->getVendor();
        }

        if (!empty($request->getSale())) {
            $where[] = "UPPER(bsd.sale_name) LIKE '%'+UPPER(:saleName:)+'%'";
            $params['saleName'] = $request->getSale();
        }

        if (!empty($request->getMinPrice()) || !empty($request->getMaxPrice())) {
            if ($request->getMinPrice() && $request->getMaxPrice()) {
                $where[] = 'bs.price BETWEEN :minPrice: AND :maxPrice:';
                $params['minPrice'] = $request->getMinPrice();
                $params['maxPrice'] = $request->getMaxPrice();
            } elseif ($request->getMinPrice()) {
                $where[] = 'bs.price >= :minPrice:';
                $params['minPrice'] = $request->getMinPrice();
            } else {
                $where[] = 'bs.price <= :maxPrice:';
                $params['maxPrice'] = $request->getMaxPrice();
            }
        }


        if (!empty($request->getBuyer())) {
            $where[] = "UPPER(bs.buyer_detail) LIKE '%'+UPPER(:buyer:)+'%'";
            $params['buyer'] = $request->getBuyer();
        }

        if (!empty($request->getSire())) {
            $where[] = "UPPER(bs.sire_name) LIKE '%'+UPPER(:sireName:)+'%'";
            $params['sireName'] = $request->getSire();
        }

        if (!empty($request->getDam())) {
            $where[] = "UPPER(bs.dam_name) LIKE '%'+UPPER(:damName:)+'%'";
            $params['damName'] = $request->getDam();
        }

        if (!empty($request->getDamSire())) {
            $where[] = "UPPER(bs.sire_of_dam_name) LIKE '%'+UPPER(:damSireName:)+'%'";
            $params['damSireName'] = $request->getDamSire();
        }

        if (!empty($request->getSex())) {
            $where[] = "bs.horse_sex = :sex:";
            $params['sex'] = $request->getSex();
        }

        if ($request->isParameterSet('age')) {
            $age = $request->getAge();
            $where[] = 'bs.horse_age'
                . ((strpos($age, '+') > 0) ? '>=' : '=')
                . ':age:';
            $params['age'] = intval($age);
        }

        if (!empty($request->getSaleCompany())) {
            $where[] = 'v.venue_uid  = :venue_uid:';
            $params['venue_uid'] = $request->getSaleCompany();
        }

        if (!empty($request->getRegId())) {
            $ugcDb = DI::getDefault()->getShared('selectors')->getDb()->getUgcDb();
            $join[] = "INNER JOIN {$ugcDb}..reg_bs_sale_shortlist rbss
                ON bs.venue_uid = rbss.venue_uid
                    AND bs.sale_date = rbss.sale_date
                    AND bs.lot_no = rbss.lot_no
                    AND bs.lot_letter = rbss.lot_letter
                ";
            $where[] = 'rbss.reg_uid = :reg_uid:';
            $params['reg_uid'] = $request->getRegId();
        }

        if (!empty($request->getDateFrom()) && !empty($request->getDateTo())) {
            $params['dateFrom'] = $request->getDateFrom();
            $params['dateTo'] = $request->getDateTo();
            $where[] = 'bs.sale_date BETWEEN :dateFrom: AND :dateTo';
        }

        if (!empty($request->getVenueId())) {
            $where[] = 'bs.venue_uid = :venueId:';
            $params['venueId'] = $request->getVenueId();
        }
        $where[] = 'cc.country_code =
                    CASE WHEN c.cur_uid = ' . Constants::CURRENCY_USD_ID . '
                        THEN \'USA\'
                        ELSE cc.country_code
                    END';

        $sqlWhere = count($where) ? implode(' AND ', $where) : '';
        $sqlJoin = count($join) ? implode(" ", $join) : '';

        return [sprintf($sql, $sqlJoin, $sqlWhere), $params];
    }

    /**
     * @param Request\UpcomingSales $request
     *
     * @return array
     */
    public function getUpcomingSales(Request\UpcomingSales $request)
    {
        $selectors = $this->getDI()->getShared('selectors');
        $currencySqlField = $selectors->getCurrencySqlField();

        $sql = "
            SELECT
                h.horse_uid,
                bs.horse_name,
                horse_style_name = h.style_name,
                dam_date_of_birth = d.horse_date_of_birth,
                dam_style_name = d.style_name, 
                sire_style_name = horse_sire.style_name,
                sire_of_dam_style_name = sd.style_name,
                bs.horse_country_origin_code,
                bs.horse_first_colour_code,
                bs.horse_sex,
                bs.horse_age,
                bs.sire_uid,
                bs.sire_name,
                bs.sire_country_origin_code,
                bs.dam_uid,
                bs.dam_name,
                bs.dam_country_origin_code,
                sire_of_dam_uid = sd.horse_uid,
                bs.sire_of_dam_name,
                bs.sire_of_dam_ctry_org_code,
                v.venue_desc,
                v.venue_uid,
                sale_name = (
                    CASE
                        WHEN bsd.sale_name IS NULL OR bsd.sale_name = ''
                        THEN v.venue_desc
                        ELSE bsd.sale_name
                    END
                ),
                bsd.sale_date,
                bs.seller_name,
                bs.catalogue_pedigree_pdf_url,
                bs.lot_no,
                lot_no1 = bs.lot_no,
                bs.lot_letter,
                bs.price,
                bs.buyer_detail,
                yob = year(bs.sale_date) - bs.horse_age,
                bs.sirecam_video_html,
                currency = {$currencySqlField},
                entered = CASE WHEN EXISTS (SELECT
                    1
                FROM race_instance ri
                JOIN pre_horse_race phr ON ri.race_instance_uid = phr.race_instance_uid
                    AND  phr.race_status_code = ri.race_status_code
                WHERE
                    ri.race_datetime >= CONVERT(DATETIME, CONVERT(DATE, GETDATE()))
                    AND phr.horse_uid = h.horse_uid
                    AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                ) THEN 'Y' ELSE 'N' END
                INTO #tmp_bs_sale_up
            FROM
                bloodstock_sale_date bsd
                JOIN venue v ON bsd.venue_uid = v.venue_uid
                JOIN bloodstock_sale bs ON bs.sale_date = bsd.sale_date
                    AND bs.venue_uid = bsd.venue_uid
                LEFT JOIN horse h ON h.sire_uid = bs.sire_uid AND h.dam_uid = bs.dam_uid
                    AND bs.horse_age = YEAR(bs.sale_date) - YEAR(h.horse_date_of_birth)
                    AND 1 = (SELECT COUNT(h1.horse_uid) FROM horse h1 WHERE h1.horse_uid = h.horse_uid)
                LEFT JOIN horse d ON d.horse_uid = bs.dam_uid
                LEFT JOIN horse sd ON sd.horse_uid = d.sire_uid
                LEFT JOIN horse horse_sire ON horse_sire.horse_uid = bs.sire_uid
                %s
            WHERE
                %s
            ORDER BY
              bs.horse_name DESC, bs.lot_no
        ";

        list($sql, $params) = $this->getUpcomingSalesWhere($sql, $request);

        $this->execute(
            $sql,
            $params,
            false
        );

        $result = $this->query("SELECT * FROM #tmp_bs_sale_up");

        return $result->toArrayWithRows();
    }

    /**
     * @return array
     */
    public function getUpcomingSalesEntryRacesUids()
    {
        $result = $this->query("
            SELECT
                t.horse_uid,
                entry_race_uid = ri.race_instance_uid
            FROM
                race_instance ri
            JOIN pre_horse_race phr ON
                ri.race_instance_uid = phr.race_instance_uid
                AND phr.race_status_code = (
                    CASE
                        WHEN ri.race_status_code=" . Constants::RACE_STATUS_RESULTS . "
                        THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                        ELSE ri.race_status_code
                    END
                )
            JOIN #tmp_bs_sale_up t ON phr.horse_uid =  t.horse_uid
        ");

        $result = $result->toArrayWithRows('horse_uid', null, true);

        $this->execute(
            'DROP TABLE #tmp_bs_sale_up',
            [],
            false
        );

        return $result;
    }

    /**
     * @return \Phalcon\Mvc\Model\Row\General[]
     */
    public function getSalesCompaniesList(Request\CompanyNames $request)
    {
        $sql = "
            SELECT
                v.venue_uid,
                v.venue_desc
            FROM
                venue v
            WHERE
                v.venue_uid IN (
                    SELECT DISTINCT bs.venue_uid
                    FROM bloodstock_sale bs %s
                    WHERE bs.venue_uid != 60 %s
                )
            ORDER BY v.venue_desc
            ";

        list($sql, $params) = $this->getCompanyNamesWhere($sql, $request);

        $result = $this->query(
            $sql,
            $params
        );

        return $result->toArrayWithRows();
    }

    /**
     * @param string               $sql
     * @param Request\CompanyNames $request
     *
     * @return array
     */
    private function getCompanyNamesWhere($sql, Request\CompanyNames $request)
    {
        $params = [];
        $where = [];
        $join = [];
        $sqlWhere = null;
        $sqlJoin = null;

        if (count($request->getIncomingNamedParameters()) > 0) {
            // bloodstock_sale
            if (!empty($request->getDateFrom()) && !empty($request->getDateTo())) {
                $where[] = "bs.sale_date between :dateFrom: and :dateTo:";
                $params['dateFrom'] = $request->getDateFrom();
                $params['dateTo'] = $request->getDateTo();
            }

            if (!empty($request->getResultsWithSold())) {
                $where[] = "UPPER(bs.buyer_detail) NOT IN ('NOT SOLD','WITHDRAWN', 'VENDOR')";
                $where[] = 'bs.idx_buyer_detail IS NOT NULL';
            }

            if (!empty($request->getLotNo())) {
                $where[] = 'bs.lot_no = :lotNo:';
                $params['lotNo'] = $request->getLotNo();
            }

            if (!empty($request->getName())) {
                $where[] = "UPPER(bs.horse_name) LIKE '%'+UPPER(:horseName:)+'%'";
                $params['horseName'] = $request->getName();
            }

            if (!empty($request->getVendor())) {
                $where[] = "bs.search_seller_name LIKE '%'+UPPER(:vendor:)+'%'";
                $params['vendor'] = $request->getVendor();
            }

            if (!empty($request->getMinPrice()) || !empty($request->getMaxPrice())) {
                if ($request->getMinPrice() && $request->getMaxPrice()) {
                    $where[] = 'bs.price BETWEEN :minPrice: AND :maxPrice:';
                    $params['minPrice'] = $request->getMinPrice();
                    $params['maxPrice'] = $request->getMaxPrice();
                } elseif ($request->getMinPrice()) {
                    $where[] = 'bs.price >= :minPrice:';
                    $params['minPrice'] = $request->getMinPrice();
                } else {
                    $where[] = 'bs.price <= :maxPrice:';
                    $params['maxPrice'] = $request->getMaxPrice();
                }
            }

            if (!empty($request->getBuyer())) {
                $where[] = "bs.search_buyer_detail LIKE '%'+UPPER(:buyer:)+'%'";
                $params['buyer'] = $request->getBuyer();
            }

            if (!empty($request->getSire())) {
                $where[] = "UPPER(bs.sire_name) LIKE '%'+UPPER(:sireName:)+'%'";
                $params['sireName'] = $request->getSire();
            }

            if (!empty($request->getDam())) {
                $where[] = "UPPER(bs.dam_name) LIKE '%'+UPPER(:damName:)+'%'";
                $params['damName'] = $request->getDam();
            }

            if (!empty($request->getDamSire())) {
                $where[] = "UPPER(bs.sire_of_dam_name) LIKE '%'+UPPER(:damSireName:)+'%'";
                $params['damSireName'] = $request->getDamSire();
            }

            if (!empty($request->getSex())) {
                $where[] = "bs.horse_sex = :sex:";
                $params['sex'] = $request->getSex();
            }

            if ($request->isParameterSet('age')) {
                $age = $request->getAge();
                $where[] = 'bs.horse_age'
                    . ((strpos($age, '+') > 0) ? '>=' : '=')
                    . ':age:';
                $params['age'] = intval($age);
            }

            if (!empty($request->getSaleCompany())) {
                $where[] = 'bs.venue_uid = :venueId:';
                $params['venueId'] = $request->getSaleCompany();
            }

            if (!empty($request->getVenueId())) {
                $where [] = 'bs.venue_uid = :venueId:';
                $params['venueId'] = $request->getVenueId();
            }

            // bloodstock_sale_date
            if (!empty($request->getSale())) {
                $where[] = "UPPER(bsd.sale_name) LIKE '%'+UPPER(:saleName:)+'%'";
                $join[] = "JOIN bloodstock_sale_date bsd on bs.sale_date = bsd.sale_date and bs.venue_uid = bsd.venue_uid";
                $params['saleName'] = $request->getSale();
            }

            // ugc..reg_bs_sale_shortlist
            if (!empty($request->getRegId())) {
                $ugcDb = DI::getDefault()->getShared('selectors')->getDb()->getUgcDb();
                $join [] = "INNER JOIN {$ugcDb}..reg_bs_sale_shortlist rbss
                    ON bs.venue_uid = rbss.venue_uid
                        AND bs.sale_date = rbss.sale_date
                        AND bs.lot_no = rbss.lot_no
                        AND bs.lot_letter = rbss.lot_letter
                    ";
                $where [] = 'rbss.reg_uid = :regId:';
                $params['regId'] = $request->getRegId();
            }

            $sqlWhere = count($where) ? " AND " . implode(' AND ', $where) : '';
            $sqlJoin = count($join) ? implode(" ", $join) : '';
        }

        return [sprintf($sql, $sqlJoin, $sqlWhere), $params];
    }

    /**
     * @param $horsesIds
     *
     * @return array
     */
    public function getEnteredRaces($horsesIds)
    {
        $sql = '
        SELECT
            phr.horse_uid
            , ri.race_instance_uid
        FROM race_instance ri
            JOIN pre_horse_race phr ON ri.race_instance_uid = phr.race_instance_uid
                AND phr.race_status_code = ri.race_status_code
        WHERE
            ri.race_datetime >= CONVERT(DATETIME, CONVERT(DATE, GETDATE()))
            AND phr.horse_uid IN (:horsesIds)
            AND ri.race_type_code !=  (' . Constants::RACE_TYPE_P2P . ')
   
        ';

        $result = $this->query(
            $sql,
            ['horsesIds' => $horsesIds]
        );

        return $result->toArrayWithRows('horse_uid', null, true);
    }
}
