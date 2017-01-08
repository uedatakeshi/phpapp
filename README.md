# phpapp

Development template for tiny php application

    cd lib
    php ../composer.phar install
    npm install
    npm install webpack -g

autoloadだけ書き換えた時は、

    php ../composer.phar dumpautoload

jsはlib/js/main.jsがentryでlib直下で

    webpack

コマンドでビルド。
