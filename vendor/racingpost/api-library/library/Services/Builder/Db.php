<?php

namespace Api\Services\Builder;

use Phalcon\Db\Adapter\Sybase as SybaseAdapter;
use Phalcon\Db\Adapter\SybaseAccessor\Redis as SybaseAccessor;
use Phalcon\Db\Adapter\SybaseAccessor\ValidationException as SybaseValidationException;

class Db
{
    /**
     * @param \Phalcon\DI $di
     *
     * @return \Phalcon\Db\Adapter\Sybase
     */
    public function build(\Phalcon\DI $di)
    {
        $eventsManager = new \Phalcon\Events\Manager();
        $config = $di->getConfig();

        if ($di->get('environment')->isProfileSqlQueries()
            || (isset($config->logger) && in_array($config->logger->general->level, ['DEBUG', 'TRACE']))
        ) {
            //Listen all the database events
            $eventsManager->attach('db', function ($event, $connection) use ($di) {
                if ($event->getType() == 'beforeQuery') {
                    $di->getProfiler()->startProfile($connection->getSQLBindedStatement());
                }

                $profile = $di->getProfiler()->getLastProfile();

                if ($profile) {
                    $extraSymbols = ['\0020', '\003a', 'U&'];
                    $query = str_replace($extraSymbols, ' ', $profile->getSQLStatement());

                    if ($event->getType() == 'afterQuery') {
                        $di->getProfiler()->stopProfile();
                        $queryTime = round($profile->getTotalElapsedSeconds(), 4);

                        ob_start();
                        debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
                        $trace = ob_get_contents();
                        ob_end_clean();

                        if ($di->getShared('environment')->isShowDetailedErrors()) {
                            $di->get('logger')->debug("query: {$query} Performance: ({$queryTime} sec)");
                        }
                    }
                }
            });
        }

        try {
            SybaseAdapter::setAccess(new SybaseAccessor($config));
        } catch (SybaseValidationException $e) {
            $di->get('logger')->debug("Redis: {$e->getMessage()}");
        }

        $connection = new SybaseAdapter([
            "servername" => $config->database->servername,
            "username" => $config->database->username,
            "password" => $config->database->password,
            "dbname" => $config->database->name,
            "persistent" => $config->database->persistent,
            "usePreparedStatements" => isset($config->database->usePreparedStatements) ? $config->database->usePreparedStatements : false,
            "newConnection" => isset($config->database->newConnection) ? $config->database->newConnection : false,
            "charset" => "utf8"
        ]);

        //Assign the eventsManager to the db adapter instance
        $connection->setEventsManager($eventsManager);
        return $connection;
    }
}
