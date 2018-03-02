<?php
session_start();
session_regenerate_id(true);
//ページ・ヘッダータイトル
$title="備品の追加処理を完了しました";

if($_SESSION['login']!=10){
	header('Location:'.$_SERVER['DOCUMENT_ROOT'].'/common/NG.php');
	exit();
}

if($_SESSION['login']!=10){
	header('Location:'.$_SERVER['DOCUMENT_ROOT'].'/common/NG.php');
	exit();
}

try{
	require('../../common/connection_db.php');
	
	$count = $_POST['count'];
	$name = $_POST['name'];
	$category = $_POST['category'];
	$lending = $_POST['lending'];
	$month = $_POST['month'];
	$week = $_POST['week'];
	$day = $_POST['day'];
	
	$sql='select max(id) as id from item';
	$stmt=$dbh->prepare($sql);
	$stmt->execute();
	
	$rec=$stmt->fetch(PDO::FETCH_ASSOC);

	$nmax=$rec['id'];
	$nmax++;
	
	for($i=0;$i<$count;$i++){		
		${'sql1'.$i}='insert into item (id, name, category, lending, month, week, day) values (?,?,?,?,?,?,?)';
		${'data1'.$i}[]=$nmax + $i;
		${'data1'.$i}[]=$name[$i];
		${'data1'.$i}[]=$category[$i];
		${'data1'.$i}[]=$lending[$i];
		${'data1'.$i}[]=$month[$i];
		${'data1'.$i}[]=$week[$i];
		${'data1'.$i}[]=$day[$i];
		${'stmt1'.$i}=$dbh->prepare(${'sql1'.$i});
		${'stmt1'.$i}->execute(${'data1'.$i});
	}
	$dbh=null;
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
    <link rel="stylesheet" href="../../common/style/setting/setting.css">
    <link rel="stylesheet" href="../../common/style/setting/add_excel_done.css">
	</head>
	<body>
		<div class="top setting">
      <div>
        <h2><?php echo $title; ?></h2>
      </div>
    </div>
	</body>
	</html>