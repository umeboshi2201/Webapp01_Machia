<?php
// DBアクセス用関数を読み込む
require_once(dirname(__FILE__).'/dbconnection_getter.php');

// メンバー情報をデータベースにアクセスして探す関数
// 存在チェックバージョン
function getMemberInfo_check($reviewID, $userID){
	$reviewInfo = null;
	try{
	  //DB接続
	  $dbh = getPDOHide();

	  //SQL作成
	  $sql = "select user_serial_id from t_member where group_serial_id = (select group_serial_id from t_theme where theme_serial_id = (select theme_serial_id from t_review where review_serial_id = ?)) and user_serial_id = ?";

	  $stmt = $dbh->prepare($sql);

	  $stmt->bindParam(1, $reviewID, PDO::PARAM_INT);
	  $stmt->bindParam(2, $userID, PDO::PARAM_INT);
	  $stmt->execute();

	  $values = $stmt->fetchAll(PDO::FETCH_ASSOC);

	  //SQL実行
	  foreach ($values as $row) {
		  $reviewInfo = $row['user_serial_id'];
	  }

	}catch(PDOException $e){
		// 失敗したらnullを返す
		return null;
	}
	//データベースへの接続を閉じる
	$dbh = null;

	return $reviewInfo;
}

// レビュー情報をデータベースにアクセスして探す関数
function getImpressInfo($reviewID){
	$impressInfo = array();
	try{
	  //DB接続
	  $dbh = getPDOHide();

	  //SQL作成
	  $sql = "select impress_serial_id, impress_score, impress_post_time, impress_text, impress_buy_will, review_serial_id, t_impress.user_serial_id, display_name from t_impress, t_user where review_serial_id = ? and t_impress.user_serial_id = t_user.user_serial_id";

	  $stmt = $dbh->prepare($sql);

	  $stmt->bindParam(1, $reviewID, PDO::PARAM_INT);
	  $stmt->execute();

	  $values = $stmt->fetchAll(PDO::FETCH_ASSOC);

	  //SQL実行
	  foreach ($values as $row) {
		  $buf['impress_serial_id'] = $row['impress_serial_id'];
		  $buf['impress_score'] = $row['impress_score'];
		  $buf['impress_post_time'] = $row['impress_post_time'];
		  $buf['impress_text'] = $row['impress_text'];
		  $buf['impress_buy_will'] = $row['impress_buy_will'];
		  $buf['review_serial_id'] = $row['review_serial_id'];
		  $buf['user_serial_id'] = $row['user_serial_id'];
		  $buf['display_name'] = $row['display_name'];
		  array_push($impressInfo, $buf);
	  }

	}catch(PDOException $e){
		// 失敗したらnullを返す
		return null;
	}
	//データベースへの接続を閉じる
	$dbh = null;

	return $impressInfo;
}

// レビュー情報をデータベースにアクセスして探す関数
function getReviewInfo($reviewID){
	$reviewInfo = array();
	try{
	  //DB接続
	  $dbh = getPDOHide();

	  //SQL作成
	  $sql = "select * from t_review where review_serial_id = ?";

	  $stmt = $dbh->prepare($sql);

	  $stmt->bindParam(1, $reviewID, PDO::PARAM_INT);
	  $stmt->execute();

	  $values = $stmt->fetchAll(PDO::FETCH_ASSOC);

	  //SQL実行
	  foreach ($values as $row) {
		  $reviewInfo['review_serial_id'] = $row['review_serial_id'];
		  $reviewInfo['review_post_time'] = $row['review_post_time'];
		  $reviewInfo['review_item_name'] = $row['review_item_name'];
		  $reviewInfo['review_title'] = $row['review_title'];
		  $reviewInfo['review_text'] = $row['review_text'];
		  $reviewInfo['theme_serial_id'] = $row['theme_serial_id'];
		  $reviewInfo['user_serial_id'] = $row['user_serial_id'];
	  }

	}catch(PDOException $e){
		// 失敗したらnullを返す
		return null;
	}
	//データベースへの接続を閉じる
	$dbh = null;

	return $reviewInfo;
}

?>
