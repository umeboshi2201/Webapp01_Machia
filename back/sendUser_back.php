<?php
	// ログインIDがセットされている場合
	if(isset($_SESSION['user_serial_id'])){
		// トップページに戻る
		header('Location: ../content/top.php');
	}
	// ログインIDがセットされていない場合
	else{
		header('Location: ../content/index.php');
	}
?>
