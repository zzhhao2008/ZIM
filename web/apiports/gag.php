<?php
session_start();
include "../user/functionset.php";
inituser();
if (login_check()) {
} else {
    exit;
};
function ggc($gid)
{
    $gcp = "../database/chat/grconfig/" . $gid . ".php";
    $gmp = "../database/chat/grmsg/" . $gid . ".php";
    if (!file_exists($gcp) || !file_exists($gmp)) {
        $return = array("error" => 404);
    } else {
        $gc = require($gcp);
        if (in_array($_SESSION['id'], $gc['users'])) {
            $gm = require($gmp);
            $mn = $gm[count($gm) - 1];
            $gc['msgnewest'] = $mn['user'] . ":" . $mn['msg'];
            $gc['t'] = $mn['time'];
            $return = $gc;
        } else {
            $return = array("error" => 403,);
        }
    }
    return $return;
}

$ulist = array();
$ans = array();
$i=1;
foreach ($user['group'] as $k => $v) {
    $ans[$i] = ggc($v);
    $ans[$i]['id'] = $v;
    foreach($ans[$i]['users'] as $vv){
        if(!in_array($vv,$ulist)){
            $ulist[]=$vv;
        }
    }
    $i++;
}
$un = array();
foreach ($ulist as $v) {
    $gup = "../database/chat/user/" . $v . ".php";
    if (!file_exists($gup)) continue;
    $un[$v] = require ($gup);
    $un[$v]=$un[$v]['name'];
    if ($_GET['id']==='100013') $un[$v]="zzh的孙子-LYZ";
}
$un['system']="System";
$ans[0]=$un;
$ans['length']=$i-1;
echo json_encode($ans, 1);
?>