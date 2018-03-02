<?php
session_start();
session_regenerate_id(true);
//ページ・ヘッダータイトル
$title="備品管理システム";

if($_SESSION['login']!=3){
	header('Location:'.$_SERVER['DOCUMENT_ROOT'].'/common/NG.php');
	exit();
}

//サニタイジング
$_SESSION['name']=htmlspecialchars($_POST['name'],ENT_QUOTES,'UTF-8');
$_SESSION['id']=htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
$_SESSION['class']=htmlspecialchars($_POST['class'],ENT_QUOTES,'UTF-8');
$_SESSION['mail']=htmlspecialchars($_POST['mail'],ENT_QUOTES,'UTF-8');
$_SESSION['password']=htmlspecialchars($_POST['password'],ENT_QUOTES,'UTF-8');
$_POST['password2']=htmlspecialchars($_POST['password2'],ENT_QUOTES,'UTF-8');

//if($_SESSION['password']!=$_POST['password2']){
//	//一致しなかったらクラスとパスワード以外をセッション・フラグを残して前のフォームへ戻る
//	$_SESSION['add_user_error_flg']=1;
//	header('location: '.$_SERVER['HTTP_REFERER']);
//	exit();
//}

//暗号化
$_SESSION['password']=md5($_SESSION['password']);

//if($_SESSION['name']==''||$_SESSION['id']==''||$_SESSION['class']==''||$_SESSION['password']==''||$_POST['password2']==''){
//	header('Location:'.$_SERVER['DOCUMENT_ROOT'].'/common/NG.php');
//	exit();
//}
unset($_SESSION['add_user_error_flg']);
try{
	require_once('../common/connection_db.php');
	
	$sql='select name from class where id = '.$_SESSION['class'];
	$stmt=$dbh->prepare($sql);
	$stmt->execute();
	
	$dbh=null;
	
}
catch(Exception $e){
	header('Location:'.$_SERVER['DOCUMENT_ROOT'].'/common/NG.php');
	exit();
}

$rec=$stmt->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>

<html lang="ja">

<head>
	<!--共通-->
	<?php include_once "../common/head.php"; ?>
	<!--単体-->
	<link rel="stylesheet" href="../common/style/add_user_check.css">
	<script src="common/script/readtxt.js"></script>
</head>

<body>
	<header>
		<h1><?php print $title;?></h1>
		<p><a id="logout" href="http://localhost/common/logout.php">終了</a></p>
	</header>
	<div id="root">
		<div id="spacer"></div>
		<div class="top check">
			<div class="box">
				<h2>以下の内容で登録します。</h2>
				<table>
					<tr>
						<td>氏名</td>
						<td><?php print $_SESSION['name']; ?></td>
					</tr>
					<tr>
						<td>学籍番号</td>
						<td><?php print $_SESSION['id']; ?></td>
					</tr>
					<tr>
						<td>学科</td>
						<td><?php print $rec['name']; ?></td>
					</tr>
					<tr>
						<td>メールアドレス</td>
						<td><?php print $_SESSION['mail']; ?></td>
					</tr>
					<tr>
						<td>パスワード</td>
						<td>入力したパスワード</td>
					</tr>
				</table>
				<button type="button" onclick="history.back()">戻る</button>
				<a href="done.php" class="button">登録</a>
			</div>
		</div>
	</div>
</body>

</html>