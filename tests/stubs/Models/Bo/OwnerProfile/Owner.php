<?php
/**
 * Created by PhpStorm.
 *"User" => Anton_Gurkovsky
 *"Date" => 12/8/2015
 *"Time" =>"11" =>07 AM
 */

namespace Tests\Stubs\Models\Bo\OwnerProfile;

use \Tests\Stubs\Models\Owner as StubOwner;

class Owner extends StubOwner
{
    /**
     * @param \Api\Input\Request\Horses\Profile\Owner\Index $request
     *
     * @return static
     */
    public function getOwner(\Api\Input\Request\Horses\Profile\Owner\Index $request)
    {
        return \Phalcon\Mvc\Model\Row\General::createFromArray(
            [
               "owner_uid" => 8295,
               "owner_name" => " MRS S L HOBBS",
               "ptp_type_code" => "N",
               "silk" => "white and yellow stripes, yellow sleeves and cap.",
               "style_name" => " Mrs S L Hobbs",
               "silk_image_path" => "5/9/2/8295"
            ]
        );
    }

    /**
     * @param \Api\Input\Request\HorsesRequest $request
     *
     * @return static
     */
    public function getDefaultValues(\Api\Input\Request\HorsesRequest $request)
    {
        return \Phalcon\Mvc\Model\Row\General::createFromArray(
            [
                'country_code' => 'IRE',
                'race_type_code' => 'U',
            ]
        );
    }
}
