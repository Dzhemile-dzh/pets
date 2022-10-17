<?php

declare(strict_types=1);

namespace Bo\Native\Results;

use Bo\Standart;
use Phalcon\Mvc\Model\Row;
use Api\DataProvider\Bo\Native\Results\FullResult as DataProvider;
use Api\Input\Request\Horses\Native\Results\FullResult as Request;
use Api\Output\Mapper\Methods\LegacyDecorators;
use \Api\Row\Methods\GetDistanceInFurlong;

/**
 * @method Request getRequest()
 *
 * @package Bo\Native\Cards
 */
class FullResult extends Standart
{
    use GetDistanceInFurlong;
    use LegacyDecorators;
    const ADS_CHANGE_DELAY = 10;
    const GBP_SIGN = '&pound;';

    /**
     * @return Row
     *
     * @throws \Api\Exception\NotFound
     */
    public function getData(): Row
    {
        $raceId = $this->getRequest()->getRaceId();
        $dataProvider = new DataProvider($raceId);

        $data = $dataProvider->getData($raceId);

        if (empty((array)$data)) {
            throw new \Api\Exception\NotFound(7101);
        }
        $runners = $dataProvider->getRunners($raceId, $data->raceDate, $this->getModelSelectors());
        $nonRunners = $dataProvider->getNonRunners($raceId, $data->raceDate, $this->getModelSelectors());
        $prizes = $dataProvider->getPrizes($raceId);
        $toteInfo = $dataProvider->getTote($raceId);

        $results = $data;

        foreach ($prizes as $key => $prize) {
            $tempKey = 'prizePos' . ($key + 1);
            $prize->prizeGbp = $prize->prizeGbp ? sprintf('%02.2f', $prize->prizeGbp) : '0.00';
            $prize->prizeEur = $prize->prizeEur ? sprintf('%02.2f', $prize->prizeEur) : '';
            $results->$tempKey = $prize;
        }

        $results->adsChangeDelay = self::ADS_CHANGE_DELAY;

        $dt = new \DateTime($results->raceDate);

        $date = $dt->format('Y-m-d');
        $time = $dt->format('g:i');

        $results->raceDate = $date;
        $results->raceTime = $time;

        $results->meetingName = $this->prepareMeetingName($results->meetingName, $results->country_code);

        $results->distance = $this->yardsToString($results->distance);
        $results->distanceRounded = $this->yardsToMilesAndFurlongs($results->distanceRounded);
        $results->distanceRoundedFurlong = $this->printDistanceAsFormula($results->distanceRoundedFurlong, 1);

        $results->winnerTime = $results->winnerTime ? $this->secToString($results->winnerTime) : null;
        if ($results->diffStdTimeSec) {
            $results->diffStdTimeSec = $results->diffStdTimeSec > 0 ? sprintf(
                'slow by %02.2fs',
                $results->diffStdTimeSec
            ) : sprintf('fast by %02.2fs', $results->diffStdTimeSec);
        }

        $results->tote = $this->getTote(
            $toteInfo,
            $results->placepot_text,
            $results->quadpot_text,
            $results->jackpot_text,
            $raceId
        );

        unset($results->country_code); //remove the country_code from the response
        unset($results->placepot_text);
        unset($results->quadpot_text);
        unset($results->jackpot_text);

        $results->runners = $runners;
        $results->non_runners = $nonRunners;


        return $results;
    }


    private function secToString(float $seconds)
    {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds / 60) % 60);
        $seconds = $seconds - $hours * 3600 - $minutes * 60;

        $hours = $hours ? $hours . 'h ' : '';
        $minutes = $minutes ? $minutes . 'm ' : '';
        $seconds = $seconds ? sprintf('%02.2f', $seconds) . 's' : '';


        return $hours . $minutes . $seconds;
    }

    private function getTote($toteInfo, $placepot, $quadpot, $jackpot, $raceId)
    {
        $dataProvider = new DataProvider();

        $lastRace = Row\General::convertFromRow($dataProvider->getLastRace($raceId));

        if (!$toteInfo) {
            return sprintf('<![CDATA[%s]]>', '');
        };

        $tote = '';
        if ($toteInfo->tote_deadheat_text) {
            $tote .= str_replace(';', '<br />', $toteInfo->tote_deadheat_text) . ' ';
        }

        $tote .= $this->formatToteFieldInfo($toteInfo->tote_win_money, 'WIN ', ', ');
        $tote .= $this->formatToteFieldInfo($toteInfo->tote_place_1_money, 'PL ', ', ');
        $tote .= $this->formatToteFieldInfo($toteInfo->tote_place_2_money, '', ', ');
        $tote .= $this->formatToteFieldInfo($toteInfo->tote_place_3_money, '', ', ');
        $tote .= $this->formatToteFieldInfo($toteInfo->tote_place_4_money, '', ', ');

        $tote = rtrim($tote, ', ');

        $tote .= $tote ? '<br />' : '';
        $tote .= $this->formatToteFieldInfo($toteInfo->tote_dual_forecast_money, 'Ex ', '<br />');
        $tote .= $this->formatToteFieldInfo($toteInfo->computer_strght_frcst_money, 'CSF ', '<br />');
        $tote .= $this->formatToteFieldInfo($toteInfo->tricast_money, 'TRICAST ', '<br />');

        if ($raceId == $lastRace->race_instance_uid) {
            $placepot = $this->formatText($placepot);
            $quadpot = $this->formatText($quadpot);
            $jackpot = $this->formatText($jackpot);

            $tote .= ($jackpot ? 'JACKPOT ' . $jackpot . '<br />' : '');
            $tote .= ($placepot ? 'PLACEPOT ' . $placepot . '<br />' : '');

            $tote .= ($quadpot ? 'QUADPOT ' . $quadpot . '<br />' : '');
        }

        $tote = rtrim($tote, '<br />');

        $tote = str_replace("@", "&euro;", $tote);

        return $this->betOfferDesc($tote);
    }

    private function formatToteFieldInfo($info, $prefix, $sufix)
    {
        return $info ? $prefix . self::GBP_SIGN . sprintf('%02.2f', $info) . $sufix : '';
    }
}
