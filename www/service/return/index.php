<?php
session_start();
session_regenerate_id(true);
//ページ・ヘッダータイトル
$title="返却 | 備品管理システム";

if($_SESSION['login']!=10){
	header('Location:'.$_SERVER['DOCUMENT_ROOT'].'/common/NG.php');
	exit();
}

try{
	require_once('../../common/connection_db.php');
	
	//ユーザーの借り状況表示
	$sql='select item.id, item.name, lending.item from item, lending where lending.code = ? and item.id = lending.item order by item.category';
	$stmt=$dbh->prepare($sql);
  $data[]=$_SESSION['code'];
	$stmt->execute($data);
	
	$dbh=null;
	
}
catch(Exception $e){
	print 'DBエラー : 管理者を呼ぼう。';
	echo $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <!--共通-->
  <?php include_once "../../common/head.php"; ?>
    <!--単体-->
    <link rel="stylesheet" href="../../common/style/return.css">
    <script src="../../common/script/scroll.js"></script>
</head>

<body>
  <header>
   <div class="back"><a href="../"><img src="../../media/img/back.png" alt="戻る"></a></div>
    <h1><?php print $title;?></h1>
    <p id="id">
      <?php print'ようこそ'.$_SESSION['name'].'様'; ?>
    </p>
    <p><a id="logout" href="<?= 'http://' . $_SERVER["HTTP_HOST"] ?>/common/logout.php">ログアウト</a></p>
  </header>
  <div id="root">
    <div id="spacer"></div>
    <div class="return">
      <div class="item_list">
        <div class="item box">
        <?php
        print'<p>借りている備品</p>';
        print'<table><thead><tr>';
        print '<th>&nbsp;</th><th>備品名</th>';
        print'</tr></thead>';
        print'<tbody>';
        $count = 0;
        while(true){
          $rec=$stmt->fetch(PDO::FETCH_ASSOC);
          if($rec==null){
            print'</tbody></table>';
            break;
          }
          $count +=1;
          print'<tr>';
          print '<td><input name="item_id[]" type="checkbox" class="'.$rec['id'].'" id="item_'.$rec['id'].'" value="'.$rec['id'].'"></td>';
          print '<td><label for="item_'.$rec['id'].'">'.$rec['name'].'</label></td>';
          print'</tr>';
        }
        if($count==0){
          echo '<div class="no_item"><p>現在貸し出し中の備品はありません</p></div>';
        }
        ?>
        </div>
      </div>
      <?php
      if($count!=0){
      ?>
      <div class="select_item">
        <form method="post" action="check.php">
          <h2>返却する備品</h2>
          <ul class="select">
          </ul>
          <input type="submit" value="次へ進む">
        </form>
      </div>
      <?php
      }
      ?>
    </div>
  </div>
  <script>
    /*備品貸出数の制限・未選択時のsubmitボタン無効化*/
    $(function () {
      //ページが表示されたタイミングでチェックボックスを全部はずされた状態にする
      $("input").prop('checked', false);
      //ページが表示されたタイミングで確認ボタンを押せない状態にする
      $("input[type=submit]").attr('disabled', 'disabled');
      $('input').click(function () {
        if (!($('.select_item input[type=hidden]')).length) {
          //借りるものリスト（画面右の）数が0なら確認ボタンを押せない状態にする
          $('input[type=submit]').attr('disabled', 'disabled');
        } else {
          ////借りるものリスト（画面右の）数が1以上3未満なら確認ボタンを押せない状態にする
          $('input[type=submit]').removeAttr('disabled');
        }
      });
    })

    /*チェックした備品をformに複製*/
    $(".item input").click(function () {
      /*inputの属性を保存*/
      var val = $(this).attr('value');
      var chk = $(this).prop('checked');

      if (chk == true) {
        /*チェックが付けられたら複製*/
        var checkbox = $(this).parent().html();
        var name = $(this).parent().next().html();
        $(".select").append('<li>' + checkbox + name + '</li>');
        $(".select input[type='checkbox']").attr('type', 'hidden');
      } else {
        /*チェックが外されたら削除*/
        $(".select #item_" + val).parent().remove();
      }
      return true;
    });
  </script>
</body>

</html>