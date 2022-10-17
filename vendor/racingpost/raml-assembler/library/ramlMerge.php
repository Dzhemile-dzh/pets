<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 12/5/2015
 * Time: 12:59 PM
 */

/**
 * @description This script you can use to generate common RAML file. Main logic
 *              of this file was obtained from https://github.com/mikestowe/php-ramlMerge
 *              with modification regarding specific of our project
 *
 * @usage
 *              php /path/to/ramlMerge.php /path/to/index.raml > /path/to/compiledAPIRAML.raml
 * @author      Michael Stowe (https://github.com/mikestowe/php-ramlMerge)
 * @param        $file
 * @param string $relative
 * @param string $tabIndex
 *
 * @return mixed|string
 * @throws Exception
 */

function doInclude($file, $relative = '/', $tabIndex = '')
{
    $contents = @file_get_contents($file);
    if (!$contents) {
        $contents = @file_get_contents(BASE_PATH . $file);
    }

    if (!$contents) {
        throw new Exception(sprintf("File with path: '%s' is not found.", $file));
    }

    if ($tabIndex) {
        $contents = $tabIndex . str_replace("\n", $tabIndex, $contents);
    }
    $contents = preg_replace_callback(
        '/(([\s]*)([-_a-z0-9\/{}?]+)):\s+\!include ([^\s]+)/i',
        function ($matches) use ($relative) {
            
            $property = $matches[3];
            $spacing = $matches[2];
            if (strpos($matches[4], "/")) {
                $matchEx = explode("/", $matches[4]);
                $file = array_pop($matchEx);
                $relativePath = $relative . implode("/",$matchEx) . "/";
            } else {
                $file = $matches[4];
                $relativePath = $relative;
            }

            if (!preg_match("/^((https?:\/\/)|\/)/i", $file)) {
                $file = BASE_PATH . $relativePath . $file;
            }

            $i = 0;
            $cap = ": | \n";
            $subContent = doInclude($file, $relativePath, $spacing . "    ");
            $subLines = explode("\n", $subContent);

            while (isset($subLines[$i]) && !preg_match("/[^\s]/i", $subLines[$i])) {
                $i++;
            }

            if (strpos($subLines[$i], ':') && preg_match("/(:\s*('|\")(.+)('|\"))*/", $subLines[$i])) {
                $cap = ":\n";
            }

            return $spacing . $property . $cap . $subContent;
        },
        $contents
    );

    return $contents;
}

try {
    $file = $argv[1];
    define('BASE_PATH', dirname($file));

    $content = doInclude($file);
    $content = preg_replace("/^([\s]*?[\r]?\n)+/Um", "", $content);
    echo $content . sprintf("\n\n#File was compiled at %s", date("F j, Y, g:i a")) ;

} catch (Exception $e) {

    echo sprintf("\nAn exception raised during file compilation at %s\n\n\n", date("F j, Y, g:i a")) . $e->getMessage();
    exit(1);
}
