<?php
session_start();
session_regenerate_id(true);
//id削除
$filename = './exe/ID.txt';
$fp = fopen($filename, 'w');
fwrite($fp,'1111');
fclose($fp);
header("Location:./check.php");
exit();
?>