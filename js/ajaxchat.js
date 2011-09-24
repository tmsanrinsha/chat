$(function(){
    ajax_get();
	
	//送信ボタンクリック時のアクションの設定
	$("#button").click(function(e){ 
        msg = $("#message").val();
        //trim
        //msg = msg.replace(/^[\s　]+|[\s　]+$/g, "");
        if(msg !== ""){
            ajax_send();
            $("#message").val("");
        }
	}); 
	
}); 

//メッセージの取得
function ajax_get(){
    //最初にindex.htmlが呼び出されたときはlast_id=0
    //それ以外の時は表示されたメッセージの最新のid
    last_id = $("#last_id").val();
    //if((last_id = $("#last_id").val()) === undefined){
    //    last_id = 0;
    //}else{
    //    $("#last_id").remove();
    //}

    //データ抽出用PHPの呼び出し
    $.get("./msg_get.php", {last_id : last_id}, function(data){
        data = eval( "(" + data + ")" );
        //何も新しいメッセージがない場合は[]が返ってくる
        if (data[0] !== undefined){ 
            for(var i = 0, len = data.length; i < len; i++){
                var msg = data[i]['message'];
                $("#results").prepend(msg); 
                $('#last_id').val(data.pop()['msg_id']);
            } 
        }
    })
}

//メッセージの送信
function ajax_send(){
	//テキストエリア文字列を変数に格納
	var message = $("#message").val();
	
	//データをINSERT
	$.post("./msg_ins.php", {message : message}, function(data){
        ajax_get();	
	}) 
} 
