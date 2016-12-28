<?php
require_once __DIR__ . '/../../../lib/vendor/autoload.php';
use Aura\Sql\ExtendedPdo;
use Aura\Sql\Profiler;

/*
 * dotenv の設定
 * load()しておくことでgetenvでどこからでも取り出せる
 * getenv('MY_PHP_ENV');
 *
 */
if (file_exists(__DIR__ . '/../.env')) {
	$dotenv = new \Dotenv\Dotenv(__DIR__ . '/../');
	$dotenv->load();
	$dotenv->required(['NAME']);
}

/*
 * whoops の設定
 * developの時のみwhoops画面にする
 * productionモードでは一切出さない
 */
if (is_production()) {
    // 全てのエラー報告をオフにする
    error_reporting(0);
    // エラー情報が画面に出力されないようにする
    ini_set('display_errors', '0');

} else {
    // 全てのエラー出力を有効にする
    error_reporting(E_ALL);
    // 未定義変数などが多い場合はE_NOTICEを警告しないように設定
    // error_reporting(E_ALL & ~E_NOTICE);

    // コマンドラインから実行されたときはテキスト形式で出力
    $whoops_handler = new \Whoops\Handler\PrettyPageHandler;
	$whoops = new \Whoops\Run;
	$whoops->pushHandler($whoops_handler);
	$whoops->register();
}

/*
 * 開発モードの時はdevelopment.log にデバッグ出力できる。
 * logger()->debug('message', array()); というように書いた場所で出力される
 * productionモードの時はerrorのもののみアパッチのログに出力される
 * logger()->error('message', array()); というように書く
 */

$monolog_handlers = [];
if (is_production()) {
    ini_set("log_errors", "1");
    $monolog_handlers[] = new \Monolog\Handler\ErrorLogHandler(0, \Monolog\Logger::ERROR);
} else {
    $log_file = __DIR__ . "/../../../log/{$_ENV['MY_PHP_ENV']}.log";
    $monolog_handlers[] = new \Monolog\Handler\StreamHandler($log_file, \Monolog\Logger::DEBUG);
    $monolog_handlers[] = new \Monolog\Handler\FirePHPHandler(\Monolog\Logger::DEBUG);
}
$monolog = new \Monolog\Logger('admin', $monolog_handlers);
logger($monolog);

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem(__DIR__ . '/../../../twig/templates');
if (is_production()) {
	$option = array(
		'cache' => __DIR__ . '/../../../twig/compilation_cache',
		'auto_reload' => true,
		'debug' => false
	);
} else {
	$option = array(
		'cache' => false,
		'debug' => true
	);
}
$twig = new Twig_environment($loader, $option);

$pdo = new ExtendedPdo(
    'mysql:host=localhost;dbname=sample_db',
    'root',
    'pass123',
    array(), // driver options as key-value pairs
    array()  // attributes as key-value pairs
);
$prof = new Profiler();
$pdo->setProfiler($prof);
