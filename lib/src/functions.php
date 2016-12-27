<?php

// このファイルは composer.json から読み込まれるので、requireしてはいけません。

/**
 * @author  USAMI Kenta <tadsan@zonu.me>
 * @license https://opensource.org/licenses/MIT MIT
 */


use Monolog\Logger;

/** @return bool */
function is_production()
{
     return getenv('MY_PHP_ENV') === 'production';
}

/**
 * 文字列をHTMLエスケープします
 */
function h($s)
{
    return htmlspecialchars($s, ENT_QUOTES);
}

/**
 * ロガーのインスタンスを返す
 *
 * logger()->warn
 *
 * @param  \Monolog\Logger $logger
 * @return \Monolog\Logger
 */
function logger(\Monolog\Logger $new_logger = null)
{
    static $logger;

    if ($new_logger !== null) {
        $logger = $new_logger;
    }

    return $logger;
}
