racingpost/code-style is library to check code style for racigpost projects

This library uses codesniffer and git hooks to check code style before commits.

Original hooks were taken from https://github.com/s0enke/git-hooks

To install this library into your project you should add lines like
    "require-dev": {
        "racingpost/code-style": "0.01"
    }
into project's composer.json

If library is installed you should add git hooks from code-style/git-hooks

Or you just can add lines
    "scripts": {
        "post-autoload-dump" : [
            "sh -c 'test -f ./vendor/bin/setup-git-hooks.sh && ./vendor/bin/setup-git-hooks.sh || test ! -f ./vendor/bin/setup-git-hooks.sh'"
        ]
    }
into project's composer.json
These instructions change git hooks from your project by hooks from code-style.

Notice: Command sh -c '' was used because on windows git shell command test doesn't work correctly. But if use test in sh -c '' one works fine.


For integration codesniffer with PHPStorm use the article http://confluence.jetbrains.com/display/PhpStorm/PHP+Code+Sniffer+in+PhpStorm


Links
https://github.com/squizlabs/PHP_CodeSniffer
https://github.com/s0enke/git-hooks
http://confluence.jetbrains.com/display/PhpStorm/PHP+Code+Sniffer+in+PhpStorm