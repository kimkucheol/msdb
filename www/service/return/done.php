<?php
session_start();
session_regenerate_id(true);

//ページ・ヘッダータイトル
$title="返却備品確認 | 備品管理システム";

if($_SESSION['login']!=10){
	header('Location:'.$_SERVER['DOCUMENT_ROOT'].'/common/NG.php');
	exit();
}

$item = count($_SESSION['item_id']); //選択した備品の数を配列へ
try{
	require('../../common/connection_db.php');
	
	for($i=0;$i<$item;$i++){
    ${'sql1'.$i}="insert into lending_log (code, timestamp, item, period, return_item) select code, timestamp, item, period, datetime('now') from lending where item = ?";
		${'data1'.$i}[]=$_SESSION['item_id'][$i];
		${'stmt1'.$i}=$dbh->prepare(${'sql1'.$i});
		${'stmt1'.$i}->execute(${'data1'.$i});
    
		${'sql2'.$i}='delete from lending where item=?';
		${'data2'.$i}[]=$_SESSION['item_id'][$i];
		${'stmt2'.$i}=$dbh->prepare(${'sql2'.$i});
		${'stmt2'.$i}->execute(${'data2'.$i});

		${'sql3'.$i}='update item set lending = 1 where id = ?';
		${'data3'.$i}[]=$_SESSION['item_id'][$i];
		${'stmt3'.$i}=$dbh->prepare(${'sql3'.$i});
		${'stmt3'.$i}->execute(${'data3'.$i});
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
		<header>
			<h1><?php print $title;?></h1>
			<p id="id"><?php print'ようこそ'.$_SESSION['name'].'様'; ?></p>
			<p><a id="logout" href="<?= 'http://' . $_SERVER["HTTP_HOST"] ?>/common/logout.php">ログアウト</a></p>
		</header>
		<div id="root">
			<div id="spacer"></div>
			<div class="top lending_done">
				<div class="box">
					<h2>貸出処理を完了しました。</h2>
					<a href="http://localhost/common/logout.php" class="button">操作を終了する</a>
					<a href="../index.php" class="button">ユーザートップへ戻る</a>
				</div>
			</div>
		</div>
	</body>
	</html>