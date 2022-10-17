<?php

namespace Api\Bo\Traits;

use \Api\Constants\Horses as Constants;

/**
 * Trait CompareEntities
 *
 * @package Api\Bo\Traits
 */
trait CompareEntities
{
    /**
     * @param $previous
     * @param $current
     *
     * @return bool
     */
    private function isSameEntity($previous, $current, $type)
    {
        $result = true;
        $object = new \stdClass();
        $ptpCode = 'ptp_type_code';
        $fieldPtp = $type . '_' . $ptpCode;
        $fieldName = $type . '_search_name';

        $object->ptp_type_code = $current->{$fieldPtp};
        $object->search_name = $current->{$fieldName};

        if (!(
                $this->compareEntities(
                    $previous,
                    $object,
                    $type,
                    $ptpCode,
                    [
                        Constants::PTP_CODE_GB,
                        Constants::PTP_CODE_NEITHER
                    ]
                )
                && $previous->{$fieldName} == $object->search_name
            )
            && !(
                $this->compareEntities(
                    $previous,
                    $object,
                    $type,
                    $ptpCode,
                    [
                        Constants::PTP_CODE_IRE,
                        Constants::PTP_CODE_NEITHER
                    ]
                )
                && $previous->{$fieldName} == $object->search_name
            )
            && isset($previous->{$fieldPtp})
            && isset($object->ptp_type_code)
        ) {
            $result = false;
        }

        return $result;
    }

    /**
     * @param        $entity
     * @param        $obj
     * @param string $type
     * @param string $field
     * @param array  $codes
     *
     * @return bool
     */
    private function compareEntities($entity, $obj, string $type, string $field, array $codes): bool
    {
        $fieldEntity = $type . '_' . $field;
        return
            ($entity->{$fieldEntity} == $codes[0] && $obj->{$field} == $codes[1])
            || ($entity->{$fieldEntity} == $codes[1] && $obj->{$field} == $codes[0]);
    }
}
