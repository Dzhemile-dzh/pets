<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 2/3/15
 * Time: 3:14 PM
 */

namespace Tests\Output;

class MapperMock extends \Phalcon\Output\Mapper
{
    private $map = [];
    protected $ca;

    public function __construct($objMapFrom, array $map, $ca = null)
    {
        $this->map = $map;
        $this->ca = $ca;
        parent::__construct($objMapFrom);
    }

    /**
     * @return array
     */
    protected function getMap()
    {
        return $this->map;
    }
}
