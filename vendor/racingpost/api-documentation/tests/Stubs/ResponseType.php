<?php
/**
 * Created by PhpStorm.
 * User: Ievgen_Rebrakov
 * Date: 2016-12-26
 * Time: 17:35
 */

namespace Tests\Stubs;

use RP\Documentation\ResponseTypeInterface;

class ResponseType implements ResponseTypeInterface
{

    public function getExample()
    {
        return 'exampleText';
    }

    public function getSchema()
    {
        return 'schemaText';
    }
}