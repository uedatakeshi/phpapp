<?php
require_once __DIR__ . '/inc/bootstrap.php';
logger()->debug('message', ['env' => $_ENV['MY_PHP_ENV']]);

/*
 * 自作クラス namespace なしだとuseする必要なし
 */
$form = new Form();
//$form->index();
$data = array(
    'name' => "wakada",
    'yomi' => "ooooo"
);
//$form->save($data);

//var_dump($form->getOne());


$data = array(
    'users' => $form->yieldTwo(), 
    'php_env' => $_ENV['MY_PHP_ENV'], 
    'name' => $_ENV['NAME']
);

$template = $twig->load('admin/index.html');
$template->display($data);
