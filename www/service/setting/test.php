<!DOCTYPE html>
<html>
  <head>
    <meta charset=”utf-8″ />
    <script src="../../common/script/jquery-3.2.1.min.js"></script>
  </head>
  <body>
   
   <form enctype="multipart/form-data">
   	<input type="file">
   	<input type="submit">
   </form>
    <?php /*
      $word = array ("文字列1","文字列2","文字列3",);
      print_r($word);
      echo "<br />";
      $word = str_replace("文字列", "置き換え後", $word);
      print_r($word);
      echo $n;*/
    ?>
    <script>
		$(function(){
  //画像ファイルプレビュー表示のイベント追加 fileを選択時に発火するイベントを登録
  $('form').on('change', 'input[type="file"]', function(e) {
    var file = e.target.files[0],
        reader = new FileReader(),
        $preview = $(".preview");
        t = this;

    // 画像ファイル以外の場合は何もしない
    if(file.type.indexOf("image") < 0){
      return false;
    }

    // ファイル読み込みが完了した際のイベント登録
    reader.onload = (function(file) {
      return function(e) {
        //既存のプレビューを削除
        $preview.empty();
        // .prevewの領域の中にロードした画像を表示するimageタグを追加
        $preview.append($('<img>').attr({
                  src: e.target.result,
                  width: "150px",
                  class: "preview",
                  title: file.name
              }));
      };
    })(file);

    reader.readAsDataURL(file);
  });
});

		</script>
  </body>
</html>