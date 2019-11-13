<?php
// DBアクセス用関数を読み込む
require_once(dirname(__FILE__).'/dbconnection_getter.php');

// メンバー情報をデータベースにアクセスして探す関数
// 存在チェックバージョン
function getMemberInfo_check($themeID, $userID){
	$themeInfo = null;
	try{
	  //DB接続
	  $dbh = getPDOHide();

	  //SQL作成
	  $sql = "select user_serial_id from t_member where group_serial_id = (select group_serial_id from t_theme where theme_serial_id = ?) and user_serial_id = ?";

	  $stmt = $dbh->prepare($sql);

	  $stmt->bindParam(1, $themeID, PDO::PARAM_INT);
	  $stmt->bindParam(2, $userID, PDO::PARAM_INT);
	  $stmt->execute();

	  $values = $stmt->fetchAll(PDO::FETCH_ASSOC);

	  //SQL実行
	  foreach ($values as $row) {
		  $themeInfo = $row['user_serial_id'];
	  }

	}catch(PDOException $e){
		// 失敗したらnullを返す
		return null;
	}
	//データベースへの接続を閉じる
	$dbh = null;

	return $themeInfo;
}

// レビュー情報をデータベースにアクセスして探す関数
function getReviewInfo($themeID){
	$reviewInfo = array();
	try{
	  //DB接続
	  $dbh = getPDOHide();

	  //SQL作成
	  $sql = "select * from t_review where theme_serial_id = ?";

	  $stmt = $dbh->prepare($sql);

	  $stmt->bindParam(1, $themeID, PDO::PARAM_INT);
	  $stmt->execute();

	  $values = $stmt->fetchAll(PDO::FETCH_ASSOC);

	  //SQL実行
	  foreach ($values as $row) {
		  $buf['review_serial_id'] = $row['review_serial_id'];
		  $buf['review_post_time'] = $row['review_post_time'];
		  $buf['review_item_name'] = $row['review_item_name'];
		  $buf['review_title'] = $row['review_title'];
		  $buf['review_text'] = $row['review_text'];
		  $buf['theme_serial_id'] = $row['theme_serial_id'];
		  $buf['user_serial_id'] = $row['user_serial_id'];
		  array_push($reviewInfo, $buf);
	  }

	}catch(PDOException $e){
		// 失敗したらnullを返す
		return null;
	}
	//データベースへの接続を閉じる
	$dbh = null;

	return $reviewInfo;
}

// テーマ情報をデータベースにアクセスして探す関数
function getThemeInfo($themeID){
	$themeInfo = array();
	try{
	  //DB接続
	  $dbh = getPDOHide();

	  //SQL作成
	  $sql = "select * from t_theme where theme_serial_id = ?";

	  $stmt = $dbh->prepare($sql);

	  $stmt->bindParam(1, $themeID, PDO::PARAM_INT);
	  $stmt->execute();

	  $values = $stmt->fetchAll(PDO::FETCH_ASSOC);

	  //SQL実行
	  foreach ($values as $row) {
		  $themeInfo['theme_serial_id'] = $row['theme_serial_id'];
		  $themeInfo['theme_name'] = $row['theme_name'];
		  $themeInfo['theme_start'] = $row['theme_start'];
		  $themeInfo['theme_end'] = $row['theme_end'];
		  $themeInfo['theme_comment'] = $row['theme_comment'];
		  $themeInfo['theme_serial_id'] = $row['theme_serial_id'];
	  }

	}catch(PDOException $e){
		// 失敗したらnullを返す
		return null;
	}
	//データベースへの接続を閉じる
	$dbh = null;

	return $themeInfo;
}

?>
