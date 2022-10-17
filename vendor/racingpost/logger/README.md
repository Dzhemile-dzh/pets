#INSTALLATION

Just add line like "racingpost/logger": "0.01" into section "require" of project`s composer.json file.<br>
Also you should add repository with "racingpost/logger" into section "repositories"

###Example

    "repositories": [
        {
            "type": "vcs",
            "url":  "ssh://git@stash.rp-dev.com:7999/api/logger.git"
        }
    ],

    "require": {
        "php": ">=5.4",
        "racingpost/logger": "0.01"
    },
    
    
<br><br>

    
#MANUAL

This library is just wrapper for "Phalcon Logger"

##Methods

<br><br>

###public function __construct(mixed $configuration = null)

Constructor for class \Rp\Logger


<br><br>

###Methods to write logs
**public function trace(string $message [, mixed $args [, mixed $... ]])**<br>
**public function debug(string $message [, mixed $args [, mixed $... ]])**<br>
**public function info(string $message [, mixed $args [, mixed $... ]])**<br>
**public function warning(string $message [, mixed $args [, mixed $... ]])**<br>
**public function error(string $message [, mixed $args [, mixed $... ]])**<br>
**public function fatal(string $message [, mixed $args [, mixed $... ]])**<br>
**public function emergency(string $message [, mixed $args [, mixed $... ]])**<br>

Those methods write logs with appropriate level<br>
Now they works like function sprintf (http://php.net/manual/ru/function.sprintf.php)


<br><br>


##Example


Config example

    $config = [
      'filename' => 'path to file',
      'level' => 'SPECIAL',
      'options' => [
          'mode' => 'ab'
      ],
  ];

Way to get logger

    $logger = new \Rp\Logger($config);

Logging messages
    
    $logger->debug("debug message");
    
    $logger->warning("warning message %s", $stringVariable);
    
    
