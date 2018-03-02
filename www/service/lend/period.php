<?php
session_start();
session_regenerate_id(true);
//ページ・ヘッダータイトル
$title="備品の貸し出し期間指定 | 備品管理システム";
if($_SESSION['login']!=10){
	header('Location:'.$_SERVER['DOCUMENT_ROOT'].'/common/NG.php');
	exit();
}

try{
	require_once('../../common/connection_db.php');

	$item = count($_POST['item_id']); //選択した備品の数を配列へ
	$_SESSION['item_id']=$_POST['item_id']; //ここでセッションも作っちゃう
	
	if($item>3 || $item==0){
		header('Location:'.$_SERVER['DOCUMENT_ROOT'].'/common/NG.php');
		exit();
	}
  
	
  for($i=0;$i<$item;$i++){
		${'sql'.$i}='select id, name, month, week, day from item where id='.$_SESSION['item_id'][$i];
		${'stmt'.$i}=$dbh->prepare(${'sql'.$i});
		${'stmt'.$i}->execute();
	}
	$dbh=null;
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
		<title><?php print $title;?></title>
		<?php include_once "../../common/head.php"; ?>
		<link rel="stylesheet" href="../../common/style/lending_select_period.css">
		<script src="../../common/script/jquery-3.2.1.min.js"></script>
		<script src="../../common/script/jquery-ui.min.js"></script>
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
				<form method="post" action="check.php">
					<h2>以下の備品の返却期限を指定してください。</h2>
					<?php
					  for($i=0;$i<$item;$i++){
							while(true){
								${'rec'.$i}=${'stmt'.$i}->fetch(PDO::FETCH_ASSOC);
								if(${'rec'.$i}==null){
									break;
								}
								print'<p class="item-list">';
								print ${'rec'.$i}['name'];
								print'</p>';
								if(${'rec'.$i}['day']!=1){
									print'<label>';
									if(${'rec'.$i}['month']!=''){
										//期限が月指定なら
										$period = date('Y-m-d', strtotime('+'.${'rec'.$i}['month'].' month'));
									}else	if(${'rec'.$i}['week']!=''){
										//期限が週指定なら
										$period = date("Y-m-d", strtotime('+'.${'rec'.$i}['week'].' week'));
									}else{
										$period = date('Y-m-d', strtotime('+'.${'rec'.$i}['day'].' day'));
									}
									print'<input type="date" name="item_period[]" value="'.date("Y-m-d").'" min="'.date("Y-m-d").'" max="'.$period.'">';
									//print'<script>$(function() {$("input").datepicker({dateFormat: "yy-mm-dd"});});</script>';
									print'</label>';
								}else{
									print'<p>当備品は当日のみの貸出となります。</p>';
									print'<input type="hidden" name="item_period[]" value="'.date("Y-m-d").'">';
								}
							}
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
<?php
/*
* $_POST['item_id'] = 配列（備品の主キー）
* $period = 最大貸し出し期間
* そのうち年度末以降まで借りれないようにするif文も入れないとと思う
* 一度に借りれる備品数をいつでも簡単に変えられるようにしておきたい
* このままだと貸し出し処理した後にもう一度貸し出しをしようとすると借りられちゃう問題も回避したい
*/
?>