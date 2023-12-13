<div class="righttools" id="tbar">
    <div id="changemine">
        <div class="toolheadbars">
            修改资料 <button class="closebtn" onclick="closetool()">X</button>
        </div>
        <div class="toolbody">
            <form method="post" action="/apiports/saveabout.php" target="tempifa">
                <input type="hidden" name="reload" value="1">
                <h4>昵称</h4>
                <input type="text" name="name" value="<?php echo $user['name'] ?>"><br>
                <h3>性别</h3>
                <input type="text" name="about[sex]" placeholder="其他" value="<?php echo $user['about']['sex'] ?>">
                <h3>年龄</h3>
                <input type="number" name="about[age]" value="<?php echo $user['about']['age'] ?>">
                <h3>位置</h3>
                <input type="text" name="about[address]" value="<?php echo $user['about']['address'] ?>">
                <h3>个性签名</h3>
                <input type="text" name="about[axqm]" value="<?php echo $user['about']['axqm'] ?>">
                <br>
                <input type="submit" class="btn btn-danger" value="提交">
            </form>
        </div>
    </div>
    <div id="safety">
        <div class="toolheadbars">
            账号安全 <button class="closebtn" onclick="closetool()">X</button>
        </div>
        <div class="toolbody">
            <h2>修改密码</h2>
            <form method="post" action="/apiports/password.php">
                <input type="password" name="y" placeholder="原密码">
                <input type="password" name="n" placeholder="新密码">
                <input type="submit" value="确定">
            </form>
            <h2>登陆历史记录</h2>
            <?php
            include "static/php/user_agent.php";
            foreach ($userdata['loginhistory'] as $v) {
                echo "<p>时间：" . date("Y-m-d H:i:s", $v['time']) . "<br>设备UA:<br>";
                $ua = new CI_User_agent($v["ua"]);
                echo $ua->platform() . '<br>';
                echo $ua->browser() . '<br>';
                echo $ua->version() . '<br>';
                echo $ua->robot() . '<br>';
                echo $ua->mobile() . '<br>';
                echo "</p><hr>";
            }
            ?>
        </div>
    </div>
    <div id="whois">
        <div class="toolheadbars">
            用户详情 <button class="closebtn" onclick="closetool()">X</button>
        </div>
        <div class="toolbody">
            <div id="abouthim" class="aboutme">

            </div>
        </div>
    </div>
    <div id="deog">
        <div class="toolheadbars">
            群详情 <button class="closebtn" onclick="closetool()">X</button>
        </div>
        <div class="toolbody">
            <div id="aboutg" class="aboutme">

            </div>
            <button class="btn btn-info fullbtn" onclick="opentool('sam')">查看本群全部消息</button>
            <button class="btn btn-danger fullbtn" onclick="opentool('lg')">退出本群</button>
        </div>
    </div>
    <div id="cg">
        <div class="toolheadbars">
            创建群 <button class="closebtn" onclick="closetool()">X</button>
        </div>
        <div class="toolbody">
            <form action="/service/creatgroup.php" target="tempifa">
                群名称：<input name="gname"><br>
                用户列表：<textarea name="users" placeholder="100140,100141,1001..."></textarea><br>
                是否允许其他人加入：<input type="checkbox" name="canin" value="y" checked><br>
                <input type="submit" class="btn" value="确定">
            </form>
        </div>
    </div>
    <div id="jg">
        <div class="toolheadbars">
            加入群 <button class="closebtn" onclick="closetool()">X</button>
        </div>
        <div class="toolbody">
            <form action="/service/joingroup.php" target="tempifa">
                群ID：<input name="gid"><br>
                <input type="submit" class="btn" value="确定">
            </form>
        </div>
    </div>
    <div id="lg">
        <div class="toolheadbars">
            离开群 <button class="closebtn" onclick="closetool()">X</button>
        </div>
        <div class="toolbody">
            <form action="/service/leavegroup.php" target="tempifa">
                群ID：<input name="gid" id="leavegid"><br>
                <input type="submit" class="btn" value="确定">
            </form>
        </div>
    </div>
    <div id="sam">
        <div class="toolheadbars">
            群消息 <button class="closebtn" onclick="closetool();document.getElementById('am').innerHTML=''">X</button>
        </div>
        <div class="toolbody">
            <button onclick="lam()">加载</button>
            <div id="am" class="aboutme">

            </div>
        </div>
        <script>
            function lam() {
                fetch("/apiports/groupconfig.php?all=y&groupid=" + nowgroup)
                    .then(response => response.json())
                    .then(data => sam(data.msg))
            }

            function sam(data) {
                var msglist = data
                for (i = 0; i < msglist.length; i++) {
                    data=msglist[i];
                    document.getElementById("am").innerHTML+=`<a href="javascript:lookwhoi(`+data[user]+`)">`+wuser(data[user])+"</a>" + (time == 0 ? "" : " - " + timestampToTime(time)) + "<p>" + data[mes] + "</p>";
                }
            }
        </script>
    </div>
</div>