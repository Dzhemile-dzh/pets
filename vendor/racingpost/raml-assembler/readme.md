#INSTALLATION

Just add line like "racingpost/raml-assembler": "0.*" into section "require" of project`s composer.json file.<br>
Also you should add repository with "racingpost/raml-assembler" into section "repositories"

###Example

    "repositories": [
        {
            "type": "vcs",
            "url":  "ssh://git@stash.rp-dev.com:7999/api/raml-assembler.git"
        }
    ],

    "require": {
        "php": ">=5.4",
        "racingpost/raml-assembler": "0.*"
    },



<br><br>


#MANUAL

This library is able to generate common RAML file from source RAML files.<br>


###ramlMerge.php

The script accepts one parameter - path to root RAML file and it prints outcome in stdout.<br>

<br><br>

##Example

Simple usage

    php /path/to/ramlMerge.php /path/to/index.raml > /path/to/compiledAPIRAML.raml