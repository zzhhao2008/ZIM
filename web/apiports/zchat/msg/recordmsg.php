<?php
$minfo=json_decode($_GET['mes'],1);
$uinfo=$minfo['userinfo'];
include ("../user/functionset.php");
$res;
if (login_check()) {
    $gp="../../../database/chat/grconfig/".$minfo['group'].".php";
    $gmp="../../../database/chat/grmsg/".$minfo['group'].".php";
    if(!file_exists($gp)||!file_exists($gmp)){
        $res['onerror']=1;
    }else{
        $gc=require($gp);
        $gm=require($gmp);
        if(in_array($uinfo['id'],$gc['users'])){
            include "../../commontext.php";
            $gm[]=array(
                "time"=>time(),
                "msg"=>autotext($minfo['msg']),
                "user"=>$uinfo['id']
            );
            $res['msg']=$gm[count($gm)-1];
            $res['onerror']=0;
            file_put_contents($gmp,"<?php return ".var_export($gm,1).";?>");
        }else{
            $res['onerror']=1;
        }
    }
}else{
    $res['onerror']=1;
}
echo json_encode($res,1);