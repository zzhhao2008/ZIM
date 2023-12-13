<?php
function save_user(){
    global $upath;
    global $user;
    file_put_contents($upath,"<?php return ".var_export($user,1).";?>");
}
$alarm = "";
if ($_POST) {
    $upath = "../database/chat/user/" . $_POST['id'] . ".php";
    if (file_exists($upath)) {
        $user=require($upath);
        if(md5($_POST['password'])===$user['password']){
            session_start();
            setcookie("PHPSESSID",$_COOKIE['PHPSESSID'],time()+3600*24*2,"/");
            $_SESSION['id']=$_POST['id'];
            $_SESSION['loginpas']=md5($_POST['password']);
            $user["loginhistory"][]=array(
                "time"=>time(),
                "ua"=>$_SERVER['HTTP_USER_AGENT'],
            );
            save_user();
            header("location:/main.php");
        }else{
            $alarm="ID或密码错误！";
        }
    }
    else{
        $alarm="ID或密码错误！";
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
    <title>登录Z聊</title>

</head>

<body style="text-align: center;">
    <div class="container">
        <div>
            <h1>登录</h1>
            Z聊专用账号不与主站互通，请重新注册
        </div>
        <form class="bs-example bs-example-form" role="form" method="post">
            <div class="input-group">
                <span class="input-group-addon 	glyphicon glyphicon-user"></span>
                <input type="text" name="id" class="form-control" placeholder="ID">
            </div>
            <br>
            <div class="input-group">
                <span class="input-group-addon glyphicon glyphicon-lock"></span>
                <input type="password" class="form-control" placeholder="密码" name="password">
            </div>
            <br>
            <?php echo $alarm ?>
            <br>
            <a href="loginup.php" class="btn btn-primary">注册</a>
            <button class="btn">登录</button>
        </form>
    </div>
</body>

</html>