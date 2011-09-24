<?php
require_once('common.inc');
mb_internal_encoding("UTF-8");

//DB接続
$conn = sqlite_open(DB, 0666, $error) or die ($error);

//データの投稿
//メッセージが空でないかの確認
if(($_POST['message'] != "") and (!mb_ereg_match("^(\s|　)+$", $_POST['message']))){
	
	//エスケープ
	$message = htmlentities($_POST['message'], ENT_QUOTES, "UTF-8");
	$message = sqlite_escape_string($message); 

	//データベースに追加
	//$sql = "INSERT INTO " . TABLE . " (null, message) VALUES ('$message') ";
	$sql = "INSERT INTO " . TABLE . " VALUES (null, 'name', '$message', datetime('now', 'localtime'))";
	$res = sqlite_unbuffered_query($sql,$conn) or die ($error);
	$message = "<div>" . nl2br($message) . "</div>";
	echo $message;
}

?>
