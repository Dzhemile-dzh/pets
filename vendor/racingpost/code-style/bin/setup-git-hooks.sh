#!/bin/bash

if [ -f ./vendor/racingpost/code-style/git-hooks/pre-commit ] && [ -f ./vendor/racingpost/code-style/git-hooks/pre-commit.config ] && [ -d .git/hooks ]; then

   ln -s -f ../../vendor/racingpost/code-style/git-hooks/pre-commit .git/hooks/pre-commit &&
   ln -s -f ../../vendor/racingpost/code-style/git-hooks/pre-commit.config .git/hooks/pre-commit.config &&
   chmod 774 .git/hooks/pre-commit

else
    >&2 echo 'Not all needed directories exist'
    exit 1
fi

