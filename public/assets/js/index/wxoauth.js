/**
 * Created by JasonLee on 2017/5/21.
 */

;(function () {
    function MyModule() {
        // ...
    }
    var moduleName = MyModule;
    if (typeof module !== 'undefined' && typeof exports === 'object' && define.cmd) {
        module.exports = moduleName;
    } else if (typeof define === 'function' && define.amd) {
        define(function () { return moduleName; });
    } else {
        this.moduleName = moduleName;
    }
}).call(function () {
    return this || (typeof window !== 'undefined' ? window : global);
});

var wxmidName = "wxmid";//参数名称

//简单鉴权 - 仅获取OpenId
function checkOAuth_base() {
    var cDetail = cookieDetail();
    var key = new RegExp(cDetail.CookieKey_Base + "=");

    if (checkCookieKey(cDetail.CookieName, key) == false) {
        var comebackurl = document.location.href;
        SNSApi_Base(comebackurl);
        return false;
    }
    return true;
}

//完整鉴权 - 需要关注
function checkOAuth_user() {
    var cDetail = cookieDetail();
    var key = new RegExp(cDetail.CookieKey_UserInfo + "=");

    if (checkCookieKey(cDetail.CookieName, key) == false) {
        var comebackurl = document.location.href;
        SNSApi_UserInfo(comebackurl);
        return false;
    }
    return true;
}

//绑定检测 - 需要绑定
function checkOAuth_bind() {
    var result = false;

    if (checkOAuth_user() == true) {
        var bind = checkBind();
        result = bind.Validation;

        if (result == false) {
            document.location.href = bind.Url;
        }
    }
    return result;
}

//微信浏览器检测
function checkOAuth_wxBrowser() {
    if (isWeiXin() == true) {
        return checkOAuth_base();
    }
    return false;
}

//今日数据检测
function checkOAuth_dailyReport() {
    var result = false;

    if (checkOAuth_user() == true) {
        var report = checkDailyReport();
        result = report.Validation;

        if (result == false) {
            document.location.href = report.Url;
        }
    }
    return result;
}

function isWeiXin() {
    var ua = window.navigator.userAgent.toLowerCase();
    if (ua.match(/MicroMessenger/i) == 'micromessenger') {
        return true;
    } else {
        return false;
    }
}

function checkDailyReport() {
    var report = {};
    var ajaxUrl = "/WXMember/CheckDailyReport";

    $.ajax({
        type: 'Get',
        url: ajaxUrl,
        async: false,
        success: function (result) {
            report = result;
        }
    });
    return report;
}

function checkBind() {
    var bind = {};
    var ajaxUrl = "/WXMember/CheckBind";

    $.ajax({
        type: 'Get',
        url: ajaxUrl,
        async: false,
        success: function (result) {
            bind = result;
        }
    });
    return bind;
}

function cookieDetail() {
    var cDetail = {};
    var ajaxUrl = "/Cookie/GetCookie";

    $.ajax({
        type: 'Get',
        url: ajaxUrl,
        async: false,
        success: function (result) {
            cDetail = result;
        }
    });
    return cDetail;
}

function SNSApi_Base(comebackurl) {
    var wxmid = getUrlParam(wxmidName);
    var sendurl = "/WeiXin/wxoauthagent.ashx?req=auth&authtype=snsapi_base&comeurl=" + encodeURIComponent(comebackurl) + "&wxmid=" + wxmid;

    document.location.href = sendurl;
}


function SNSApi_UserInfo(comebackurl) {
    var wxmid = getUrlParam(wxmidName);
    var sendurl = "/WeiXin/wxoauthagent.ashx?req=auth&authtype=snsapi_userinfo&comeurl=" + encodeURIComponent(comebackurl) + "&wxmid=" + wxmid;
    //alert(sendurl);
    document.location.href = sendurl;
}

function checkCookieKey(c_name, key) {
    var result = false;

    if (c_name != "" && key != "") {
        var cookie = getCookie(c_name);
        if (cookie != "") {
            result = key.test(cookie);
        }
    }
    return result;
}

function getCookie(c_name) {
    var result = "";

    if (document.cookie.length > 0) {
        c_start = document.cookie.indexOf(c_name + "=")
        //alert(document.cookie);
        if (c_start != -1) {
            c_start = c_start + c_name.length + 1
            c_end = document.cookie.indexOf(";", c_start)
            if (c_end == -1) c_end = document.cookie.length
            result = document.cookie.substring(c_start, c_end);
        }
    }
    return result;
}

function getUrlParam(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i"); //构造一个含有目标参数的正则表达式对象 ，不区分大小写
    var r = window.location.search.substr(1).match(reg);  //匹配目标参数
    if (r != null) {
        return unescape(r[2]);  //返回参数值
    } else {
        return null;
    }
}