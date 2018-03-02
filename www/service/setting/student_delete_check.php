<?php
session_start();
session_regenerate_id(true);
//ページ・ヘッダータイトル
$title="貸出権限剥奪 | 備品管理システム";

if($_SESSION['login']!=10){
	header('Location:'.$_SERVER['DOCUMENT_ROOT'].'/common/NG.php');
	exit();
}

try{
	require_once('../../common/connection_db.php');

	$item = count($_POST['item_id']); //選択した備品の数を配列へ
	$_SESSION['item_id']=$_POST['item_id']; //ここでセッションも作っちゃう
	$list = $_POST['item_id'];
	for($i=0;$i<$item;$i++){
		${'sql'.$i}='select * from student where code='.$list[$i];
		${'stmt'.$i}=$dbh->prepare(${'sql'.$i});
		${'stmt'.$i}->execute();
		
		${'sql2'.$i}='select * from lending,student where student.code=lending.code and lending.code='.$list[$i];
		${'stmt2'.$i}=$dbh->prepare(${'sql2'.$i});
		${'stmt2'.$i}->execute();
	}
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
		<title><?php print $title;?></title>
		<?php include_once "../../common/head.php"; ?>
		<link rel="stylesheet" href="../../common/style/lending_select_period.css">
	</head>
	<body>
    <div class="top lending_check">
      <form method="post" action="student_delete_done.php">
        <h2>こちらの学生の貸出権限を無効にします。</h2>
        <?php
          $k=0;
          for($i=0;$i<$item;$i++){
            $rec2=${'stmt2'.$i}->fetch(PDO::FETCH_ASSOC);
            if($rec2!=null){
              if($k==1){
                print',';
              }
              if($k==0){
                print'返却が未完了の学生がいます。(';
                $k=1;
              }
              print $rec2['name'];
            }
          }
          if($k==1){
              print')';
          }
          $k=0;
          for($i=0;$i<$item;$i++){
              $rec=${'stmt'.$i}->fetch(PDO::FETCH_ASSOC);
              print'<li>';
              print $rec['name'];
              print'</li>';

          }
        ?>
        <div class="button_flex">
          <button type="button" onclick="history.back()">戻る</button>
          <input type="submit" id="submit" value="確認">
        </div>
      </form>
    </div>
	</body>
</html>
<?php
/*
* $item = 選択した備品の数をカウント
* $_POSR['item_id'], $_SESSION['item_id'] = 選択した備品の主キー
*/
?>