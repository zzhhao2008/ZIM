<?php
$upath="../database/chat/user/".$_SESSION['id'].".php";
$user=$user?$user:array();
$uid=$_SESSION['id'];;
function inituser(){
    global $upath;
    global $user;
    if(file_exists($upath)){
        $user=require($upath);
        return true;
    }else{
        $upath="database/chat/user/".$_SESSION['id'].".php";
        if(file_exists($upath)){
            $user=require($upath);
            return true;
        }
    }
    //echo $upath;
    return false;
}
function login_check(){
    global $user;
    if(inituser()){
        return $_SESSION['loginpas']===$user['password'];
    }else{
        return false;
    }
}
function save_user(){
    global $upath;
    global $user;
    file_put_contents($upath,"<?php return ".var_export($user,1).";?>");
}
