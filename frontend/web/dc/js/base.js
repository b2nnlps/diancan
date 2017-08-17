/*
 API公共库
 基础库，会带登录
 */
var username, hash, device_id, addUrl;

username = getQueryString("username");
hash = getQueryString("hash");
device_id = getQueryString("device_id");
addUrl = "username=" + username + "&hash=" + hash + "&device_id=" + device_id;

function getQueryString(name) { //获取get传过来的用户信息
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
    var r = window.location.search.substr(1).match(reg);
    if (r != null) return decodeURI(r[2]);
    return null;
} 