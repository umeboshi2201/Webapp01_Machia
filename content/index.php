<?php
	session_start();
	require_once(dirname(__FILE__).'/../back/pageTrangitionIndex_back.php');
	require_once(dirname(__FILE__).'/header.php');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">

<title>ようこそ</title>
<link rel="stylesheet" type="text/css" href="../css/base_style.css">
</head>
<body>
<?php
	// もしログインしていたらtopへ飛ばされる
	headerFunc();
?>
<h1>ようこそ</h1>
<div>
	<a href="regist.php">新規登録</a> <a href="login.php">ログイン</a>
</div>

</body>
</html>
