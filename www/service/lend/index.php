<?php
session_start();
session_regenerate_id(true);
//ページ・ヘッダータイトル
$title="借りたい備品を選択してください | 備品管理システム";

if($_SESSION['login']!=10){
	header('Location:'.$_SERVER['DOCUMENT_ROOT'].'/common/NG.php');
	exit();
}

try{
	require_once('../../common/connection_db.php');

	//備品一覧をカテゴリごとに、借りられないのを下に、名前の順で表示
	$sql='select *, category.name as categoryname from category, item where category.id = item.category order by item.category,item.lending desc, item.name';
	$stmt=$dbh->prepare($sql);
	$stmt->execute();

	//備品のカテゴリを表示
  $sql2='select * from category';
	$stmt2=$dbh->prepare($sql2);
	$stmt2->execute();

	$dbh=null;
}
catch(Exception $e){
	header('Location:'.$_SERVER['DOCUMENT_ROOT'].'/common/NG.php');
	exit();
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
	<!--共通-->
	<?php include_once "../../common/head.php"; ?>
	<!--単体-->
	<link rel="stylesheet" href="../../common/style/item_list.css">
	<script src="../../common/script/scroll.js"></script>
</head>

<body>
	<header>
		<div class="back"><a href="../"><img src="../../media/img/back.png" alt="戻る"></a></div>
		<h1><?php print $title;?></h1>
		<p id="id"><?php print'ようこそ'.$_SESSION['name'].'様'; ?></p>
		<p><a id="logout" href="<?= 'http://' . $_SERVER["HTTP_HOST"] ?>/common/logout.php">ログアウト</a></p>
	</header>
	<div id="root">
		<div id="spacer"></div>
		<div id="item_list">
			<div id="category">
				<h2>カテゴリー</h2>
				<ul>
				<?php
				while(true){
					$rec2=$stmt2->fetch(PDO::FETCH_ASSOC);
					if($rec2==null){
						break;
					}
					print'<li><a href="#'.$rec2['categoryid'].'">';
					print $rec2['name'];
					print'</a></li>';
				}
				?>
				</ul>
			</div>
			<form class="" action="period.php" method="post">
			<?php
			$categoryname='';
			echo '<div id="flex_container">';
			while ($rec=$stmt->fetch(PDO::FETCH_ASSOC)) {
				if($rec['categoryname'] != $categoryname){
					$categoryname = $rec['categoryname'];
					echo '<h3 id="'.$rec['categoryid'].'">'.$rec['categoryname'].'</h3>';
				}
				//カテゴリーごとの備品を書き出し
				echo '<div>';
				if($rec['lending']==1){
					echo '<input name="item_id[]" type="checkbox" class="'.$rec['id'].'" id="item_'.$rec['id'].'" value="'.$rec['id'].'">';
				}
				echo '<label for="item_'.$rec['id'].'">';
				echo '<div class="thmb">';
				if($rec['path']==null){
					$img = '<img src="../../media/img/noimg.jpg">';
				}else{
					$img = '<img src="../../media/img/item/'.$rec['path'].'">';
				}
				echo $img;
				echo '<p>'.$rec['name'].'</p>';
				echo '</div>';
				//貸し出し期間の表示分岐
				if ($rec['month']!=''){
					//monthに数値が書かれていたら
					print'<p>'.$rec['month'].'ヶ月</p>';
				}else if($rec['week']!=''){
					//weekに数値が書かれていたら
					print'<p>'.$rec['week'].'週間</p>';
				}else{
					//残りの日
					print'<p>'.$rec['day'].'日</p>';
				}
				//貸出可否の分岐
				if($rec['lending']==0){
					echo'<p>貸し出し中</p>';
				}else{
					//$disabled ='';
					echo'<p>貸出可</p>';
				}
				echo '</label></div>';
			}
			echo '</div>';
			?>
			<div id="select_item">
				<div>
					<p><span id="count">0</span>/3 選択中</p>
					<input type="reset" value="リセット" class="input_block">
					<input type="submit" value="次へ" class="input_block">
				</div>
			</div>
			</form>
		</div>
	</div>
	<script>
	window.onload = function(){
		$("input[type='checkbox']").click(function () {
			if($("input[type=checkbox]:checked").length < 4){
				//チェックが3箇所なら
				$("#count").html($("input[type=checkbox]:checked").length);
			}else{
				//チェックが3箇所以上なら
				alert("一度に借りられる備品の数は3つまでとなります。");
				return false;
			}
		});
		$("input[type='reset']").click(function () {
			$("#count").html('0');
		})
		$("input[type='submit']").click(function () {
			if($("input[type=checkbox]:checked").length === 0){
				alert("借りる備品を選択してください。");
				return false;
			}
		})
	}
	</script>
</body>
</html>
