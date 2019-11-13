<?php
function headerFunc(){
	// ログインIDがセットされていない場合
	if(!isset($_SESSION['user_serial_id'])){
		print('<header class="main-header">');
		print('<div class="main-header-item"><a href="index.php">トップ</a></div>');
		print('<div class="main-header-item"><a href="login.php">ログイン</a></div>');
		print('</header>');
		print('<hr />');
	}
	return;
}

function topHeaderFunc(){
	// ログインIDがセットされている場合
	if(isset($_SESSION['user_serial_id'])){
		print('<header class="main-header">');
		print('<div class="main-header-item"><a href="index.php">トップ</a></div>');
		print('<div class="main-header-item"><a href="login.php">'.$_SESSION['display_name'].'様</a></div>');
		print('<div class="main-header-item"><a href="logout_back.php">ログアウト</a></div>');
		print('</header>');
		print('<hr />');
	}
	return;
}
?>
