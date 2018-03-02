<?php
session_start();
session_regenerate_id(true);
//ページ・ヘッダータイトル
$title="返却備品確認 | 備品管理システム";

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
		${'sql'.$i}='select id, name from item where id='.$list[$i].' and lending = 0';
		${'stmt'.$i}=$dbh->prepare(${'sql'.$i});
		${'stmt'.$i}->execute();
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
		<header>
			<h1><?php print $title;?></h1>
			<p id="id"><?php print'ようこそ'.$_SESSION['name'].'様'; ?></p>
			<p><a id="logout" href="<?= 'http://' . $_SERVER["HTTP_HOST"] ?>/common/logout.php">ログアウト</a></p>
		</header>
		<div id="root">
			<div id="spacer"></div>
			<div class="top lending_check">
				<form method="post" action="done.php">
					<h2>こちらの備品を返却します。</h2>
					<?php
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
		</div>
	</body>
</html>