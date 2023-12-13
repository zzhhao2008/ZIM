bars = []
nbar = 2
var nowgroup = 0
for (i = 1; i <= nbar; i++) {
    bars[i] = document.getElementById('bar' + i);
}
pages = []
for (i = 1; i <= nbar; i++) {
    pages[i] = document.getElementById('page' + i);
}

function activebar(barid) {
    for (i = 1; i <= nbar; i++) {
        bars[i].setAttribute("class", "navbar-item");

    }
    bars[barid].setAttribute("class", "navbar-item active");
}

function activepage(barid) {
    for (i = 1; i <= nbar; i++) {
        // pages[i].style.left = '-100%';
        pages[i].style.transform = 'translateX(-100%)'; // 修改：使用平移实现动效
    }
    //pages[barid].style.translate='1200%';
    pages[barid].style.transform = 'translateX(100%)'; // 修改：使用平移实现动效
}

function bar(id) {
    activebar(id)
    activepage(id)
}

bar(1)

var nowtool;

function opentool(toolid) {
    document.getElementById("tbar").style.display = "block";
    document.getElementById(toolid).style.display = "block";
    nowtool = toolid;
}

function closetool() {
    document.getElementById("tbar").style.display = "none";
    document.getElementById(nowtool).style.display = "none";
}
function clearAllCookie() {
    var keys = document.cookie.match(/[^ =;]+(?=\=)/g);
    if (keys) {
        for (var i = keys.length; i--;)
            document.cookie = keys[i] + '=0;expires=' + new Date(0).toUTCString()
    }
}

function logout() {
    clearAllCookie()
    window.location = "/user/out.php";
}

var user = [];

function showabout(data) {
    user = data
    document.getElementById("about").innerHTML = `
        <b>`+ data['name'] + ` </b><br>
        Zid:`+ uid + `<br>
        个性签名：`+ data['about']['axqm'] + `<br>
        `+ data.about.age + "岁 " + data.about.sex + " " + data.about.address + `
        `;
}

function loadaboutme() {
    fetch("/apiports/getuserabout.php")
        .then(response => response.json())
        .then(data => showabout(data));
}
loadaboutme()
function showabouthim(data, gid) {
    document.getElementById("abouthim").innerHTML = `<b>` + data['name'] + ` </b><br>Zid:` + gid;
    if (data.about) {
        document.getElementById("abouthim").innerHTML += `<br>个性签名：` + data['about']['axqm'] + `<br>` + data.about.age + "岁 " + data.about.sex + " " + data.about.address + ``;
    }
}

function lookwhoi(gid) {
    if (nowtool) closetool()
    document.getElementById("tbar").style.display = "block";
    document.getElementById("whois").style.display = "block";
    nowtool = "whois";
    fetch("/apiports/getuserabout.php?id=" + gid)
        .then(response => response.json())
        .then(data => showabouthim(data, gid));
}

history.pushState(null, null, document.URL);
window.addEventListener('popstate', function () {
    history.pushState(null, null, document.URL);
});

function group(groupid) {
    document.getElementById("grdiv").style.display = "block";
    fetch("/apiports/groupconfig.php?groupid=" + groupid)
        .then(response => response.json())
        .then(data => groupmain(data, groupid))

}
function closegroup() {
    nowgroup=''
    document.getElementById("grdiv").style.display = "none";
    document.getElementById("grname").innerHTML = "";
    mesbox.innerHTML="";
    document.getElementById("aboutg").innerHTML = "";
}
function timestampToTime(timestamp) {

    let date = new Date(timestamp * 1000); //时间戳为10位需*1000，时间戳为13位的话不需乘1000
    let Y = date.getFullYear() + '-';
    let M = (date.getMonth() + 1 < 10 ? '0' + (date.getMonth() + 1) : date.getMonth() + 1) + '-';
    let D = (date.getDate() < 10 ? '0' + date.getDate() : date.getDate()) + ' ';
    let h = (date.getHours() < 10 ? '0' + date.getHours() : date.getHours()) + ':';
    let m = (date.getMinutes() < 10 ? '0' + date.getMinutes() : date.getMinutes()) + ':';
    let s = date.getSeconds() < 10 ? '0' + date.getSeconds() : date.getSeconds();
    return Y + M + D + h + m + s;
}

function drawmes(data) {
    mes = "msg"; user = "user";
    time=data.time;
    if (data[user] == uid) {
        data[user]='';
        mesbox.innerHTML += "<div class='minediv'>" + data[user] + (time == 0 ? "" : "" + timestampToTime(time)) + "<br><p class='mine'>" + data[mes] + "</p><br></div>"
    } else {
        
        mesbox.innerHTML += `<a href="javascript:lookwhoi(`+data[user]+`)">`+users[data[user]]+"</a>" + (time == 0 ? "" : " - " + timestampToTime(time)) + "<p>" + data[mes] + "</p>"
    }
}

msglist = document.getElementById("msglist");

function showmsgs(data) {
    for (i = 0; i <= data.length; i++) {
        ti=i
        //console.log(data[ti])
        if (data[ti].error) continue;
        if(i==0){
            users=data[0];
            continue;
        }
        msglist.innerHTML += `<a href="javascript:group(` + data[ti].id + `)" class="group-link">
        <img src="/icon.png" class="group-icon">
        <span class='et' id='etof`+data[ti].id+`'>`+ timestampToTime(data[ti].t) + `</span>
        <div class="group-details">
            <span class="ua">` + data[ti].name + `<b style="color:red;display:none" class="glyphicon glyphicon-bell" id="alaof`+data[ti].id+`"></b></span>
            <span class="message-preview" id="previewof`+data[ti].id+`">` + data[ti].msgnewest + `</span>
        </div>
        
    </a><hr>`;
    }
};

function getmsglist() {
    fetch("/apiports/gag.php")
        .then(response => response.json())
        .then(data => showmsgs(data))
}
getmsglist()