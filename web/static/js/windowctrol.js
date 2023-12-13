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