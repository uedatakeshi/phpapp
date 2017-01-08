<?php
require_once __DIR__ . '/inc/bootstrap.php';
logger()->debug('message', ['env' => $_ENV['MY_PHP_ENV']]);

/*
 * 自作クラス namespace なしだとuseする必要なし
 */
$form = new Form($pdo);
//$form->index();
$data = array(
    'name' => "wakada",
    'yomi' => "ooooo"
);
var_dump($form->save($data));


$pdo->getProfiler()->setActive(true);
$array = array('ueda');
$query = 'SELECT * FROM users WHERE id IN (:id)';
$bind = [
    'id' => [1,2]
];

// the statement to prepare
$result = $pdo->fetchAll($query, $bind);

//var_dump($result);

foreach ($pdo->yieldAssoc($query, $bind) as $key => $row) {
    // ...
//	echo $key;
//	var_dump($row);
}



foreach ($pdo->getProfiler()->getProfiles() as $i => $profile) {
//	var_dump($profile);
}

$template = $twig->load('admin/index.html');
//echo $template->render(array('php_env' => $_ENV['MY_PHP_ENV']));
$data = array('php_env' => $_ENV['MY_PHP_ENV'], 'name' => $_ENV['NAME']);
//echo $template->render(array('php_env' => $_ENV['MY_PHP_ENV'], 'name' => $_ENV['NAME']));
//$template->display($data);
?>
<!DOCTYPE html>
<head>
<title>WEB+DB PRESS Vol.96 PHP大規模開発入門 第17回 サンプルコード</title>
</head>
<body>
<div id="demo">
  <div>{{message}}</div>
  <input v-model="message">
</div>
<script type="text/javascript" src="js/bundle.js" charset="utf-8"></script>
<h1>PHP大規模開発入門 第17回 サンプルコード</h1>
<h2>脆弱性のあるコード例</h2>
<ul>
    <li><a href="/vuln/xss.php"><abbr title="cross site scripting">XSS</abbr></a></li>
</ul>

<h2>開発環境</h2>
<ul>
    <li><a href="/greeting.php">PsySHを使ったデバッグ</a></li>
    <li><a href="./raise_error.php">エラーを発生させる</a></li>
    <li><a href="/log_viewer.php">エラーログビューア</a></li>
</ul>

<hr>
<?php if (isset($_ENV['MY_PHP_ENV'])): ?>
    <p>現在の環境は<code><?= h($_ENV['MY_PHP_ENV']) ?></code>です。</p>
<?php else: ?>
    <p><code>$_ENV['MY_PHP_ENV']</code>がセットされてません。<code class="file">.env</code>ファイルを作成してください。</p>
<?php endif; ?>
</body>
</html>
