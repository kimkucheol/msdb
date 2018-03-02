<?php
session_start();
session_regenerate_id(false);

//ページ・ヘッダータイトル
$title="備品管理システム";

$_SESSION['login']=1;

$path = $_SERVER['DOCUMENT_ROOT'].'\common\exe\testFelica01.exe';

//readfelica.exe起動
$fp = popen('start '.$path, 'r');
pclose($fp);
?>
<!DOCTYPE html>

<html lang="ja">

<head>
	<!--共通-->
	<?php include_once "common/head.php"; ?>
	<!--単体-->
	<script src="<?= 'http://' . $_SERVER["HTTP_HOST"] ?>/common/script/readtxt.js"></script>
	<style>
	body{overflow: hidden;cursor: default;}
	span{font-size: 2rem;}
	body::after{
		position: absolute;
		top: 0;
		left: 0;
		content:"";
		display: block;
		width: 100%;
		height: 100%;
		background-image: url("media/img/dot.png");
		z-index: 2;
	}
	video {
		position: fixed;
		top: 0;
		left: 0;
		width:100%;
		z-index: 1;
		position: relative;
	}
	p {
		position: fixed;
		top: 80%;
/*		top: 60%;*/
		right: 5%;
		font-size: 3rem;
		font-weight: bold;
		text-align: right;
		color: #eee;
		z-index: 3;
		text-shadow: 0 3px 3px #000;
	}
	</style>
</head>

<body>
	<video src="<?= 'http://' . $_SERVER["HTTP_HOST"] ?>/media/movie/top_2.webm" loop autoplay></video>
	<p><span><a href="adminer/">adminer</a></span><br>
<!--		<a href="common/guest.php" style="font-size:4rem;color:#0f4ef8;">Demo：先生としてログイン</a><br>-->
<!--		<a href="common/guest_s.php" style="font-size:4rem;color:#0f4ef8;">Demo：学生としてログイン</a><br>-->
		学生証をICカードリーダーにタッチしてください<br><span>備品管理システム</span></p>
</body>

</html>
<?php
exit();
?>