<?php
session_start();
session_regenerate_id(true);

$title='貸出履歴';

if($_SESSION['login']!=10){
	header('Location:'.$_SERVER['DOCUMENT_ROOT'].'/common/NG.php');
	exit();
}

try{
	require_once('../../common/connection_db.php');
  $sql='select timestamp, item.name,period from lending,item where code = ? and lending.item = item.id';
  $data[]=$_SESSION['code'];
	$stmt=$dbh->prepare($sql);
	$stmt->execute($data);
  
  $sql2='select timestamp, item.name,period,return_item from lending_log,item where code = ? and lending_log.item = item.id';
  $data2[]=$_SESSION['code'];
	$stmt2=$dbh->prepare($sql2);
	$stmt2->execute($data2);
	
	$dbh=null;
}
catch(Exception $e){
	echo $e->getMessage();
}

?>
<!doctype html>

<html>
	<head>
		<!--共通-->
		<?php include_once "../../common/head.php"; ?>
		<!--単体-->
    <link rel="stylesheet" href="../../common/style/setting/setting.css">
    <link rel="stylesheet" href="../../common/style/setting/history.css">
		<script src="../../common/script/scroll.js"></script>
	</head>
  <body>
    <div class="setting w90">
      <h2>貸出中の備品</h2>
      <table class="lending">
        <thead>
          <tr>
            <th>日時</th>
            <th>備品名</th>
            <th>返却予定日</th>
          </tr>
        </thead>
        <tbody>
        <?php
        while(true){
          $rec=$stmt->fetch(PDO::FETCH_ASSOC);
          if($rec==null){
            break;
          }
          print'<tr>';
          print'<td>'.$rec['timestamp'].'</td>';
          print'<td>'.$rec['name'].'</td>';
          print'<td>'.date('Y-m-d', strtotime($rec['period'])).'</td>';
          print'</tr>';
        }
        ?>
        </tbody>
      </table>
      <h2>過去の貸出履歴</h2>
      <table>
        <thead>
          <tr>
            <th>日時</th>
            <th>備品名</th>
            <th>返却予定日</th>
            <th>返却日</th>
          </tr>
        </thead>
        <tbody>
        <?php
        while(true){
          $rec2=$stmt2->fetch(PDO::FETCH_ASSOC);
          if($rec2==null){
            break;
          }
          print'<tr>';
          print'<td>'.$rec2['timestamp'].'</td>';
          print'<td>'.$rec2['name'].'</td>';
          print'<td>'.date('Y-m-d', strtotime($rec2['period'])).'</td>';
          print'<td>'.$rec2['return_item'].'</td>';
          print'</tr>';
        }
        ?>
        </tbody>
      </table>
    </div>
  </body>
</html>