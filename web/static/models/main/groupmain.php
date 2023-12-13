<div class="groupdiv" id=grdiv>
    <div class="groupheader">
        <a onclick="closegroup()">&lt;返回</a>
        <span id="grname"></span>
        <button class="btn glyphicon glyphicon-th-list" style="height: 100%;background:none;float:right;" onclick="opentool('deog')"></button>
    </div>
    <div class="mesbox" id="mesbox">

    </div>
    <div class="sendbox">
        <textarea name="message" id="mess" placeholder="消息..."></textarea>
        <button class="btn btn-info" onclick="send()">发送</button>
    </div>
</div>
<style>

</style>
<script>
    mesbox = document.getElementById("mesbox");
    var users = [];
    function groupmain(data, groupid) {
        if (data.error == 404) {
            alert("群已被解散！");
            closegroup();
        } else if (data.error == 403) {
            alert("权限出错！");
            closegroup();
        } else {
            nowgroup = groupid
            document.getElementById("grname").innerHTML = data.name;
            var msglist = data.msg
            for (i = 0; i < msglist.length; i++) {
                drawmes(msglist[i])
            }
            document.getElementById("aboutg").innerHTML = `<h1>` + data.name + `</h1>群号：`+groupid+`<h5>由`+wuser(data.creater)+`在`+timestampToTime(data.ctime)+`创建</h5><p><h3>用户列表</h3>`;
            var userss=data.users;
            for (i = 0; i < userss.length; i++) {
                document.getElementById("aboutg").innerHTML+=`<a href="javascript:lookwhoi(`+userss[i]+`)">`+wuser(userss[i])+"</a><br>";
            }
            mesbox.scrollTo(0, mesbox.scrollHeight);
            document.getElementById("alaof" + groupid).style.display='none';
            document.getElementById("leavegid").value=groupid;
        }
    }
</script>