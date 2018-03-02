<?php
session_start();
session_regenerate_id(true);
//ページ・ヘッダータイトル
$title="不正アクセス | 備品管理システム";
?>
<html lang="ja">

<head>
	<!--共通-->
	<?php include_once "head.php"; ?>
	<!--単体-->
	<meta http-equiv="refresh" content="5;URL=<?= 'http://' . $_SERVER["HTTP_HOST"] ?>/common/logout.php">
	<style>
	.ng{
		display:flex;
		align-items:center;
		justify-content:center;
		flex-direction:column;
	}
	p{
		font-size:2.2rem;
		font-weight:700;
	}
	</style>
</head>

<body>
	<header>
		<h1><?php print $title;?></h1>
	</header>
	<div id="root">
		<div id="spacer"></div>
		<div class="top ng">
				<p>不正な入力・アクセスを検知しました</p>
				<p>5秒後に自動的にトップへ移動します</p>
        <a href="<?= 'http://' . $_SERVER["HTTP_HOST"] ?>/common/logout.php" class="button">トップへ戻る</a>
		</div>
	</div>
	<!--仮設置-->
	<a href="service/" id="gotop">TOPへ</a>
</body>

</html>