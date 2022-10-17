#INSTALLATION

Just add line like "racingpost/error-handler": "0.*" into section "require" of project`s composer.json file.<br>
Also you should add repository with "racingpost/error-handler" into section "repositories"

###Example

    "repositories": [
        {
            "type": "vcs",
            "url":  "ssh://git@stash.rp-dev.com:7999/api/error-handler.git"
        }
    ],

    "require": {
        "php": ">=5.4",
        "racingpost/error-handler": "0.*"
    },


##Dependencies

racingpost/logger (ssh://git@stash.rp-dev.com:7999/api/logger.git)

<br><br>


#MANUAL

This library is able to register shutdown function that will use racingpost/logger to log every errors with it's corresponding error level.<br>
It requires valid instance of \Rp\logger.


##Methods


###public function __construct(\Rp\Logger $di)

Constructor for class \Rp\ErrorHandler<br>
Setup handler instance with logger component

<br><br>

###public function register()

Register shutdown function

##Example

Simple usage

    (new Rp\ErrorHandler($di->get('logger')))->register();
