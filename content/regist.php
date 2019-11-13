<?php
	session_start();
	require_once(dirname(__FILE__).'/../back/pageTrangitionIndex_back.php');
	require_once(dirname(__FILE__).'/header.php');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">

<title>ログイン</title>
<link rel="stylesheet" type="text/css" href="../css/base_style.css">
</head>
<body>
<?php
	headerFunc();
?>
<?php 
	if($_GET['e'] == 1){
		print('<p style="color: red;">空の入力項目があります！</p>');
	}
	else if($_GET['e'] == 2){
		print('<p style="color: red;">パスワードが一致しません</p>');
	}
	else if($_GET['e'] == 3){
		print('<p style="color: red;">既にそのIDは利用されています</p>');
	}
?>
<form action="regist_back.php" method="post">
<h1>ID</h1>
<p><input type="text" name="user_name" size="40"></p>
<h1>Password</h1>
<p><input type="password" name="password1" size="40"></p>
<h1>もう一度</h1>
<p><input type="password" name="password2" size="40"></p>
<p><input type="submit" value="送信"><input type="reset" value="リセット"></p>

</form>
</body>
</html>
