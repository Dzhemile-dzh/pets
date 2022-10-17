<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 8/1/14
 * Time: 5:52 PM
 */

namespace Api;

/**
 * Class Config
 *
 * @package Api
 */
class Config extends \Phalcon\Config\Adapter\EnvironmentVariablesNew
{
    /**
     * @return array
     */
    public function getLoggerConfig()
    {
        if (isset($this->logger)) {
            return [
                'filename' => $this->logger->general->file,
                'level' => $this->logger->general->level
            ];
        } else {
            return [];
        }
    }
}
