<?php

namespace Api\DataProvider\Bo\RaceCards;

use Phalcon\Mvc\DataProvider;
use Api\Row\RaceCards\Selections;
use Api\Constants\Horses as Constants;

/**
 * @package Api\DataProvider\Bo\RaceCards
 */
class SsNatPress extends DataProvider
{
    /**
     * @return array
     */
    public function getPressChallenge(): array
    {
        $sql = "
          SELECT
              MAX(phr.rp_owner_choice),
              horse_name = h.style_name,
              h.country_origin_code,
              snp.horse_uid,
              c.course_uid,
              c.rp_abbrev_4,
              course_name = c.style_name,
              ho.owner_uid,
              snp.bet_return,
              snp.newspaper,
              snp.tipster,
              snp.wins,
              snp.runs,
              snp.strike_rate,
              snp.favs_tipped,
              snp.nap_time,
              snp.course,
              snp.nap_wins,
              snp.nap_runs,
              snp.profit_loss,
              snp.curr_seq,
              snp.month_wins,
              snp.month_runs,
              snp.month_profit_loss,
              snp.bank
          FROM ss_nat_press snp
          LEFT JOIN horse h ON h.horse_uid = snp.horse_uid
          LEFT JOIN pre_horse_race phr ON phr.horse_uid = h.horse_uid
          LEFT JOIN course c ON snp.course_uid = c.course_uid AND c.country_code IN ('GB','IRE')
          LEFT JOIN horse_owner ho ON ho.horse_uid = h.horse_uid
              AND isnull(ho.owner_change_date, '" . Constants::EMPTY_DATE . "') = '" . Constants::EMPTY_DATE . "'
          GROUP BY
              h.style_name,
              h.country_origin_code,
              snp.horse_uid,
              c.course_uid,
              c.rp_abbrev_4,
              c.style_name,
              ho.owner_uid,
              snp.bet_return,
              snp.newspaper,
              snp.tipster,
              snp.wins,
              snp.runs,
              snp.strike_rate,
              snp.favs_tipped,
              snp.nap_time,
              snp.course,
              snp.nap_wins,
              snp.nap_runs,
              snp.profit_loss,
              snp.curr_seq,
              snp.month_wins,
              snp.month_runs,
              snp.month_profit_loss,
              snp.bank
         ";

        $res = $this->query(
            $sql,
            null,
            new Selections()
        );

        return $res->toArrayWithRows();
    }
}
