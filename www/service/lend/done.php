<?php
session_start();
session_regenerate_id(true);

//ページ・ヘッダータイトル
$title="貸出備品確認 | 備品管理システム";

if($_SESSION['login']!=10){
	header('Location:'.$_SERVER['DOCUMENT_ROOT'].'/common/NG.php');
	exit();
}

$item = count($_SESSION['item_id']); //選択した備品の数を配列へ

try{
	require_once('../../common/connection_db.php');
	for($i=0;$i<$item;$i++){
		${'sql'.$i}="insert into lending(code, timestamp, item, period) values(?, datetime('now'), ?, ?)";
		${'data'.$i}[]=$_SESSION['code'];
		${'data'.$i}[]=$_SESSION['item_id'][$i];
		${'data'.$i}[]=$_SESSION['item_period'][$i];
		${'stmt'.$i}=$dbh->prepare(${'sql'.$i});
		${'stmt'.$i}->execute(${'data'.$i});
	}
	
	for($i=0;$i<$item;$i++){
		${'sql2'.$i}='update item set lending = 0 where id = ?';
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
//ユーザートップに戻ってまた借りるとなったときのために、一応変数を消しておく
unset($_SESSION['item_id'],$_SESSION['item_period']);
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
<?php
/*
* $itemを$_SESSION['count'] にしてしまうか悩み中
*/
?>