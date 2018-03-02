var read_id;
$(function(){
	read_id = setInterval("read()", 1000);
})

//ID.txtにを読み取り、データが入っているかチェック
function read() {
	var url = './common/exe/ID.txt';
	url += '\?q=' + (new Date()).getTime();
	$.ajax({
		url: url, //取得するファイルを指定
		catch: false, //キャッシュ無効化
		dataType: "text", //文字タイプ指定
		/* データの取得に成功した場合 */
		success: function (data) {
			console.log("Success" + data + url); //console logに時間を表示
			if ((data) != "") {
				window.location.href = './common/check.php';
				clearInterval(read_id);
			}
		},
		/* データの取得に失敗した場合 */
		error: function () {
			console.log("Error : 何らかの理由");
		}
	});
}