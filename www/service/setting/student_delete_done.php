<?php
session_start();
session_regenerate_id(true);

//ページ・ヘッダータイトル
$title="貸出権限剥奪 | 備品管理システム";

if($_SESSION['login']!=10){
	header('Location:'.$_SERVER['DOCUMENT_ROOT'].'/common/NG.php');
	exit();
}

$item = count($_SESSION['item_id']); //選択した備品の数を配列へ
try{
	require('../../common/connection_db.php');
	
	for($i=0;$i<$item;$i++){
    
		${'sql2'.$i}='update student set rejection = 0 where code=?';
		${'data2'.$i}[]=$_SESSION['item_id'][$i];
		${'stmt2'.$i}=$dbh->prepare(${'sql2'.$i});
		${'stmt2'.$i}->execute(${'data2'.$i});

	}
	
	$dbh=null;
}
catch(Exception $e){
	print 'DBエラー : 管理者を呼ぼう。';
	echo $e->getMessage();
}

//ユーザートップに戻ってもう一つ借りるとなったときのために、一応変数を消しておく
unset($_SESSION['item_id']);
//var_export($_SESSION);
?>
	<!DOCTYPE html>
	<html lang="ja">

	<head>
		<title><?php print $title;?></title>
		<?php include_once "../../common/head.php"; ?>
		<link rel="stylesheet" href="../../common/style/lending_done.css">
	</head>
	<body>
    <div class="top lending_done">
      <div class="box">
        <h2>貸出権限の無効処理を完了しました。</h2>
        <a href="student_delete.php" class="button">生徒削除一覧へ戻る</a>
      </div>
    </div>
	</body>
	</html>
<?php
/*
* 特筆する点は無いと思う
*/
?>