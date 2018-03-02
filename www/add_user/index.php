<?php
session_start();
session_regenerate_id(true);
//ページ・ヘッダータイトル
$title="ユーザー登録 | 備品管理システム";

if($_SESSION['login']!=0){
	header('Location:'.$_SERVER['DOCUMENT_ROOT'].'/common/NG.php');
	exit();
}
$_SESSION['login'] = 3;
try{
	require_once('../common/connection_db.php');
	//学科をDBから抽出
	$sql='select * from class order by id';
	$stmt=$dbh->prepare($sql);
	$stmt->execute();
  $dbh = null;
}
catch(Exception $e){
	//header('Location:'.$_SERVER['DOCUMENT_ROOT'].'/common/NG.php');
	//exit();
}
?>
<!DOCTYPE html>

<html lang="ja">

<head>
	<!--共通-->
	<?php include_once "../common/head.php"; ?>
	<!--単体-->
	<link rel="stylesheet" href="../common/style/add_user_index.css">
</head>

<body>
	<header>
		<h1><?php print $title;?></h1>
		<p><a id="logout" href="<?= 'http://' . $_SERVER["HTTP_HOST"] ?>/common/logout.php">終了</a></p>
	</header>
	<div id="root">
		<div id="spacer"></div>
		<div class="form">
			<div class="box">
				<form action="check.php" method="post">
					<h2>初回利用の場合、下記入力フォームより登録をお願いします。</h2>
					<?php
					if(isset($_SESSION['add_user_error_flg'])){
						echo'<small>パスワードと確認用パスワードが一致しません。<br>再度入力をしてください。</small>';
					}
					?>
					<p>氏名を入力してください。</p>
					<input type="text" name="name" placeholder="氏名（フルネーム）" required>
					<p>学籍番号を入力してください。</p>
					<div class="flex">
						<input type="text" id="code" name="id" value="<?php print $_SESSION['id']; ?>" placeholder="学籍番号" required readonly>
						<button type="button" id="edit">学籍番号を編集</button>
					</div>
					<p>学科を選択してください。</p>
					<select name="class">
					<?php
					while(true){
						$rec=$stmt->fetch(PDO::FETCH_ASSOC);
						if($rec==null){
							break;
						}
						//医療系もレコードに入れてるけど、基本使わないだろうからウェブ科をデフォルトで選択された状態にしよう
						if($rec['id']==200){
							$flg="selected";
						}else{
							$flg='';
						}
						print'<option value="'.$rec['id'].'" '.$flg.'>'.$rec['name'];
						print'</option>';
					}
					?>
					</select>
					<p>メールアドレスを入力してください。</p>
					<input type="email" name="mail" placeholder="メールアドレス">
					<p>パスワードを入力してください。</p>
					<input type="password" name="password" placeholder="パスワード" required>
					<p>確認のため、再度パスワードを入力してください。</p>
					<input type="password" name="password2" placeholder="再度パスワード入力（確認用）" required>
					<input type="submit" value="確認画面へ進む">
				</form>
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
