function $(eleId) {
    return document.getElementById(eleId);
}

function textTipClear(obj) {
    if (obj.value == obj.defaultValue) {
        obj.value = "";
        obj.style.color = 'black';
        $("searchBoxBorder").style.backgroundColor = "#accde4";
    }
}

function textTipReset(obj) {
    if (obj.value == "") {
        obj.value = obj.defaultValue;
        obj.style.color = '#a5b0b4';
        $("searchBoxBorder").style.backgroundColor = "#dddddd";
    }
}

var rTitle = null;
document.body.onmouseover = function() {
    rTitle = $("title").innerHTML;
    document.body.onmouseover = null;
};

function textSearch(obj) {
    if (obj.value.length == 0) {
        $("title").innerHTML = rTitle;
        $("middle").style.overflowY = "hidden";
        $("searchResult").style.display = "none";
        $("recommend").style.display = "block";
        return;
    }
    $("title").innerHTML = "搜索结果";
    $("middle").style.overflowY = "auto";
    $("recommend").style.display = "none";
    $("searchResult").style.display = "block";
    var result = searchTree(obj.value, TREE_ITEMS);
    var htmlStr = "";
    if (result.length == 0) {
        htmlStr = '<div class="nothing">没有找到相关影片，请搜索其它关键字。</div>';
    } else {
        var color = false;
        for (var i = 0; i < result.length; i++) {
            var current = result[i];
            htmlStr += '<ul class="result ' + ((color = !color) ? 'odd' : 'even') + '"><li class="name">' + current[0] + '</li><li class="option"><a href="../' + current[1] + '" title="点击播放">进入</a></li></ul>';
        }
    }
    $("searchResult").innerHTML = htmlStr;
}

function searchTree(key, target) {
    var result = new Array();
    for (var i = 0; i < target.length; i++) {
        searchItem(key, target[i], result);
    }
    return result;
}

function searchItem(key, target, result) {
    for (var i = 2; i < target.length; i++) {
        var current = target[i];
        if (current.length == 2) {
            if (current[0].indexOf(key) != -1) {
                result.push(current);
            }
        } else {
            searchItem(key, current, result);
        }
    }
}