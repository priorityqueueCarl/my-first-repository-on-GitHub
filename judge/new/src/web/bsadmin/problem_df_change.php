<?php
require_once("header-files.php");

if ($mod=='hacker') {
        header("Location:index.php");
    }

if($_SERVER['REQUEST_METHOD']=="POST"){
  //require_once("../include/check_post_key.php");
}else{
  require_once("../include/check_get_key.php");
}
?>

<?php
$plist = "";
sort($_POST['pid']);
foreach($_POST['pid'] as $i){
  if($plist)
    $plist.=','.intval($i);
  else
    $plist = $i;
}
//echo "===".$plist;

if(isset($_POST['enable'])&&$plist){
  $sql = "UPDATE `problem` SET defunct='N' WHERE `problem_id` IN ($plist)";           
  pdo_query($sql);
}else if(isset($_POST['disable'])&&$plist){
  $sql = "UPDATE `problem` SET defunct='Y' WHERE `problem_id` IN ($plist)";           
  pdo_query($sql);
}else{
  $id = intval($_GET['id']);
  $sql = "SELECT `defunct` FROM `problem` WHERE `problem_id`=?";
  $result = pdo_query($sql,$id);

  $row = $result[0];
  $defunct = $row[0];
  echo $defunct;

  if($defunct=='Y') $sql = "UPDATE `problem` SET `defunct`='N' WHERE `problem_id`=?";
  else $sql = "UPDATE `problem` SET `defunct`='Y' WHERE `problem_id`=?";
  pdo_query($sql,$id) ;
}
?>

<script language=javascript>history.go(-1);</script>
