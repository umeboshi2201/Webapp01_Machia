<?php
session_start();

// DBアクセス用関数を読み込む
require_once(dirname(__FILE__).'/dbconnection_getter.php');

// ユーザー情報をデータベースにアクセスして探す関数
function getUserInfo($userID){
	$userInfo = array();
	try{
	  //DB接続
	  $dbh = getPDOHide();

	  //SQL作成
	  $sql = "select * from t_user where user_str_id = ?";

	  $stmt = $dbh->prepare($sql);

	  $stmt->bindParam(1, $userID, PDO::PARAM_STR);
	  $stmt->execute();

	  $values = $stmt->fetchAll(PDO::FETCH_ASSOC);

	  //SQL実行
	  foreach ($values as $row) {
		  $userInfo['user_serial_id'] = $row['user_serial_id'];
		  $userInfo['user_str_id'] = $row['user_str_id'];
		  $userInfo['display_name'] = $row['display_name'];
		  $userInfo['password'] = $row['password'];
	  }

	}catch(PDOException $e){
		// 失敗したらnullを返す
		return null;
	}
	//データベースへの接続を閉じる
	$dbh = null;

	return $userInfo;
}

// パスワードをチェックする関数
function checkPassword($pass1, $pass2){
	// パスワードを比較して一致した場合
	if(strcmp($pass1, $pass2) == 0){
		// trueを返す
		return true;
	}
	// パスワードを比較して一致しなかった場合
	else{
		// falseを返す
		return false;
	}
	// 変な挙動したらfalseを返す
	return false;
}

// 入力された情報を変数に格納する
$userName = $_POST['user_name'];
$password = $_POST['password'];

// 入力されたIDでユーザー情報を探す
$userInfo = getUserInfo($userName);

// 入力されたIDが存在しない場合
if(is_null($userInfo) || (strcmp($userInfo, '') != 0) || count($userInfo) == 0){
	// ログインページに戻る
	header('Location: ../content/login.php?e=1');
	// ここでスクリプトを終了する
	exit();
}

// パスワードが一致しなかった場合
if(!checkPassword($userInfo['password'], $password)){
	// ログインページに戻る
	header('Location: ../content/login.php?e=1');
	// ここでスクリプトを終了する
	exit();
}

// ユーザー情報をセッションに格納
$_SESSION['user_serial_id'] = $userInfo['user_serial_id'];
$_SESSION['user_str_id'] = $userInfo['user_str_id'];
$_SESSION['display_name'] = $userInfo['display_name'];

// トップページに戻る
header('Location: ../content/index.php');
// ここでスクリプトを終了する
exit();

//// 以下テスト用コード　あとで消す
//if(isset($_POST['user_name'])){
//	$userName = $_POST['user_name'];
//	print("<p>".$userName."<p>");
//}
//else{
//	header('Location: login.php');
//	// ここでスクリプトを終了する
//	exit();
//}
//
//if(isset($_POST['password'])){
//	$password = $_POST['password'];
//	print($password);
//}
//else{
//	header('Location: login.php');
//	// ここでスクリプトを終了する
//	exit();
//}
?>
