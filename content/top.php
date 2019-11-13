<?php
	session_start();
	require_once(dirname(__FILE__).'/../back/pageTrangitionTop_back.php');
	require_once(dirname(__FILE__).'/header.php');
	require_once(dirname(__FILE__).'/../back/top_back.php');
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
	topHeaderFunc();
?>
<h1>ようこそ</h1>
<div>
<h3>所属グループ</h3>
<?php
	foreach(getGroupInfo($_SESSION['user_serial_id']) as $data){
		print('<a href="./group.php?groupid='.$data['group_serial_id'].'">'.$data['group_name']."</a><br />");
	}
?>
</div>

</body>
</html>
