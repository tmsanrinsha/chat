<?php
require_once('common.inc');
//mb_internal_encoding("UTF-8");

//メッセージが空でないかの確認
if(!isset($_POST['message']) || preg_match('/^\s+$/', $_POST['message']) === 1){ 
//if(!isset($_POST['message']) || $_POST['message'] === ""){
    header('HTTP/1.0 400 Bad Request');
    die('error');
}

$message = $_POST['message'];
$message = trim($message);
//エスケープ
$message = htmlentities($message, ENT_QUOTES, "UTF-8");

//データベースに接続
try {
    $pdo = new PDO(CONNECT);
    //エラーがあったらcatchに飛ぶ設定
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare("INSERT INTO " . TABLE . "(name, message, time) VALUES('name', :message, datetime('now', 'localtime'))");
    $stmt->bindValue(':message', $message, PDO::PARAM_STR);
    $stmt->execute();
} catch (PDOException $e){
    var_dump($e->getMessage());
}

$pdo = null;

echo json_encode(true);
//DB接続
//$conn = sqlite_open(DB, 0666, $error) or die ($error);
//
////データの投稿
////メッセージが空でないかの確認
//if(($_POST['message'] != "") and (!mb_ereg_match("^(\s|　)+$", $_POST['message']))){
//	
//	//エスケープ
//	$message = htmlentities($_POST['message'], ENT_QUOTES, "UTF-8");
//	$message = sqlite_escape_string($message); 
//
//	//データベースに追加
//	//$sql = "INSERT INTO " . TABLE . " (null, message) VALUES ('$message') ";
//	$sql = "INSERT INTO " . TABLE . " VALUES (null, 'name', '$message', datetime('now', 'localtime'))";
//	$res = sqlite_unbuffered_query($sql,$conn) or die ($error);
//	$message = "<div>" . nl2br($message) . "</div>";
//	echo $message;
//}

?>
