<?php
$dbh=new PDO('sqlite:'.$_SERVER['DOCUMENT_ROOT'].'/sqlite/sqlite.db');
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
?>