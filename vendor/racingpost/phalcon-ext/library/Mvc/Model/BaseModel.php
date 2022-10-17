<?php

namespace Phalcon\Mvc\Model;

use Phalcon\Mvc\Model;

class BaseModel extends Model
{
    public function beforeValidationOnUpdate()
    {
        $metadata = $this->getModelsMetaData();
        $skippedAttributes = [];
        foreach ($metadata->getAttributes($this) as $attribute) {
            if (is_null($this->readAttribute($attribute))) {
                $skippedAttributes[] = $attribute;
            }
        }

        if (!empty($skippedAttributes)) {
            $this->skipAttributesOnUpdate($skippedAttributes);
        }
    }

    /**
     * @return string
     */
    public function getResultsetClass()
    {
        return 'Phalcon\Mvc\Model\Resultset\General';
    }
}
