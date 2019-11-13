<?php
	// ログインIDがセットされていない場合
	if(!isset($_SESSION['user_serial_id'])){
		// インデックスに戻る
		header('Location: ../content/index.php');
		exit();
	}
?>
