<?php
// DBアクセス用関数を読み込む
require_once(dirname(__FILE__).'/dbconnection_getter.php');

// グループ情報をデータベースにアクセスして探す関数
function getGroupInfo($groupID){
	$groupInfo = array();
	try{
	  //DB接続
	  $dbh = getPDOHide();

	  //SQL作成
	  $sql = "select * from t_group where group_serial_id in (select group_serial_id from t_member where user_serial_id = ?) order by group_serial_id";

	  $stmt = $dbh->prepare($sql);

	  $stmt->bindParam(1, $groupID, PDO::PARAM_INT);
	  $stmt->execute();

	  $values = $stmt->fetchAll(PDO::FETCH_ASSOC);

	  //SQL実行
	  foreach ($values as $row) {
		  $buf = array();
		  $buf['group_serial_id'] = $row['group_serial_id'];
		  $buf['group_name'] = $row['group_name'];
		  $buf['group_str_id'] = $row['group_str_id'];
		  $buf['user_serial_id'] = $row['user_serial_id'];
		  array_push($groupInfo, $buf);
	  }

	}catch(PDOException $e){
		// 失敗したらnullを返す
		return null;
	}
	//データベースへの接続を閉じる
	$dbh = null;

	return $groupInfo;
}

?>
