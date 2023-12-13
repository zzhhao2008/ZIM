<?php
$uinfo;
$upath="../../../database/chat/user/".$uinfo['id'].".php";
$user=$user?$user:array();
$uid=$uinfo['id'];;
function inituser(){
    global $upath;
    global $user;
    if(file_exists($upath)){
        $user=require($upath);
        return true;
    }else{
        $upath="../database/chat/user/".$uinfo['id'].".php";
        if(file_exists($upath)){
            $user=require($upath);
            return true;
        }
    }
    return false;
}
function login_check(){
    global $user;
    global $uinfo;
    if(inituser()){
        return $uinfo['pass']===$user['password'];
    }else{
        return false;
    }
}
function save_user(){
    global $upath;
    global $user;
    file_put_contents($upath,"<?php return ".var_export($user,1).";?>");
}
