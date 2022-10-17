<?php
namespace Tests\Mvc\Model\Stubs;

class Memory extends \Phalcon\Mvc\Model\MetaData\Memory
{
    /**
     * @param \Phalcon\Mvc\ModelInterface $model
     *
     * @return array
     */
    public function getAttributes(\Phalcon\Mvc\ModelInterface $model)
    {
        return [
            'horse_uid',
            'reg_uid',
            'rating',
            'rating_flag'
        ];
    }
}