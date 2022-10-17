<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 12/16/2016
 * Time: 1:35 PM
 */

namespace Api\DataProvider\Bo\Profile;

/**
 * Interface DefaultInfo is dedicated for using by Profile's classes
 * to retrieve default information of entity.
 *
 * @package Api\DataProvider\Bo\Profile
 */
interface DefaultInfo
{
    /**
     * The method derives default info of entity by ID
     *
     * @param int    $id
     * @param string $countryCode
     * @param array  $raceTypeCodes
     *
     * @return \Phalcon\Mvc\ModelInterface|null
     */
    public function get($id, $countryCode, array $raceTypeCodes);
}
