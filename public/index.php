<?php

define("PRODUCT_KEY", 'HORSES_API');
define("PRODUCT_VERSION", '2');

/**
 * Setup cache
 */
//TODO remove this very bad hardcode when apache config will be changed
if (!empty($_GET['_url']) && $_GET['_url'][0] != '/') {
    $_GET['_url'] = '/' . $_GET['_url'];
}

try {
    define('ROOT_DIR', realpath(__DIR__ . '/../'));

    require ROOT_DIR . "/vendor/autoload.php";
    require ROOT_DIR . '/config/services.php';

    (new RP\ErrorHandler($di->get('logger')))->register();

    $tracer = \Phalcon\Di::getDefault()->getShared('tracer');

    /**
     * Starting the application
     */
    $app = new \Phalcon\Mvc\Application($di);
    $app->useImplicitView(false);
    $content = $app->handle()->getContent();
    $tracer->setTagForRootSpan('response_size', (int) strlen($content));
    echo $content;
} catch (\Exception $e) {
    /** @var $view \Phalcon\Mvc\View\Simple */
    /** @var $response \Phalcon\Http\Response */

    if ($e instanceof \Api\Exception\Base) {
        // The http return status is set differently for some exceptions
        $statusCode = $e->getStatus();
    } else {
        $statusCode = $e->getCode();
    }

    $tracer->setHttpStatus($statusCode);

    // if the response is empty or a validation error occurs then it's not an error
    if ($statusCode == 400 || $statusCode == 404) {
        $di->get('logger')->warning($e);
    } else {
        $tracer->setErrorForRootSpan($e);
        $di->get('logger')->error($e);
    }


    if (!($e instanceof \Api\Exception\Base)) {
        if ($di->getShared('environment')->isShowDetailedErrors()) {
            /**
             * display expanded error info
             */
            $response = $app->getDI()->getShared("response");
            $response->setContentType('text/html');
            $response->sendHeaders();

            $run = new \Whoops\Run;

            $handler = new \Whoops\Handler\PrettyPageHandler;
            $handler->addResourcePath(ROOT_DIR . "/public");
            $handler->addCustomCss("/css/debug.css");

            $run->pushHandler($handler);
            $run->register();
            $run->handleException($e);
        } else {
            $e = new \Api\Exception\InternalServerError(1);
        }
    }

    $dispatcher = $di->getDispatcher();
    $isXmlErrorFormat = $dispatcher->getParam('xmlErrors');

    //When the error is not from Bad request xmlErrors param go to IncomingNamedParameters
    if (!$isXmlErrorFormat) {
        $params = $dispatcher->getParams();
        //If it is a bad request error and format is not xml params[0] is string not object
        if (isset($params[0])) {
            $namedParams = gettype($params[0]) == 'string' ? array() : $params[0]->getIncomingNamedParameters();
            $isXmlErrorFormat = array_key_exists('xmlErrors', $namedParams) ? $namedParams['xmlErrors'] : null;
        }
    }

    $resultType = $isXmlErrorFormat ? \Api\Result\Error::XML : \Api\Result\Error::JSON;

    $result = new \Api\Result\Error($resultType, $e);

    $response = $app->getDI()->getShared("response");
    $response->setStatusCode($e->getStatus(), $e->getStatusMessage());
    $response->setContentType($result->getContentType());
    $response->setHeader("Access-Control-Allow-Origin", "*");
    $response->setContent($result->getContent());
    $response->send();
} finally {
    $tracer->finalise();
}
