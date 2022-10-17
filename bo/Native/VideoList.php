<?php

declare(strict_types=1);

namespace Bo\Native;

use Bo\Standart;
use Phalcon\Mvc\Model\Row;
use Phalcon\Mvc\Model\Resultset\ResultsetException;
use Api\DataProvider\Bo\Native\VideoList as DataProvider;
use Api\Input\Request\Horses\Native\VideoList as Request;
use phpDocumentor\Reflection\Types\Array_;

/**
 *
 * @method Request getRequest()
 *
 * @package Bo\Native
 */
class VideoList extends Standart
{

    protected $request;

    /**
     * @return DataProvider
     */
    protected function getDataProvider()
    {
        return new DataProvider();
    }

    /**
     * @return array
     * @throws ResultsetException
     */
    public function getVideo(): array
    {
        return ['videoData'=>$this->getDataProvider()->getVideo(),'date'=>$this->getDataProvider()->getDate()];
    }
}
