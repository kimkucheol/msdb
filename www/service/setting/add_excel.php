<?php
session_start();
session_regenerate_id(true);
$title ='Excelで備品追加';

if($_SESSION['login']!=10){
	header('Location:'.$_SERVER['DOCUMENT_ROOT'].'/common/NG.php');
	exit();
}

?>
<!doctype html>
<html>
  <head>
<?php include_once "../../common/head.php"; ?>
<link rel="stylesheet" href="../../common/style/setting/setting.css">
<link rel="stylesheet" href="../../common/style/setting/select_file.css">
  </head>
  <body>
    <div class="setting add_item">
    <?php if(isset($result)){ echo '<p class="result">'.$result.'</p>';} ?>
		<h2>Excelで備品追加</h2>
		<form method="post" action="add_excel_check.php">
			<p>入力済みExcelファイルをアップロードしてください。<br>（対応拡張子 : .xls , .xlsx）</p>
      <p><a href="excel.zip" class="button">テンプレートをダウンロード</a></p>
      <div class="flex">
        <label class="button" for="file">
          <span>ファイルを選択</span>
          <input type="file" id="file" name="file" accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required>
        </label>
        <p id="input_file_name">ファイルを選択してください</p>
      </div>
      <div class="flex end">
				<button type="reset">リセット</button>
        <input type="submit" name="submit" value="確認">
      </div>
    </form>
	</div>
<script type="text/javascript">
$(function(){
  // リセットボタン押したらファイル名を消す
  $("input[type='reset']").click(function(){
    $('#input_file_name').html('ファイルを選択してください');
  })
  // 選択ファイル設定（ファイル名をテキストボックスへ表示）
  $('input[type=file]').on('change',function(){
    $('#input_file_name').html($(this).prop('files')[0].name);
  });
});
</script>
    </body>
  </html>