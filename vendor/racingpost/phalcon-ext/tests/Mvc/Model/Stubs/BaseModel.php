<?php
namespace Tests\Mvc\Model\Stubs;

class BaseModel extends \Phalcon\Mvc\Model\BaseModel
{
    private $skippedAttributes;

    /**
     * @return Memory
     */
    public function getModelsMetaData()
    {
        return new \Tests\Mvc\Model\Stubs\Memory();
    }

    /**
     * @param $attribute
     *
     * @return mixed
     */
    public function readAttribute($attribute)
    {
        $result = [
            'reg_uid' => 212,
            'horse_uid' => 42343,
            'rating' => null,
            'rating_flag' => null
        ];
        return $result[$attribute];
    }

    /**
     * @param array $skippedAttributes
     */
    public function skipAttributesOnUpdate(array $skippedAttributes)
    {
        $this->skippedAttributes = $skippedAttributes;
    }

    /**
     * @return mixed
     */
    public function getSkippedAttributes()
    {
        return $this->skippedAttributes;
    }
}