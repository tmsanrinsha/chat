<?php
require_once 'common.inc';

//データベースに接続
try {
    $pdo = new PDO(CONNECT);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->query("CREATE TABLE " . TABLE . " (msg_id INTEGER PRIMARY KEY, name TEXT, message TEXT, time TEXT)");
} catch (PDOException $e){
    var_dump($e->getMessage());
    die;
}

$pdo = null;
//return json_encode($msg_array);

//$conn = sqlite_open(DB, 0666, $error) or die($error);
////テーブルの作成
//sqlite_query($conn, 'CREATE TABLE ' . TABLE . ' (msg_id INTEGER PRIMARY KEY, name TEXT, message text, time text)', SQLITE_ASSOC, $error) or die($error);
//
////接続を切る
//sqlite_close($conn);

echo '初期化が終わりました';
?>
