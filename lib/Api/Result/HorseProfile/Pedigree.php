<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 9/11/14
 * Time: 9:35 AM
 */

namespace Api\Result\HorseProfile;

class Pedigree extends \Api\Result\Json
{
    /**
     *
     * @return mixed
     */
    public function getPreparedData()
    {
        $data = clone $this->data;
        $data->pedigree = $this->mapPedigree($data->pedigree);
        return $data;
    }

    /**
     * @param \Api\Row\Horse $pedigree
     *
     * @return \Api\Output\Mapper\HorseProfile\Pedigree
     */
    private function mapPedigree(\Api\Row\Horse $pedigree)
    {
        $pedigree = (property_exists($pedigree, 'dam')) ? new \Api\Output\Mapper\HorseProfile\Pedigree($pedigree) : new \Api\Output\Mapper\HorseProfile\PedigreeShort($pedigree);

        if (isset($pedigree->sire) && $pedigree->sire instanceof \Api\Row\Horse) {
            $pedigree->sire = $this->mapPedigree($pedigree->sire);
        }

        if (isset($pedigree->dam) && $pedigree->dam instanceof \Api\Row\Horse) {
            $pedigree->dam = $this->mapPedigree($pedigree->dam);
        }

        return $pedigree;
    }
}
