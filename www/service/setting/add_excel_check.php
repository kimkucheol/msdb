<?php
session_start();
session_regenerate_id(true);

if($_SESSION['login']!=10){
	header('Location:'.$_SERVER['DOCUMENT_ROOT'].'/common/NG.php');
	exit();
}

// ファイル名の指定
$readFile = $_POST['file'];

// 連想配列でデータ受け取り
$data = readXlsx($readFile);

//$_SESSION['excel']=$data;

/* nullにするやつ
array_walk_recursive($data, function (&$val, $key) {
    $val = str_replace('sm', null, $val);
});
*/

// ファイル名渡したら配列返すラッパー関数
function readXlsx($readFile){
  // ライブラリファイルの読み込み （パス指定し直す）
  require_once '../../common/PHPExcel/IOFactory.php';

  // ファイルの存在チェック
  if (!file_exists($readFile)) {
    exit($readFile. "が見つかりません。" . EOL);
  }
  // xlsxをPHPExcelに食わせる
  $objPExcel = PHPExcel_IOFactory::load($readFile);

  // 配列形式で返す
  return $objPExcel->getActiveSheet()->toArray(null,true,false,null);
  $sheet->getStyle()->getBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_NONE);
}


/*
$id=array(56,34);
$sql = "SELECT hoge FROM hogetable WHERE id=?" . str_repeat(" or id=?", count($id) - 1);
$stmt = $pdo->prepare($sql);
$sql = "SELECT hoge FROM hogetable WHERE id in (?" . str_repeat(",?", count($id) - 1) .")";
*/

/*$post['a']='a';
$post['b']='b';
$post['c']='c';

$de[]='a';
$de[]='a';
$de[]='a';
echo var_export($de);
*/

if($row > 1000){
  $row = 1000;//musql,phpの一度に挿入できるデータ件数は1000までなので
}

?>
<!doctype html>
<html>
<head>
  <!--共通-->
  <?php include_once "../../common/head.php"; ?>
  <!--単体-->
  <link rel="stylesheet" href="../../common/style/setting/setting.css">
  <script src="../../common/script/scroll.js"></script>
</head>
<body>
  <div class="setting">
  <p>下記内容で備品を新規追加します。</p>
  <?php
  $count = count($data[0]);// 行数
  echo $count,'<br>';
  $row =  count($data) -1;
  echo $row.'件のデータ';
  ?> 
  <form method="post" action="add_excel_done.php">
  <table>
    <thead>
    <?php		
    for($i = 0;$i<6;$i++){
      echo '<th>'.$data[0][$i].'</th>';
    }
    ?>
    </thead>
    <tbody>
    <?php
		$co=0;
    for($j = 1;$j<=$row;$j++){
      echo '<tr>';
      for($i = 0;$i<6;$i++){
        echo '<td>'.$data[$j][$i].'</td>';
				switch ($i){
					case 0: print'<input type="hidden" name="name[]" value="'.$data[$j][$i].'">';
									break;
					case 1: print'<input type="hidden" name="category[]" value="'.$data[$j][$i].'">';
									break;
					case 2: print'<input type="hidden" name="lending[]" value="'.$data[$j][$i].'">';
									break;
					case 3: print'<input type="hidden" name="month[]" value="'.$data[$j][$i].'">';
									break;
					case 4: print'<input type="hidden" name="week[]" value="'.$data[$j][$i].'">';
									break;
					case 5: print'<input type="hidden" name="day[]" value="'.$data[$j][$i].'">';
									break;
				} 
      }
      echo '</tr>';
    }
		
		print'<input type="hidden" name="count" value="'.$row.'">';
    ?>
    </tbody>
  </table>
  <br>
  <input type="submit" value="次へ進む">
	</form>
  </div>
</body>
</html>