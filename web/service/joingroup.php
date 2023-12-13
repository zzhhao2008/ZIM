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
if(!$_GET['gid']){
    echo "<script>alert('请检查空项！')</script>";
    exit;
}
$groupid=autotext($_GET['gid']);
$gcpath="../database/chat/grconfig/$groupid.php";
if(!file_exists($gcpath)){
    echo "<script>alert('群不存在！！')</script>";
    exit;
}
$gc=require($gcpath);
if($gc["canin"]&&!in_array($_SESSION['id'],$gc['users'])){
    $gc['users'][]=$_SESSION['id'];
    file_put_contents($gcpath,"<?php return ".var_export($gc,1)."; ?>");
    if(!in_array($groupid,$user['group'])){
        $user['group'][]=$groupid;
        save_user();
    }
    
}else{
    echo "<script>alert('无法加群')</script>";
    exit;
}



echo "<script>;top.send('reloadusers');top.location.reload();</script>";
?>
