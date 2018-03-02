<?php
session_start();
session_regenerate_id(true);
//ページ・ヘッダータイトル
$title="学生一覧";

if($_SESSION['login']!=10){
	header('Location:'.$_SERVER['DOCUMENT_ROOT'].'/common/NG.php');
	exit();
}

try{
	require_once('../../common/connection_db.php');
	
	//貸出権限がある学生一覧を表示
	$sql='select code,student.id as stid,student.name as stna,student.class as stcl,rejection,class.id as clid,class.name as clna from student,class where student.class = class.id and rejection = 1';
	$stmt=$dbh->prepare($sql);
	$stmt->execute();
	
	//学科一覧を表示
  $sql2='select distinct class.name, class.id from student,class where student.class = class.id';
	$stmt2=$dbh->prepare($sql2);
	$stmt2->execute();
  
  
  if(isset($_POST['id'])){
  //検索
  $_POST['id']=htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
  $sql3='select * from student where id like "%'.$_POST['id'].'%"';
  //$data3[]=$_POST['id'];
	$stmt3=$dbh->prepare($sql3);
	$stmt3->execute();
  }
	
	$dbh=null;
	
}
catch(Exception $e){
	print 'DBエラー : 管理者を呼ぼう。';
}
?>
	<!DOCTYPE html>
	<html lang="ja">

	<head>
		<!--共通-->
		<?php include_once "../../common/head.php"; ?>
		<!--単体-->
		<link rel="stylesheet" href="../../common/style/setting/student_delete.css">
		<script src="../../common/script/scroll.js"></script>
	</head>

	<body>
    <div class="student_list">
      <div class="class">
        <div>
          <h2>学科</h2>
            <ul>
              <li><form method="post"><input type="text" name="id" placeholder="学籍番号（半角入力）"></form></li>
              <?php
              while(true){
                $rec2=$stmt2->fetch(PDO::FETCH_ASSOC);
                if($rec2==null){
                  break;
                }
                print'<li><a href="#'.$rec2['id'].'">';
                print $rec2['name'];
                print'</a></li>';
              }
              ?>
            </ul>
          </div>
      </div>
      <div class="student">
        <?php
        if(isset($_POST['id'])){
          print'<div class="categorybox">';
          print'<p>'.$_POST['id'].'の検索結果</p>';
          print'<table><thead><tr>';
          print'<th>&nbsp;</th><th>名前</th><th>学籍番号</th><th>貸出権限</th>';
          print'</tr></thead>';
          print'<tbody>';
          print'<tr>';
          while(true){
            $rec3=$stmt3->fetch(PDO::FETCH_ASSOC);
            if($rec3==null){
              print'</tbody></table></div>';
              break;
            }

            //貸出可否の分岐
            if($rec3['rejection']==0){
              $disabled ='';
              $status ='権限なし';
            }else{
              $disabled ='';
              $status ='';
            }
            print'<td><input name="item_id[]" type="checkbox" class="'.$rec3['code'].'" id="s_'.$rec3['code'].'" value="'.$rec3['code'].'"'.$disabled.'></td>';
            print'<td><label for="s_'.$rec3['code'].'">'.$rec3['name'].'</label></td>';
            print'<td>'.$rec3['id'].'</td>';
            print'<td>'.$status.'</td>';
            print'</tr>';
          }
        }
        ?>
        <?php
        $cate="";
        while(true){
          $rec=$stmt->fetch(PDO::FETCH_ASSOC);
          if($rec==null){
            print'</tbody></table></div>';
            break;
          }
          if($rec['stcl']!=$cate){
            if($cate!=""){
              print'</tbody></table></div>';
            }

            print'<div class="categorybox" id="'.$rec['clid'].'">';
            print'<p>'.$rec['clna'].'</p>';
            print'<table><thead><tr>';
            print'<th>&nbsp;</th><th>名前</th><th>学籍番号</th><th>貸出権限</th>';
            print'</tr></thead>';
            print'<tbody>';
            $cate=$rec['stcl'];
          }
          print'<tr>';
          //貸出可否の分岐
          if($rec['rejection']==0){
            $disabled ='';
            $status ='権限なし';
          }else{
            $disabled ='';
            $status ='';
          }
          print'<td><input name="item_id[]" type="checkbox" class="'.$rec['code'].'" id="item_'.$rec['code'].'" value="'.$rec['code'].'"'.$disabled.'></td>';
          print'<td><label for="item_'.$rec['code'].'">'.$rec['stna'].'</label></td>';
          print'<td>'.$rec['stid'].'</td>';
          print'<td>'.$status.'</td>';
          print'</tr>';
        }
        ?>
      </div>
      <div class="select_student">
        <div>
          <form method="post" action="student_delete_check.php">
            <h2>選択した学生</h2>
            <ul class="select">
            </ul>
            <input type="submit" value="無効にする">
          </form>
          </div>
        </div>
    </div>
		<script>
			$(function(){
				$("input").prop('checked', false);
        $("input[type=submit]").attr('disabled', 'disabled');
				$('input').click(function() {
    			if(!($('.select_student input[type=hidden]')).length)  {
      			$('input[type=submit]').attr('disabled', 'disabled');
					} else{
						$('input[type=submit]').removeAttr('disabled');
					}
  			});
			})
			
			$(".student input").click(function() {
				var val = $(this).attr('value');
				var chk = $(this).prop('checked');
				
				if(chk == true){
					var checkbox=$(this).parent().html();
					var name=$(this).parent().next().html();
					$(".select").append('<li>'+checkbox +name+'</li>');
					$(".select_student input[type='checkbox']").attr('type','hidden');
				} else {
					$(".select #item_" + val).parent().remove();
				}
				return true;
			});
		</script>
	</body>
	</html>