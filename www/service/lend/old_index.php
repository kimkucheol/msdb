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
			<form class="" action="period.html" method="post">
			<?php
			$categoryname='';
			echo '<div id="flex_container">';
			while ($rec=$stmt->fetch(PDO::FETCH_ASSOC)) {
				if($rec['categoryname'] != $categoryname){
					$categoryname = $rec['categoryname'];
					echo '<h3 id="'.$rec['categoryid'].'">'.$rec['categoryname'].'</h3>';
				}
				//カテゴリーごとの備品を書き出し
				echo '<div><input name="item_id[]" type="checkbox" class="'.$rec['id'].'" id="item_'.$rec['id'].'" value="'.$rec['id'].'">';
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
			exit();
			?>
			</form>
		</div>






		<!--古いやつ-->
		<form method="post" action="period.php">
			<div class="item_list">

				<div class="item">
				<?php
				$cate="";
				while(true){
					if($rec['category']!=$cate){
						if($cate!=""){
							print'</tbody></table></div>';
						}
						print'<div class="categorybox" id="'.$rec['categoryid'].'">';
						print'<p>'.$rec['categoryname'].'</p>';
						print'<table>';
						print'<thead><tr>';
						print'<th>&nbsp;</th><th>画像</th><th>備品名</th><th>最大貸出期間</th><th>貸出可否</th>';
						print'</tr></thead>';
						print'<tbody>';
						$cate=$rec['category'];
					}
					print'<tr>';
					//貸出可否の分岐
					if($rec['lending']==0){
						//$disabled ='disabled';
            print'<td></td>';
						$status ='貸し出し中';
					}else{
						//$disabled ='';
            print'<td><input name="item_id[]" type="checkbox" class="'.$rec['id'].'" id="item_'.$rec['id'].'" value="'.$rec['id'].'"'.$disabled.'></td>';
						$status ='';
					}

					if($rec['path']==null){
						$img = "<p>No Image.</p>";
					}else{
						$img = '<img src="../../media/img/item/'.$rec['path'].'">';
					}
					print'<td><div class="thumb">'.$img.'</div></td>';
					print'<td><label for="item_'.$rec['id'].'">'.$rec['name'].'</label></td>';
					//貸し出し期間の表示分岐
					if ($rec['month']!=''){
						//monthに数値が書かれていたら
						print'<td>'.$rec['month'].'ヶ月</td>';
					}else if($rec['week']!=''){
						//weekに数値が書かれていたら
						print'<td>'.$rec['week'].'週間</td>';
					}else{
						//残りの日
						print'<td>'.$rec['day'].'日</td>';
					}
					print'<td>'.$status.'</td>';
					print'</tr>';
				}
				?>
				</div>
				<div class="select_item">
					<div>
						<h2>選択した備品</h2>
						<ul class="select">
						</ul>
						<input type="reset" id="reset" value="リセット">
						<input id="submit" type="submit" value="次へ進む" disabled>
					</div>
				</div>
			</div>
		</form>
	</div>
	<script>
	$(function () {
		$("input[type='checkbox']:checked").each(function (i) {
			var item = $(this).attr("id");
			var name = $(this).parent().next().next().html();
			$(".select").append('<li><label for=' + item + ' id="c_' + item + '">' + name + '</label></li>');
			$("#submit").removeAttr("disabled")
		})

		$("input[type='checkbox']").click(function () {
			var $not = $('input[type=checkbox]').not(':checked')
			var item = $(this).attr("id");
			var name = $(this).parent().next().next().html();
			if($("input[type=checkbox]:checked").length < 3){
				$("#submit").removeAttr("disabled")
				$not.attr("disabled",false);
				/*inputの属性を保存*/
				if ($(this).prop('checked') == true) {
					/*チェックが付けられたら複製*/
					$(".select").append('<li><label for=' + item + ' id="c_' + item + '">' + name + '</label></li>');
				} else {
					/*チェックが外されたら削除*/
					$("#c_" + item).parent().remove();
					if($(".select *").length == 0){
						$("#submit").attr("disabled",true)
					}
				}
				return true;
			}else{
				$not.attr("disabled",true);
				$(".select").append('<li><label for=' + item + ' id="c_' + item + '">' + name + '</label></li>');
			}
		});
		$("#reset").click(function(){
			$(".select *").remove();
			$("input[type=checkbox]").attr("disabled",false);

		})
	})
	</script>
</body>
</html>
