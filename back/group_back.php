<?php
// DBアクセス用関数を読み込む
require_once(dirname(__FILE__).'/dbconnection_getter.php');

// テーマ情報をデータベースにアクセスして探す関数
function getThemeInfo($groupID){
	$themeInfo = array();
	try{
	  //DB接続
	  $dbh = getPDOHide();

	  //SQL作成
	  $sql = "select display_name, t_user.user_serial_id, theme_serial_id, theme_name from t_user, t_theme where t_user.user_serial_id = t_theme.user_serial_id and group_serial_id = ?";

	  $stmt = $dbh->prepare($sql);

	  $stmt->bindParam(1, $groupID, PDO::PARAM_INT);
	  $stmt->execute();

	  $values = $stmt->fetchAll(PDO::FETCH_ASSOC);

	  //SQL実行
	  foreach ($values as $row) {
		  $buf = array();
		  $buf['user_serial_id'] = $row['user_serial_id'];
		  $buf['display_name'] = $row['display_name'];
		  $buf['group_serial_id'] = $row['group_serial_id'];
		  $buf['theme_serial_id'] = $row['theme_serial_id'];
		  $buf['theme_name'] = $row['theme_name'];
		  array_push($themeInfo, $buf);
	  }

	}catch(PDOException $e){
		// 失敗したらnullを返す
		return null;
	}
	//データベースへの接続を閉じる
	$dbh = null;

	return $themeInfo;
}

// グループ情報をデータベースにアクセスして探す関数
function getGroupName($groupID){
	$groupInfo = array();
	try{
	  //DB接続
	  $dbh = getPDOHide();

	  //SQL作成
	  $sql = "select group_name from t_group where group_serial_id = ?";

	  $stmt = $dbh->prepare($sql);

	  $stmt->bindParam(1, $groupID, PDO::PARAM_INT);
	  $stmt->execute();

	  $values = $stmt->fetchAll(PDO::FETCH_ASSOC);

	  //SQL実行
	  foreach ($values as $row) {
		  $groupInfo['group_name'] = $row['group_name'];
	  }

	}catch(PDOException $e){
		// 失敗したらnullを返す
		return null;
	}
	//データベースへの接続を閉じる
	$dbh = null;

	return $groupInfo;
}

// メンバー情報をデータベースにアクセスして探す関数
function getMemberInfo($groupID){
	$memberInfo = array();
	try{
	  //DB接続
	  $dbh = getPDOHide();

	  //SQL作成
	  $sql = "select user_serial_id, display_name, user_str_id from t_user where user_serial_id in (select user_serial_id from t_member where group_serial_id = ?) order by user_serial_id";

	  $stmt = $dbh->prepare($sql);

	  $stmt->bindParam(1, $groupID, PDO::PARAM_INT);
	  $stmt->execute();

	  $values = $stmt->fetchAll(PDO::FETCH_ASSOC);

	  //SQL実行
	  foreach ($values as $row) {
		  $buf = array();
		  $buf['user_serial_id'] = $row['user_serial_id'];
		  $buf['user_str_id'] = $row['user_str_id'];
		  $buf['display_name'] = $row['display_name'];
		  array_push($memberInfo, $buf);
	  }

	}catch(PDOException $e){
		// 失敗したらnullを返す
		return null;
	}
	//データベースへの接続を閉じる
	$dbh = null;

	return $memberInfo;
}

// メンバー情報をデータベースにアクセスして探す関数
// 存在チェックバージョン
function getMemberInfo_check($groupID, $userID){
	$memberInfo = array();
	try{
	  //DB接続
	  $dbh = getPDOHide();

	  //SQL作成
	  $sql = "select * from t_member where group_serial_id = ? and user_serial_id = ?";

	  $stmt = $dbh->prepare($sql);

	  $stmt->bindParam(1, $groupID, PDO::PARAM_INT);
	  $stmt->bindParam(2, $userID, PDO::PARAM_INT);
	  $stmt->execute();

	  $values = $stmt->fetchAll(PDO::FETCH_ASSOC);

	  //SQL実行
	  foreach ($values as $row) {
		  $buf = array();
		  $buf['member_serial_id'] = $row['member_serial_id'];
		  $buf['user_serial_id'] = $row['user_serial_id'];
		  $buf['group_serial_id'] = $row['group_serial_id'];
		  array_push($memberInfo, $buf);
	  }

	}catch(PDOException $e){
		// 失敗したらnullを返す
		return null;
	}
	//データベースへの接続を閉じる
	$dbh = null;

	return $memberInfo;
}

?>
