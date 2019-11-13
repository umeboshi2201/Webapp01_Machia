<?php
	session_start();
	require_once(dirname(__FILE__).'/../back/pageTrangitionTop_back.php');
	require_once(dirname(__FILE__).'/header.php');
	require_once(dirname(__FILE__).'/../back/group_back.php');

	// 存在チェック
	$memberInfo = getMemberInfo_check($_GET['groupid'], $_SESSION['user_serial_id']);
	// 該当するデータが存在しない場合（それは大体不正なURLで入ろうとした場合）
	if(count($memberInfo) <= 0){
		// トップページに戻る
		header('Location: ../content/top.php');
		// ここでスクリプトを終了する
		exit();
	}

	// データ取得
	$memberInfo = getMemberInfo($_GET['groupid']);
	$groupName = getGroupName($_GET['groupid']);
	$themeInfo = getThemeInfo($_GET['groupid']);
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
<div>
<h1><?php echo $groupName['group_name'] ?></h1>
<h2>メンバー</h2>
<?php
	foreach($memberInfo as $data){
		print('<a href="#">'.$data['display_name']."</a><br />");
	}
?>
<h2>テーマ</h2>
<?php
	foreach($themeInfo as $data){
		print('<a href="theme.php?themeid='.$data['theme_serial_id'].'">'.$data['theme_name']."</a>　投稿者:".$data['display_name']."<br />");
	}
?>
</div>

</body>
</html>
