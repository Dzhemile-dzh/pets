<?php

declare(strict_types=1);

namespace Bo\Native\Profiles\Horses;

use Bo\Standart;
use Api\DataProvider\Bo\Native\Profiles\Horses\Horse as DataProvider;
use Api\Input\Request\Horses\Native\Profiles\Horses\Horse as Request;
use \Models\Horse as HorseModel;

/**
 * @method Request getRequest()
 *
 * @package Bo\Native\Profiles\Horses
 */
class Horse extends Standart
{
    /**
     * @return Object
     */
    public function getData(): \Phalcon\Mvc\Model\Row\General
    {
        $dataProvider = new DataProvider();
        $horseId = $this->getRequest()->getHorseId();

        $data = $dataProvider->getData($horseId);

        if (count($data) == 0) {
            throw new \Api\Exception\NotFound(3101);
        }

        $data = $data[0];

        $data->Horse = $data->Horse[0];
        $data->HorseDam = $data->HorseDam[0];
        $data->DamSir = $data->DamSir[0];
        $data->HorseSir = $data->HorseSir[0];
        $data->SireSir = $data->SireSir[0];

        $races = $dataProvider->getHorseForm($horseId);
        $horseModel = new HorseModel();
        $data->HorseRecords = $horseModel->getRaceRecords($races);

        $data->HorseForm = $races;

        return $data;
    }
}
