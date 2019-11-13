<?php
	session_start();
	require_once(dirname(__FILE__).'/../back/pageTrangitionTop_back.php');
	require_once(dirname(__FILE__).'/header.php');
	require_once(dirname(__FILE__).'/../back/review_back.php');

	// 存在チェック
	$memberInfo = getMemberInfo_check($_GET['reviewid'], $_SESSION['user_serial_id']);
	// 該当するデータが存在しない場合（それは大体不正なURLで入ろうとした場合）
	if(count($memberInfo) <= 0){
		// トップページに戻る
		header('Location: ../content/top.php');
		// ここでスクリプトを終了する
		exit();
	}

	$reviewInfo = getReviewInfo($_GET['reviewid']);
	$impressInfo = getImpressInfo($_GET['reviewid']);
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
<h1><?php echo $reviewInfo['review_item_name'] ?></h1>
<h3><?php echo $reviewInfo['review_title'] ?></h1>

<h1>感想一覧</h1>
<?php
	foreach($impressInfo as $data){
		print('<h2>'.$data['display_name'].' score:'.$data['impress_score'].'</h2>');
		print('<p>'.$data['impress_text'].'</p>');
	}
?>
</div>

</body>
</html>
