<?php
require_once 'common.inc';
//mb_internal_encoding("UTF-8");

//DB接続
$conn = sqlite_open(DB, 0666, $error) or die ($error);

//データの抽出
if(isset($_GET['last_id'])){
	$sql = "SELECT * FROM " . TABLE . " Where msg_id > {$_GET['last_id']} ORDER BY msg_id DESC limit " . MAXMSG . ";";
	$res = sqlite_unbuffered_query($sql, $conn, SQLITE_ASSOC, $error) or die ($error);
    $i = 0;
    $message = '';
	while ($row = sqlite_fetch_array($res, SQLITE_ASSOC)){
        if($i == 0){
            $message .= '<input type="hidden" id="last_id" value="' . $row["msg_id"] . '" />';
        }
		$message .= '<div>' . $row["name"] . ' : ' . $row["time"] . "<br />" .
                    nl2br($row["message"]) . "</div>";
        $msg_id = $row["msg_id"];
        $i++;
	}

    //最初にアクセスしかつメッセージがあった場合はid="oldest_id"を加える
    if($_GET['last_id'] == 0 && isset($msg_id)){
        $message .= '<input type="hidden" id="oldest_id" value="' . $msg_id . '" />';
    }
}
else{
	$message = "Hey You! What are you doing?";
} 

//データを書き出し
echo $message;
?>
