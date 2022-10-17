<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 11/4/14
 * Time: 11:44 AM
 */

namespace Api\Row\RaceCards;

class Selections extends \Phalcon\Mvc\Model\Row\General
{
    use \Api\Row\Methods\RaceCards\GetSelectionType;
    use \Api\Row\Methods\GetSilkImagePath;
}
