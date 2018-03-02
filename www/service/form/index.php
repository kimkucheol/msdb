<?php
session_start();
session_regenerate_id(true);

//ページ・ヘッダータイトル
$title="お問い合わせ | 備品管理システム";

if($_SESSION['login']!=10){
	header('Location:'.$_SERVER['DOCUMENT_ROOT'].'/common/NG.php');
	exit();
}
?>
	<!DOCTYPE html>
	<html lang="ja">

	<head>
		<title><?php print $title;?></title>
		<?php include_once "../../common/head.php"; ?>
		<style>
      #spacer{
        margin-bottom: 3rem;
      }
      form > *{
        width: 60rem !important;
        margin: 1rem auto;
        display: block;
      }
      textarea{
        height: 30rem;
        margin-bottom: 3rem;
      }
    </style>
	</head>
	<body>
		<header>
			<h1><?php print $title;?></h1>
			<p id="id"><?php print'ようこそ'.$_SESSION['name'].'様'; ?></p>
			<p><a id="logout" href="<?= 'http://' . $_SERVER["HTTP_HOST"] ?>/common/logout.php">ログアウト</a></p>
		</header>
		<div id="root">
			<div id="spacer"></div>
			<div class="form">
				<div>
				  <form action="done.php" method="post">
            <h2>機能追加要望などはこちらからよろしくお願いします。</h2>
            <input type="text" required name="name" placeholder="氏名（必須）">
            <input type="email" name="mail" placeholder="メールアドレス（返信が必要な場合）">
            <textarea name="body" required placeholder="本文 : お問い合わせ内容を入力してください。"></textarea>
            <button type="submit">確認</button>
				  </form>
				</div>
			</div>
		</div>
	</body>
	</html>