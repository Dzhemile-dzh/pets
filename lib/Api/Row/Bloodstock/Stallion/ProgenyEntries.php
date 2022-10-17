<?php

namespace Api\Row\Bloodstock\Stallion;

class ProgenyEntries extends \Phalcon\Mvc\Model\Row\General
{
    use \Api\Row\Methods\GetRaceDescriptionForForm;
    use \Api\Row\Methods\GetDistanceInFurlong;
    use \Api\Row\Methods\GetRaceTypeCodeFmt;
}
