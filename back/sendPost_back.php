<?php

function sendPost($sendData, $sendId, $sendUrl){
	// URLエンコードされたクエリ文字列を生成
	$sendData = http_build_query($sendData, "", "&");

	// ストリームコンテキストのオプションを作成
	$options = array(
		// HTTPコンテキストオプションをセット
		'http' => array(
			'method'=> 'POST',
			'header'=> 'Content-Type: application/x-www-form-urlencoded',
			'content' => $sendData
		)
	);

	// ストリームコンテキストの作成
	$context = stream_context_create($options);

	// POST送信
	$contents = file_get_contents($sendUrl, false, $context);

	return;
}

?>
