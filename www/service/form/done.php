<?php
session_start();
session_regenerate_id(true);

//ページ・ヘッダータイトル
$title="送信完了 | 備品管理システム";

//PHP内部の日本語をユニコードでエンコード
mb_language('ja');
mb_internal_encoding('UTF-8'); 

//*環境設定*************************************
$subject = "備品管理システムお問い合わせフォーム";

$bcc = "tec_contact@dgzero.com";//管理者にbccでメール送信
//管理人メールアドレス(宛先)
if($_POST['mail']==''||isset($_POST['mail'])==false){
  $to = $bcc;
}else{
  $to = $_POST["mail"] ;//控えメール
}

//差出人メールアドレス格納
$header ="From:y_kato@bokunet.com";
$header.="\n";
$header.="Bcc:".$bcc;
//本文格納
$body ="備品管理システムのお問い合わせ、送信ありがとうございます。以下、控えメールとなります。\nお寄せいただいた内容は今後の備品管理システムの改善に活用させていただきます。";
$body.="■氏名：" . $_POST["name"] ."\n";
$body.="■メールアドレス：" . $_POST["mail"] ."\n";
$body.="■本文：" . $_POST["body"] ."\n";
var_export($_POST);
  
if(mb_send_mail($to,$subject,$body,$header)){
   echo "アンケートありがとうございます。控えメールを送信しました。";
}else{
   echo "メール送信失敗しました。";
}

?>
<!doctype html>
<html>
<head>
  <title><?php print $title;?></title>
	<?php include_once "../../common/head.php"; ?>
</head>
<body>
  <header>
    <h1><?php print $title;?></h1>
    <p id="id"><?php print'ようこそ'.$_SESSION['name'].'様'; ?></p>
    <p><a id="logout" href="<?= 'http://' . $_SERVER["HTTP_HOST"] ?>/common/logout.php">ログアウト</a></p>
  </header>
  <div id="root">
    <div id="spacer"></div>
    <div class="top lending_done">
      <div class="box">
        <h2>送信しました。</h2>
        <p>ご協力ありがとうございました。</p>
        <a href="http://localhost/common/logout.php" class="button">操作を終了する</a>
        <a href="../index.php" class="button">ユーザートップへ戻る</a>
      </div>
    </div>
  </div>
</body>
</html>