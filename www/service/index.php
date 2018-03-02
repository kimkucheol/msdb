<?php
session_start();
session_regenerate_id(true);
//ページ・ヘッダータイトル
$title="ユーザートップ | 備品管理システム";
try{
	require_once('../common/connection_db.php');
	//この番号がDBに保存してあるか検索
	$sql='select code from (select code, id from master union all select code, id from student) as teble where id = ?';
	$stmt=$dbh->prepare($sql);
	$data[]=$_SESSION['id'];
	$stmt->execute($data);

	$dbh=null;
	$rec=$stmt->fetch(PDO::FETCH_ASSOC);

	if($_SESSION['login']!=10 || $rec==false){
		header('Location:'.$_SERVER['DOCUMENT_ROOT'].'/common/NG.php');
		exit();
	}

	$_SESSION['code'] = $rec['code'];
}
catch(Exception $e){
	echo $e->getMessage();
	//header('Location:'.$_SERVER['DOCUMENT_ROOT'].'/common/NG.php');
	//exit();
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
	<!--共通-->
	<?php include_once "../common/head.php";?>
	<!--単体-->
	<link rel="stylesheet" href="../common/style/service_index.css">
</head>

<body>
	<header>
		<h1><?php print $title;?></h1>
		<p id="id"><?php print'ようこそ'.$_SESSION['name'].'様';?></p>
		<p><a id="logout" href="<?= 'http://' . $_SERVER["HTTP_HOST"] ?>/common/logout.php">ログアウト</a></p>
	</header>
	<div id="root">
		<div id="spacer"></div>
		<div class="top menu">
			<div>
				<a href="lend/" id="rend">
					<p>貸し出し</p>
				</a>
			</div>
			<div>
				<a href="return/" id="return">
					<p>返却</p>
				</a>
			</div>
			<div>
				<a href="setting/" id="setting">
					<p>設定</p>
				</a>
			</div>
		</div>
	</div>
</body>
</html>
