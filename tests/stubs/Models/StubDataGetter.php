<?php

namespace Tests\Stubs\Models;

trait StubDataGetter
{

    public static function getStubData($datasetName)
    {
        return static::$_stubData[$datasetName];
    }

    public static function getRequestKey(\Phalcon\Input\Request $request)
    {
        $key = implode(
            '_',
            array_map(
                function ($item) {
                    if (is_array($item)) {
                        return implode('_', $item);
                    } else {
                        return $item;
                    }
                },
                $request->getIncomingOrderedParameters() + $request->getIncomingNamedParameters()
            )
        );
        return $key;
    }
}
