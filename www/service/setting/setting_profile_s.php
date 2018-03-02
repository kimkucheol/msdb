<?php
session_start();
session_regenerate_id(true);

$title = 'アカウント情報を変更';

if($_SESSION['login']!=10){
	header('Location:'.$_SERVER['DOCUMENT_ROOT'].'/common/NG.php');
	exit();
}

try{
	require_once('../../common/connection_db.php');

  //submitを押されたら
  if(isset($_POST['submit'])){
    if($_POST['pass']!=$_POST['pass2']||preg_match('/(\p{Han}|\p{Hiragana}|\p{Katakana}|[a-zA-Z]){2,}/u',$_POST['name'])==false){
        $result='パスワードが一致しませんでした。<br>入力内容に誤りがないかご確認ください。';
    }else{
      if(isset($_POST['pass'])){
        $_POST['pass']=md5($_POST['pass']);
      }
      //参考サイト
      //http://www.flatflag.nir87.com/update-950
      //$_POST配列をupdate文で使うときに邪魔なsubmitとpassword2を消す
      unset($_POST['submit'],$_POST['pass2']);
      //$_POST配列の中身の空要素を配列から消す
      $_POST=array_filter($_POST, 'strlen');
      //update文で使えるように値をカンマ区切りにする
      $set = implode(array_keys($_POST),' = ?, ').'= ?';
      //配列の添え字を数字に振りなおす
      $val = array_values($_POST);

      $sql3='update student set '.$set.' where code = ?';
      $val[]=$_SESSION['code'];
      $stmt3=$dbh->prepare($sql3);
      $stmt3->execute($val);
    }
  }
	//学科をDBから抽出
	$sql='select * from class order by id';
	$stmt=$dbh->prepare($sql);
	$stmt->execute();
  
  if($_SESSION['code']>999){
    //使用者のクラスを抽出
    $sql2='select * from student where code='.$_SESSION['code'];
    $stmt2=$dbh->prepare($sql2);
    $stmt2->execute();
    
    $rec2=$stmt2->fetch(PDO::FETCH_ASSOC);
    $_SESSION['id']=$rec2['id'];
    $_SESSION['name']=$rec2['name'];
    $_SESSION['mail']=$rec2['mail'];
  }else{
    header('location: setting_profile_t.php');
    exit();
  }
  $dbh=null;
}
catch(Exception $e){
  echo $e->getMessage();
}
?>
<!doctype html>
<html>
<head>
  <?php include_once "../../common/head.php"; ?>
  <link rel="stylesheet" href="../../common/style/setting/setting.css">
  <link rel="stylesheet" href="../../common/style/setting/setting_profile.css">
</head>
  <body>
	<div class="setting">
		<form method="post">
			<h2><?php echo $title; ?></h2>
			<?php
			if(isset($result)){
				echo '<p style="color:red;">'.$result.'</p>';
			}
			?>
			<p>氏名</p>
			<input type="text" name="name" value="<?php echo $_SESSION['name']; ?>" required>
			<p>学籍番号</p>
			<input type="text" name="id" value="<?php echo $_SESSION['id']; ?>" required>
      <?php if($_SESSION['code']>999){
      echo '<p>クラス</p>';
      echo '<select name="class">';
        while(true){
          $rec=$stmt->fetch(PDO::FETCH_ASSOC);
          if($rec==null){
            break;
          }
          if($rec['id']==$rec2['class']){
            $flg="selected";
          }else{
            $flg='';
          }
          print'<option value="'.$rec['id'].'" '.$flg.'>'.$rec['name'];
          print'</option>';
        }
      echo'</select>';
      }
      ?>
			<p>メールアドレス</p>
			<input type="email" name="mail" value="<?php echo $_SESSION['mail']; ?>" required>
			<p>下記項目は変更する場合のみ入力してください</p>
			<p>パスワード</p>
			<input type="password" value='' name="pass" placeholder="新しいパスワードを入力">
			<p>パスワード（確認用）</p>
			<input type="password" value='' name="pass2" placeholder="新しいパスワードを入力（確認用）">
			<input type="submit" name="submit" value="変更">
		</form>
	</div>
  </body>
</html>