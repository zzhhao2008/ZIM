<?php
$alar = "";
function passwordcheck($input)
{
    return strlen($input) > 6;
}
if ($_POST['email'] && $_POST['password']) {
    $syspath = "../database/chat/system/";
    $emailuse = json_decode(file_get_contents($syspath . "emailused"), 1);
    $iduse = json_decode(file_get_contents($syspath . "logups"), 1);
    $id = $iduse['num'] + 100000;
    if (in_array($_POST['email'], $emailuse)) {
        $alar = "邮箱已被使用";
    } elseif (!passwordcheck($_POST['password'])) {
        $alar = "密码不符合要求！至少7位";
    } else {
        echo $id;
        $iduse['num']++;
        $emailuse[] = $_POST['email'];
        file_put_contents($syspath . "emailused", json_encode($emailuse, 1));
        file_put_contents($syspath . "logups", json_encode($iduse, 1));
        session_start();
        setcookie("PHPSESSID", $_COOKIE['PHPSESSID'], time() + 3600 * 24 * 2, "/");
        $_SESSION['id'] = $id;
        $_SESSION['loginpas'] = md5($_POST['password']);
        $user=array("name"=>$id,"jtime"=>time(),"password"=>md5($_POST['password']),"welcome"=>0);
        $user["loginhistory"][] = array(
            "time" => time(),
            "ua" => $_SERVER['HTTP_USER_AGENT'],
        );
        include "./functionset.php";
        $upath="../database/chat/user/".$_SESSION['id'].".php";
        save_user();
        header("location:./welcome.php");
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="shortcut icon" href="/icon.png">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/static/bootstrap-3.4.1-dist/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <title>登录Z聊-注册</title>

</head>

<body style="text-align: center;">
    <div class="container">
        <div>
            <h1>注册</h1>
            Z聊专用账号不与主站互通，请重新注册
        </div>
        <form class="bs-example bs-example-form" role="form" method="post">
            <div class="input-group">
                <span class="input-group-addon glyphicon glyphicon-lock"></span>
                <input type="password" class="form-control" placeholder="密码" name="password" value="<?php echo $_POST['password'] ? $_POST['password'] : "" ?>">
            </div>
            <br>
            <div class="input-group">
                <span class="input-group-addon 	glyphicon glyphicon-briefcase"></span>
                <input type="email" class="form-control" placeholder="邮箱" name="email" value="<?php echo $_POST['email'] ? $_POST['email'] : "" ?>">
            </div>
            <?php
            echo $alar;
            ?>
            <br>
            <a href="./" class="btn btn-primary">返回登录</a>
            <button class="btn">确定</button>
        </form>
    </div>
</body>

</html>