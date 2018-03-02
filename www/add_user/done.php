<?php
session_start();
session_regenerate_id(true);
//ページ・ヘッダータイトル
$title="ユーザー登録 | 備品管理システム";

if($_SESSION['login']!=3){
	header('Location:'.$_SERVER['DOCUMENT_ROOT'].'/common/NG.php');
	exit();
}

try{
	require_once('../common/connection_db.php');
	//ユーザーデータを登録
	$sql='insert into student(id, name, pass, class, mail) values(?, ?, ?, ?, ?)';
	$data[]=$_SESSION['id'];
	$data[]=$_SESSION['name'];
	$data[]=$_SESSION['password'];
	$data[]=$_SESSION['class'];
	$data[]=$_SESSION['mail'];
		
	$stmt=$dbh->prepare($sql);
	$stmt->execute($data);
	
	$dbh=null;
}
catch(Exception $e){
	header('Location:'.$_SERVER['DOCUMENT_ROOT'].'/common/NG.php');
	exit();
}
//パスワードのセッション変数を消す
unset($_SESSION['password'],$_SESSION['class']);
$_SESSION['login']=10;
?>
<!DOCTYPE html>

<html lang="ja">

<head>
	<!--共通-->
	<?php include_once "../common/head.php"; ?>
	<!--単体-->
	<link rel="stylesheet" href="../common/style/add_user_done.css">
</head>

<body>
	<header>
		<h1><?php print $title;?></h1>
		<p><a id="logout" href="<?= 'http://' . $_SERVER["HTTP_HOST"] ?>/common/logout.php">ログアウト</a></p>
	</header>
	<div id="root">
		<div id="spacer"></div>
		<div class="top done">
			<div class="box">
				<h2>初回利用登録が完了いたしました。</h2>
				<p>入力していただいた項目は設定から変更することができます。</p>
				<p>このまま貸出をせず終了する場合は画面右上のログアウトを、<br>
				備品を借りる場合は下のTOPページへをクリックしてください。</p>
				<a href="../service/index.php" class="button">TOPページへ</a>
			</div>
		</div>
	</div>
	<script>
		$("#edit").click(function(){
			var text = $("#code").val();
			$("#code").val('');
			$("#code").focus().removeAttr("readonly").val(text);
		})
	</script>
</body>

</html>