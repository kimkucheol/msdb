<?php
session_start();
session_regenerate_id(true);
$title='備品追加';

if($_SESSION['login']!=10){
	header('Location:'.$_SERVER['DOCUMENT_ROOT'].'/common/NG.php');
	exit();
}

try{
  require_once('../../common/connection_db.php');
  $sql='select * from category';
  $stmt=$dbh->prepare($sql);
  $stmt->execute();
  
  if(isset($_POST['submit'])){
		
		
		
		
    if($_POST['month']=='null'){
			unset($_POST['month']);
    }
    if($_POST['week']=='null'){
			unset($_POST['week']);
    }
    if($_POST['day']=='null'){
			unset($_POST['day']);
    }
		if($_POST['category']=='null'){
			unset($_POST['category']);
		}
		
		$img = $_FILES['file'];
		if(preg_match('/\.gif$|\.png$|\.jpg$|\.jpeg$|\.bmp$/i',$img['name'])||$img['name']==''){
			if($img['size']>0){
				move_uploaded_file($img['tmp_name'],'../../media/img/item/'.$img['name']);
			}
		
			if(count($_POST)==5 || count($_POST)==4 && isset($_POST['category'])==false){
				$sql2='insert into item(name, category, lending, month, week, day, path) values(?, ?, ?, ?, ?, ?,?)';
				$data2=array($_POST['name'],$_POST['category'],$_POST['lending'],$_POST['month'],$_POST['week'],$_POST['day'],$img['name']);
				$stmt2=$dbh->prepare($sql2);
				$stmt2->execute($data2);
				$result = $_POST['name'].'を追加しました';
			}else{
				$result = '入力項目をご確認のうえ、再度入力をしてください。';
			}
		}else{
			$result = '画像の拡張子をご確認ください。';
		}
  }
$dbh=null;
unset($_POST);
}
catch(Exception $e){
  $result = '入力項目をご確認のうえ、再度入力をしてください。';
}

?>
<!doctype html>
<html>
<head>
  <?php include_once "../../common/head.php"; ?>
  <link rel="stylesheet" href="../../common/style/setting/setting.css">
  <link rel="stylesheet" href="../../common/style/setting/select_file.css">
  <link rel="stylesheet" href="../../common/style/setting/setting_add_item.css">
</head>
<body>
  <div class="setting">
    <?php if(isset($result)){ echo '<p class="result">'.$result.'</p>';} ?>
		<form method="post" enctype="multipart/form-data">
			<h2><?php echo $title; ?></h2>
			<p>備品名を入力してください。</p>
			<input type="text" name="name" required placeholder="例 : ノートパソコン WM-S001">
			<p>カテゴリーを選択してください。</p>
      <select name="category">
      <?php
      while(true){
        $rec=$stmt->fetch(PDO::FETCH_ASSOC);
        if($rec==null){
          break;
        }
        if($rec['id']==999){
          $selected = 'selected';
        }else{
          $selected ='';
        }
        print'<option value="'.$rec['id'].'" '.$selected.'>'.$rec['name'].'</option>';
      }
      ?>
      <option value="null">その他</option>
      </select>
      <p>画像を選択してください<br><small>※対応拡張子 : .gif .png .jpg .jpeg .bmp</small></p>
      <div class="flex">
        <label class="button" for="file">
          <span>ファイルを選択</span>
          <input type="file" id="file" name="file" accept="image/*">
        </label>
        <p id="input_file_name">ファイルを選択してください</p>
      </div>
			<div class="preview"></div>
			<p>現在の貸出可否状態を選択してください</p>
      <label><input type="radio" name="lending" value="1" checked>貸出可能</label>
      <label><input type="radio" name="lending" value="0">貸出不可</label>
			<p>最大貸出可の期間を指定してください。</p>
      <div class="period">
        <select name="month">
          <option selected value="null">--月</option>
          <?php
          for($i=1;$i<=12;$i++){
            echo '<option value="'.$i.'">'.$i.'ヶ月</option>';
          }
          ?>
        </select>
        <select name="week">
          <option selected value="null">--週</option>
          <?php
          for($j=1;$j<=4;$j++){
            echo '<option value="'.$j.'">'.$j.'週間</option>';
          }
          ?>
        </select>
        <select name="day">
          <option selected value="null">--日</option>
          <?php
          for($k=1;$k<=29;$k++){
            if($k%7!=0){
              echo '<option value="'.$k.'">'.$k.'日間</option>';
            }
          }
          ?>

        </select>
        <button id="reset" type="button">期間をリセット</button>
      </div>
      <div class="flex end">
				<button type="reset">リセット</button>
				<input type="submit" name="submit" value="追加">
			</div>
		</form>
	</div>
  <script>
    $(function(){
      $(".period select").click(function(){
        $(".period select").not(this).val("null").prop("disabled", true);
      })
      $("#reset").click(function(){
        $("select").prop("disabled", false);
      })
    })
  </script>
  <script>
	$(function(){
		// リセットボタン押したらファイル名を消す
		$("button[type='reset']").click(function(){
			$('#input_file_name').html('ファイルを選択してください');
			$("img").remove();
		})
		// 選択ファイル設定（ファイル名をテキストボックスへ表示）
		$('input[type=file]').on('change',function(){
			$('#input_file_name').html($(this).prop('files')[0].name);
		});
	});
		
		
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