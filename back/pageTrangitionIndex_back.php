<?php
	// ログインIDがセットされている場合
	if(isset($_SESSION['user_serial_id'])){
		// トップページに戻る
		header('Location: ../content/top.php');
		exit();
	}
?>
