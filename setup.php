<html>
<head>
<title>SETUP</title>
</head>
<body>
<?php
require_once('common.inc');
//データベースに接続
$conn = sqlite_open(DB, 0666, $error) or die($error);
//テーブルの作成
sqlite_query($conn, 'CREATE TABLE ' . TABLE . ' (msg_id INTEGER PRIMARY KEY, name TEXT, message text, time text)', SQLITE_ASSOC, $error) or die($error);

//接続を切る
sqlite_close($conn);

echo '初期化が終わりました';

?>
</body>
</html>
