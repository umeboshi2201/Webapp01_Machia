<?php

$DBHOST = "127.0.0.1";
$DBPORT = "5432";
$DBNAME = "ttestdb";
$DBUSER = "postgres";
$DBPASS = "password";

try{
  //DB接続
  $dbh = new PDO("pgsql:host=$DBHOST;port=$DBPORT;dbname=$DBNAME;user=$DBUSER;password=$DBPASS");
  print("接続成功".'<br>');

  //SQL作成
  $sql = 'select * from ttest1';
  //SQL例
  //$sql = 'select * from "SchemeName"."TableName"';


  //SQL実行
  foreach ($dbh->query($sql) as $row) {
      //指定Columnを一覧表示
      print('<h1>'.$row['a'].'</h1>');
  }

}catch(PDOException $e){
  print("接続失敗".'<br>');
  print($e.'<br>');
  die();
}
//データベースへの接続を閉じる
$dbh = null;
?>
