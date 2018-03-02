<?php
session_start();
//id削除
$filename = './exe/ID.txt';
$fp = fopen($filename, 'w');
fwrite($fp,'');
fclose($fp);
//session情報・cookie削除
$_SESSION=array();
if(isset($_COOKIE[session_name()])==true){
	setcookie(session_name(),'',time()-42000,'/');
}
session_destroy();
//トップへ戻る
header("Location:../index.php");
exit();
?>
