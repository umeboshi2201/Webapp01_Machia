<?php
	session_start();
	require_once(dirname(__FILE__).'/../back/pageTrangitionTop_back.php');
	require_once(dirname(__FILE__).'/header.php');
	require_once(dirname(__FILE__).'/../back/theme_back.php');

	// 存在チェック
	$memberInfo = getMemberInfo_check($_GET['themeid'], $_SESSION['user_serial_id']);
	// 該当するデータが存在しない場合（それは大体不正なURLで入ろうとした場合）
	if(count($memberInfo) <= 0){
		// トップページに戻る
		header('Location: ../content/top.php');
		// ここでスクリプトを終了する
		exit();
	}
	$themeInfo = getThemeInfo($_GET['themeid']);
	$reviewInfo = getReviewInfo($_GET['themeid']);
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
<h1><?php echo $themeInfo['theme_name'] ?></h1>
<h3><?php echo $themeInfo['theme_start'] ?>  ～ <?php echo $themeInfo['theme_end'] ?></h1>
<p><?php echo $themeInfo['theme_comment'] ?></p>

<h1>レビュー</h1>
<?php
	foreach($reviewInfo as $data){
		print('<h2>'.$data['review_item_name'].'</h2>');
		print('<h2>'.$data['review_title'].' 投稿日:'.$data['review_post_time'].'</h2>');
		print('<p>'.$data['review_text'].'</p>');
		print('<p><a href="./review.php?reviewid='.$data['review_serial_id'].'">'.'このレビューへの感想'."</a></p>");
	}
?>
</div>

</body>
</html>
