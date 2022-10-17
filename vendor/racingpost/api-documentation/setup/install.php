<?php

$precommit = './.git/hooks/pre-commit';

$hook = "
OUTPUTDOC=\$(php ./documentation/buildSwagger.php)
RETVALDOC=\$?

if [ \$RETVALDOC -ne 0 ]; then
    echo \"\$OUTPUTDOC\"
    exit \$RETVALDOC
fi
    
OUTPUTDOC=\$(java -jar ./vendor/racingpost/api-documentation/bin/swagger-validator.jar ./public/index.swagger)
RETVALDOC=$?

if [ \$RETVALDOC -ne 0 ]; then
    echo \"\$OUTPUTDOC\"
    exit \$RETVALDOC
fi

rm -f ./public/index.swagger

";

if (file_exists($precommit)) {
    $content = file_get_contents($precommit);
    $pos = strpos($content, 'PHPCS_BIN');

    $content = substr_replace($content, $hook, $pos, 0);
    file_put_contents($precommit, $content);
} else {
    $content = $hook . "
exit 0   
    ";
}

file_put_contents($precommit, $content);
