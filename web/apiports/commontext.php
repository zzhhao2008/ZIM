<?php
function autotext($str){
    $icon=array("/ww"=>"<img src='/icon/gt.jpg' height='25px'>","[doge]"=>"<img src='/icon/gt.jpg' height='25px'>");
    $wjc=array("zzh的爹","zzh","浩浩","爹","父亲","父","爸");
    $str=addslashes($str);
    $str=htmlspecialchars($str);
    foreach ($icon as $k=>$v){
        $str=str_replace($k,$v,$str);
    }
    foreach ($wjc as $k=>$v){
        $str=str_replace($v,"。",$str);
    }
    return $str;
}