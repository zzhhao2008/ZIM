<?php
session_start();
include "../user/functionset.php";
inituser();
if (login_check()) {
} else {
    header("location:/");
    exit;
};
include "../apiports/commontext.php";
$requ=array();
$important=array("gname","users");
$ccnt=0;
foreach($_GET as $k=>$v){
    $requ[$k]=autotext($_GET[$k]);
    if(in_array($k,$important)||$requ[$k]) $ccnt++;
}
if($ccnt<=count($important)){
    echo "<script>alert('请检查空项！')</script>";
    exit;
}
$groupid=json_decode(file_get_contents("../database/chat/system/groupcnt"),1);

$users=json_decode("[".$requ['users']."]",1);
if(!in_array($_SESSION['id'],$users)) $users[]=$_SESSION['id'];


foreach($users as $v){
    $path="../database/chat/user/".$v.".php";
    if(!file_exists($path)){
        unset($users[$v]);
    }else{
        $nu=require($path);
        $nu["group"][]=$groupid;
        file_put_contents($path,"<?php return ".var_export($nu,1).";?>");
    }
}

$groupcfg=array(
    "name"=>$requ['gname'],
    "users"=>$users,
    "creater"=>$_SESSION['id'],
    "ctime"=>time(),
    "canin"=>$requ['canin']==="y"?true:false
);
$gcpath="../database/chat/grconfig/$groupid.php";
$gmpath="../database/chat/grmsg/$groupid.php";


file_put_contents("../database/chat/system/groupcnt",json_encode($groupid+1),1);
file_put_contents($gcpath,"<?php return ".var_export($groupcfg,1)."; ?>");
$time=time();
file_put_contents($gmpath,"<?php return array(array('user'=>'system','msg'=>'创建本群成功！','time'=>$time)); ?>");
echo "<script>top.location.reload();top.group($groupid)</script>";
?>
