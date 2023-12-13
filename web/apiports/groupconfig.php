<?php
session_start();
include "../user/functionset.php";
inituser();
if (login_check()) {
} else {
    exit;
};
$gcp="../database/chat/grconfig/".$_GET['groupid'].".php";
$gmp="../database/chat/grmsg/".$_GET['groupid'].".php";
if(!file_exists($gcp)||!file_exists($gmp)){
    $return=array("error"=>404);
}else{
    $gc=require($gcp);
    $gm=require($gmp);
    for ($i=max(count($gm)-50,0);$i<count($gm);$i++){
        $gmn[]=$gm[$i];
    }
    if($_GET['all']==="y"){
        $gmn=$gm;
    }
    if($_GET['groupid']==='0'||in_array($_SESSION['id'],$gc['users'])){
        $return=$gc;
        $return['msg']=$gmn;
    }
    else{
        $return=array("error"=>403,);
    }
}
echo json_encode($return,1);
