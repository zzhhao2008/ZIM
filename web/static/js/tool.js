var nowtool;

function opentool(toolid) {
    closetool()
    document.getElementById("tbar").style.display = "block";
    document.getElementById(toolid).style.display = "block";
    nowtool = toolid;
}

function closetool() {
    document.getElementById("tbar").style.display = "none";
    if(!nowtool) return;
    document.getElementById(nowtool).style.display = "none";
    nowtool=""
}
//about USer:
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
