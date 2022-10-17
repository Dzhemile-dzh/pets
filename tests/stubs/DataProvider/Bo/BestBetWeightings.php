<?php

namespace Tests\Stubs\DataProvider\Bo;

class BestBetWeightings extends \Api\DataProvider\Bo\BestBetWeightings
{
    public function getBestBetWeightings()
    {
        return [
            1 => \Phalcon\Mvc\Model\Row\General::createFromArray([
                'best_bet_uid' => 1,
                'best_bet_weighting' => 0,
            ]),
            2 => \Phalcon\Mvc\Model\Row\General::createFromArray([
                'best_bet_uid' => 2,
                'best_bet_weighting' => 100,
            ]),
            3 => \Phalcon\Mvc\Model\Row\General::createFromArray([
                'best_bet_uid' => 3,
                'best_bet_weighting' => 100,
            ]),
            4 => \Phalcon\Mvc\Model\Row\General::createFromArray([
                'best_bet_uid' => 4,
                'best_bet_weighting' => 90,
            ]),
            5 => \Phalcon\Mvc\Model\Row\General::createFromArray([
                'best_bet_uid' => 5,
                'best_bet_weighting' => 100,
            ]),
            6 => \Phalcon\Mvc\Model\Row\General::createFromArray([
                'best_bet_uid' => 6,
                'best_bet_weighting' => 100,
            ]),
            7 => \Phalcon\Mvc\Model\Row\General::createFromArray([
                'best_bet_uid' => 7,
                'best_bet_weighting' => 100,
            ]),
            8 => \Phalcon\Mvc\Model\Row\General::createFromArray([
                'best_bet_uid' => 8,
                'best_bet_weighting' => 100,
            ]),
            9 => \Phalcon\Mvc\Model\Row\General::createFromArray([
                'best_bet_uid' => 9,
                'best_bet_weighting' => 100,
            ]),
            10 => \Phalcon\Mvc\Model\Row\General::createFromArray([
                'best_bet_uid' => 10,
                'best_bet_weighting' => 100,
            ]),
            11 => \Phalcon\Mvc\Model\Row\General::createFromArray([
                'best_bet_uid' => 11,
                'best_bet_weighting' => 100,
            ]),
            12 => \Phalcon\Mvc\Model\Row\General::createFromArray([
                'best_bet_uid' => 12,
                'best_bet_weighting' => 100,
            ]),
            13 => \Phalcon\Mvc\Model\Row\General::createFromArray([
                'best_bet_uid' => 13,
                'best_bet_weighting' => 100,
            ])
        ];
    }
}
