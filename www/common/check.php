<?php
session_start();
session_regenerate_id(false);

//if($_SESSION['login']!=1){
//	echo 'じゃない';
//	var_export($_SESSION);
//	//header('Location: ./NG.php');
//	exit();
//}
//ID.txtを読み取る
$filename = './exe/ID.txt';
$fp = fopen($filename, 'r');
$_SESSION['id'] = fgets($fp);
//$_SESSION['id'] = '16AB0016';
fclose($fp);
//ID.txtで生成されてしまう改行コードを削除
$_SESSION['id'] = preg_replace('/\n|\r|\r\n/', '', $_SESSION['id'] );
try{
	function search ($e){
		require_once('connection_db.php');
		$sql='select code, id, name, mail from '.$e.' where id = ?';
		$stmt=$dbh->prepare($sql);
		$data[]=$_SESSION['id'];
		$stmt->execute($data);
		unset($dbh);
		$rec=$stmt->fetch(PDO::FETCH_ASSOC);
//		var_export($rec);
//		echo $_SESSION['id'];
//		echo $sql;
		if($rec === false && $e === 'student'){
			//生徒で登録済みでなければ
			$_SESSION['login']=0;
			header('Location:../add_user/');
			exit();
		}elseif($rec === false && $e === 'master'){
			//先生で登録済みでなければ
			$_SESSION['login']=0;
			header('Location:../common/NG.php');
			exit();
		}else{
			//登録済みなら
			$_SESSION['login']=10;
			$_SESSION['code']=$rec['code'];
			$_SESSION['name']=$rec['name'];
			$_SESSION['mail']=$rec['mail'];
			header('Location:../service/index.php');
			exit();
		}
	}

	if(preg_match('/\d{2}[A-Z]{2}\d{4}$/', $_SESSION['id'])){
		search('student');
	}else{
		//先生のフラグを用意
		$_SESSION['teacher'] = 1;
		search('master');
	}
}catch(Exception $e){
	header('Location:'.$_SERVER['DOCUMENT_ROOT'].'/common/NG.php');
	exit();
}
?>
