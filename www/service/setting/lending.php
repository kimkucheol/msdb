<?php
session_start();
session_regenerate_id(true);

$title='貸出中備品一覧';
try{
	
	require_once('../../common/connection_db.php');
  
  $sql='select timestamp, log.name as name, item.name as item_name, period from lending, item,(select code, name from student union select code, name from master) as log where lending.code = log.code and lending.item = item.id order by timestamp desc LIMIT ?, ?';
	
	$stmt=$dbh->prepare($sql);
	$to = intval($_GET['to']);
	$cases = intval($_GET['cases']);
	$stmt->bindParam( 1, $to, PDO::PARAM_INT );
	$stmt->bindParam( 2, $cases, PDO::PARAM_INT );
	$stmt->execute();
	
	$sql2='select timestamp, log.name as name, item.name as item_name, period from lending, item,(select code, name from student union select code, name from master) as log where lending.code = log.code and lending.item = item.id order by timestamp desc LIMIT ?, 1';
	$stmt2=$dbh->prepare($sql2);
	$to2 = intval($_GET['to']+20);
	$stmt2->bindParam( 1, $to2, PDO::PARAM_INT );
	$stmt2->execute();
	
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
    <link rel="stylesheet" href="../../common/style/setting/all_history.css">
		<script src="../../common/script/scroll.js"></script>
	</head>
  <body>
    <div class="setting w90">
      <h2>貸出中の備品一覧<span><?php echo $_GET['to'].'～'; ?></span></h2>
      <table>
        <thead>
          <tr>
            <th>日時</th>
            <th>氏名</th>
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
          print'<td>'.$rec['item_name'].'</td>';
          print'<td>'.date('Y-m-d', strtotime($rec['period'])).'</td>';
          print'</tr>';
        }
        ?>
        </tbody>
      </table>
      <div id="pager">
      <?php
			if($to!=0){
				$prev = $_GET['to']-20;
				echo '<a href="?to='.$prev.'&cases=20" class="button">前のページ</a>';
			}else{
				echo '<p class="button button-outline">前のページへ</p>';
			}
			$rec2=$stmt2->fetch(PDO::FETCH_ASSOC);
			if($rec2!=false){
      echo '<a href="?to='.$to2.'&cases=20" class="button">次のページ</a>';
			}else{
				echo '<p class="button button-outline">次のページへ</p>';
			}
			?>
			</div>
    </div>
  </body>
</html>