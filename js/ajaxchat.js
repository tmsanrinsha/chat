$(function(){
    ajax_get();
	
	//メッセージ送信時のアクションを呼び出す
	$("#button").click(function(e){ 
        ajax_send();
        $("#message").val("");
	}); 
	
}); 

//メッセージの獲得
function ajax_get(){
    //最初にindex.htmlが呼び出されたときはlast_id=0
    //それ以外の時は表示されたメッセージの最新のid
	if((last_id = $("#last_id").val()) === undefined){
        last_id = 0;
    }else{
        $("#last_id").remove();
    }

	//データ抽出用PHPの呼び出し
	$.get("./read.php", {last_id : last_id}, function(data){
		if (data.length>0){ 
			$("#results").prepend(data); 
		} 
	})
}

//メッセージ送信時のアクション
function ajax_send(){
	
	//テキストエリア文字列を変数に格納
	var comment_val = $("#message").val();
	
	//データ投稿用PHPの呼び出し
	$.post("./action.php", {message : comment_val}, function(data){
		
		if (data.length > 0){ 
			$("#results").prepend(data);
        }
	}) 
} 
