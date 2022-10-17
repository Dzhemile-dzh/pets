<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 9/11/14
 * Time: 9:35 AM
 */

namespace Api\Result\HorseProfile;

class Statistics extends \Api\Result\Json
{

    /**
     *
     * @return mixed
     */
    public function getPreparedData()
    {
        $data = clone $this->data;

        if (isset($data->statistics)) {
            $statistics = [];
            foreach ($data->statistics as $groupName => $groupData) {
                if (!isset($statistics[$groupName])) {
                    $statistics[$groupName] = [];
                }

                foreach ($groupData as $key => $value) {
                    switch ($groupName) {
                        case 'course':
                            $statistics[$groupName][] = new \Api\Output\Mapper\HorseProfile\Statistics\Course($value);
                            break;
                        case 'distance':
                            $statistics[$groupName][] = new \Api\Output\Mapper\HorseProfile\Statistics\Distance($value);
                            break;
                        case 'class':
                            $statistics[$groupName][] = new \Api\Output\Mapper\HorseProfile\Statistics\ClassField($value);
                            break;
                        case 'going':
                            $statistics[$groupName][] = new \Api\Output\Mapper\HorseProfile\Statistics\Going($value);
                            break;
                        case 'jockey':
                            $statistics[$groupName][] = new \Api\Output\Mapper\HorseProfile\Statistics\Jockey($value);
                            break;
                        case 'month':
                            $statistics[$groupName][] = new \Api\Output\Mapper\HorseProfile\Statistics\Month($value);
                            break;
                    }
                }
            }
            $data->statistics = $statistics;
        }

        return $data;
    }
}
