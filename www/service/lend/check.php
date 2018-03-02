<?php
session_start();
session_regenerate_id(true);
//ページ・ヘッダータイトル
$title="貸出備品確認 | 備品管理システム";

if($_SESSION['login']!=10){
	header('Location:'.$_SERVER['DOCUMENT_ROOT'].'/common/NG.php');
	exit();
}

$_SESSION['item_period']=$_POST['item_period'];
$item = count($_SESSION['item_id']); //選択した備品の数を配列へ

//日本語の曜日配列
$weekjp = array(
  '日', //0
  '月', //1
  '火', //2
  '水', //3
  '木', //4
  '金', //5
  '土'  //6
);

try{
	require_once('../../common/connection_db.php');

	for($i=0;$i<$item;$i++){
		${'sql'.$i}='select id, name, month, week, day from item where id = '.$_SESSION['item_id'][$i].' and lending = 1';
		${'stmt'.$i}=$dbh->prepare(${'sql'.$i});
		${'stmt'.$i}->execute();
	}
	$dbh=null;

	for($i=0;$i<$item;$i++){
		${'rec'.$i}=${'stmt'.$i}->fetch(PDO::FETCH_ASSOC);
		if(${'rec'.$i}['month']!=''){
			$limit = date('Y-m-d', strtotime('+'.${'rec'.$i}['month'].' month'));
		}else if(${'rec'.$i}['week']!=''){
			$limit = date('Y-m-d', strtotime('+'.${'rec'.$i}['week'].' week'));
		}else{
			$limit = date('Y-m-d', strtotime('+'.${'rec'.$i}['day'].' day'));
		}
		
		if($_POST['item_period'][$i]>$limit){
			header('Location:'.$_SERVER['DOCUMENT_ROOT'].'/common/NG.php');
			exit();
		}
	}
	
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
		<link rel="stylesheet" href="../../common/style/lending_check.css">
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
					<h2>貸出内容を確認の上、貸出ボタンを押してください。</h2>
						<ul>
						<?php
						for($i=0;$i<$item;$i++){
							//$nowtimestamp = mktime(date('Y-m-d'));
							$nowweekno = date('w');//今日
							$timestamp = strtotime($_POST['item_period'][$i]);
							$weekno = date('w', $timestamp);//返却曜日
							print '<li class="bold">'.${'rec'.$i}['name'];
							print '<ul><li>貸出期間<span>'.date('Y-m-d').'（'.$weekjp[$nowweekno].'）～'.$_POST['item_period'][$i].'（'.$weekjp[$weekno].'）</span></li></ul>';
							print '</li>';
						}
						
						?>
						</ul>
					<div class="button_flex">
						<button type="button" onclick="history.go(-2)">戻る</button>
						<input type="submit" id="submit" value="貸出">
					</div>
				</form>
			</div>
		</div>
	</body>
	</html>
<?php
/*
* $item = 選択した備品の数
* $_SESSION['item_period'], $_POST['item_period'] = 配列（返却日）
* $_SESSION['item_id'] = 配列（備品の主キー）
* $newtimestamp = 今日の日付をタイムスタンプ形式に変換
+ $nowweekno = 今日の曜日番号
* $timestamp = 返却日をタイムスタンプ形式に変換
* $weekno = 返却日の曜日番号
*/
?>