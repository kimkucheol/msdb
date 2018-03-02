<?php
session_start();
session_regenerate_id(true);
//ページ・ヘッダータイトル
$title="設定 | 備品管理システム";

if($_SESSION['login']!=10){
	header('Location:'.$_SERVER['DOCUMENT_ROOT'].'/common/NG.php');
	exit();
}

try{
	require_once('../../common/connection_db.php');
  $sql='select administrator from master where code = ?';
  $data[]=$_SESSION['code'];
	$stmt=$dbh->prepare($sql);
	$stmt->execute($data);
	
	$dbh=null;
}
catch(Exception $e){
	echo $e->getMessage();
}

$rec=$stmt->fetch(PDO::FETCH_ASSOC);
?>
	<!DOCTYPE html>
	<html lang="ja">

	<head>
		<!--共通-->
		<?php include_once "../../common/head.php"; ?>
		<!--単体-->
		<link rel="stylesheet" href="../../common/style/setting/setting_index.css">
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
			<div class="setting">
				<div class="list">
					<div>
						<nav>
							<ul>
                <?php
                  if($_SESSION['code']>999){
                    //生徒なら
                    echo'<li><a href="setting_profile_s.php" target="setting">アカウント編集</a></li>';
										echo'<li><a href="history.php" target="setting">貸出履歴</a></li>';
                  }else{
                    //先生なら
                    echo'<li><a href="setting_profile_t.php" target="setting">アカウント編集</a></li>';
										echo'<li>貸出履歴';
										echo'<ul><li><a href="history.php" target="setting">あなたの貸出履歴</a></li>';
										echo'<li><a href="all_history.php?to=0&cases=20" target="setting">全貸出履歴</a></li>';
										echo'<li><a href="lending.php?to=0&cases=20" target="setting">貸出中備品一覧</a></li></ul>';
										echo'</li>';
                  }
                ?>
								<li><a href="version.html" target="setting">バージョン情報</a></li>
								<?php
								if($rec['administrator']==1){
								?>
								<li><a href="setting_add_item.php" target="setting">備品追加</a></li>
                <li>試験実装
                  <ul>
                    <li><a href="add_excel.php" target="setting">Excelで備品追加</a></li>
                    <li><a href="student_delete.php" target="setting">貸出権限剥奪</a></li>
                  </ul>
                </li>
                <?php
                }
                ?>
							</ul>
						</nav>
					</div>
				</div>
				<?php
          if($_SESSION['code']>999){
            //生徒なら
            echo'<iframe src="../setting/setting_profile_s.php" frameborder="0" name="setting"></iframe>';
          }else{
            //先生なら
            echo'<iframe src="../setting/setting_profile_t.php" frameborder="0" name="setting"></iframe>';
          }
        ?>
      </div>
		</div>
	</body>
	</html>