<?php

namespace Tests\Stubs\Models\Bo\CourseProfile;

class RaceInstance extends \Tests\Stubs\Models\RaceInstance
{
    public function getLastRaceTypeCode($courseId)
    {
        return 'F';
    }

    /**
     * @param \Api\Input\Request\Horses\Profile\Course\Statistics $request
     * @return array
     */
    public function getStatisticsTopJockeys(\Api\Input\Request\Horses\Profile\Course\Statistics $request)
    {
        return [
            \Phalcon\Mvc\Model\Row\General::createFromArray([
                'jockey_uid' => 79202,
                'style_name' => 'Ryan Moore',
                'wins' => 37,
                'runs' => 242,
                'stake' => -67.17,
                'ptp_type_code' => 'N',
            ]),
            \Phalcon\Mvc\Model\Row\General::createFromArray([
                'jockey_uid' => 85793,
                'style_name' => 'William Buick',
                'wins' => 24,
                'runs' => 185,
                'stake' => -19.43,
                'ptp_type_code' => 'N',
            ]),
            \Phalcon\Mvc\Model\Row\General::createFromArray([
                'jockey_uid' => 3793,
                'style_name' => 'Richard Hughes',
                'wins' => 22,
                'runs' => 233,
                'stake' => -91.83,
                'ptp_type_code' => 'N',
            ]),
            \Phalcon\Mvc\Model\Row\General::createFromArray([
                'jockey_uid' => 13689,
                'style_name' => 'Jamie Spencer',
                'wins' => 16,
                'runs' => 159,
                'stake' => -41.82,
                'ptp_type_code' => 'N',
            ]),
            \Phalcon\Mvc\Model\Row\General::createFromArray([
                'jockey_uid' => 6901,
                'style_name' => 'James Doyle',
                'wins' => 15,
                'runs' => 127,
                'stake' => -25.27,
                'ptp_type_code' => 'N',
            ]),
        ];
    }

    /**
     * @param \Api\Input\Request\Horses\Profile\Course\Statistics $request
     * @return array
     */
    public function getStatisticsTopTrainers(\Api\Input\Request\Horses\Profile\Course\Statistics $request)
    {
        return [
            \Phalcon\Mvc\Model\Row\General::createFromArray([
                'trainer_uid' => 4336,
                'style_name' => 'John Gosden',
                'wins' => 28,
                'runs' => 170,
                'stake' => 33.57,
                'ptp_type_code' => 'N',
            ]),
            \Phalcon\Mvc\Model\Row\General::createFromArray([
                'trainer_uid' => 282,
                'style_name' => 'Richard Hannon Snr',
                'wins' => 24,
                'runs' => 259,
                'stake' => -75.65,
                'ptp_type_code' => 'N',
            ]),
            \Phalcon\Mvc\Model\Row\General::createFromArray([
                'trainer_uid' => 3378,
                'style_name' => 'Mark Johnston',
                'wins' => 18,
                'runs' => 249,
                'stake' => -79.84,
                'ptp_type_code' => 'N',
            ]),
            \Phalcon\Mvc\Model\Row\General::createFromArray([
                'trainer_uid' => 619,
                'style_name' => 'Sir Michael Stoute',
                'wins' => 14,
                'runs' => 109,
                'stake' => -45.62,
                'ptp_type_code' => 'N',
            ]),
            \Phalcon\Mvc\Model\Row\General::createFromArray([
                'trainer_uid' => 7978,
                'style_name' => 'A P O\'Brien',
                'wins' => 14,
                'runs' => 105,
                'stake' => -13.59,
                'ptp_type_code' => 'N',
            ]),
        ];
    }

    /**
     * @param \Api\Input\Request\Horses\Profile\Course\Statistics $request
     * @return array
     */
    public function getStatisticsTopOwners(\Api\Input\Request\Horses\Profile\Course\Statistics $request)
    {
        return [
            \Phalcon\Mvc\Model\Row\General::createFromArray([
                'owner_uid' => 49845,
                'style_name' => 'Godolphin',
                'wins' => 24,
                'runs' => 212,
                'stake' => -31.63,
                'ptp_type_code' => 'N',
            ]),
            \Phalcon\Mvc\Model\Row\General::createFromArray([
                'owner_uid' => 1859,
                'style_name' => 'Hamdan Al Maktoum',
                'wins' => 21,
                'runs' => 184,
                'stake' => -45.50,
                'ptp_type_code' => 'N',
            ]),
            \Phalcon\Mvc\Model\Row\General::createFromArray([
                'owner_uid' => 16906,
                'style_name' => 'K Abdullah',
                'wins' => 16,
                'runs' => 103,
                'stake' => -38.45,
                'ptp_type_code' => 'N',
            ]),
            \Phalcon\Mvc\Model\Row\General::createFromArray([
                'owner_uid' => 59472,
                'style_name' => 'Sheikh Hamdan bin Mohammed Al Maktoum',
                'wins' => 8,
                'runs' => 131,
                'stake' => -17.00,
                'ptp_type_code' => 'N',
            ]),
            \Phalcon\Mvc\Model\Row\General::createFromArray([
                'owner_uid' => 49024,
                'style_name' => 'Lady Rothschild',
                'wins' => 7,
                'runs' => 20,
                'stake' => 22.50,
                'ptp_type_code' => 'N',
            ])
        ];
    }

    /**
     * @param \Api\Input\Request\Horses\Profile\Course\Statistics $request
     * @return array
     */
    public function getStatisticsTopHorses(\Api\Input\Request\Horses\Profile\Course\Statistics $request)
    {
        return [
            \Phalcon\Mvc\Model\Row\General::createFromArray([
                'horse_uid' => 861914,
                'style_name' => 'Masterplan',
                'wins' => 2,
                'runs' => 3,
                'trainer_uid' => 18660,
                'trainer_name' => 'Charlie Longsdon',
                'top_rpr' => null,
                'stake' => 21.50,
            ]),
            \Phalcon\Mvc\Model\Row\General::createFromArray([
                'horse_uid' => 832406,
                'style_name' => 'Cold March',
                'wins' => 1,
                'runs' => 3,
                'trainer_uid' => 17752,
                'trainer_name' => 'B Lefevre',
                'top_rpr' => null,
                'stake' => 10.00,
            ]),
            \Phalcon\Mvc\Model\Row\General::createFromArray([
                'horse_uid' => 805076,
                'style_name' => 'Royal Regatta',
                'wins' => 1,
                'runs' => 3,
                'trainer_uid' => 135,
                'trainer_name' => 'Philip Hobbs',
                'top_rpr' => null,
                'stake' => 6.00,
            ]),
            \Phalcon\Mvc\Model\Row\General::createFromArray([
                'horse_uid' => 870671,
                'style_name' => 'Duke Des Champs',
                'wins' => 1,
                'runs' => 2,
                'trainer_uid' => 135,
                'trainer_name' => 'Philip Hobbs',
                'top_rpr' => null,
                'stake' => -0.09,
            ]),
            \Phalcon\Mvc\Model\Row\General::createFromArray([
                'horse_uid' => 856933,
                'style_name' => 'Desert Queen',
                'wins' => 1,
                'runs' => 2,
                'trainer_uid' => 29988,
                'trainer_name' => 'Ben Clarke',
                'top_rpr' => null,
                'stake' => 7.00,
            ])
        ];
    }
}
