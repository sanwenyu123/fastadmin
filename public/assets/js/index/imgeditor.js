/**
 * Created by JasonLee on 2017/5/21.
 */

function addImgHtml(src) {
    var insertHtml = '<button class="pic_btn"><img src="' + src + '" class="complain_square"/><span class="background-color_content color_white close">×</span></button>'
    $('.background-color_white.btn_group').append(insertHtml);
}

$.ready(
    $(".background-color_white.btn_group").on('tap', '.close',function () {
        $(this).parent().remove();
        removeimgLen++;
    })
)

function initWx() {
    $.ajax({
        type: "POST",
        url: KL_BASE_URL + "/apigateway_wx/weixin/gch/pay/weixin/v1/h5Config.do",
        data: {},
        dataType: "json",
        success: function (data) {
            if (data["code"] == 200) {
                tstmp = data["data"]["response"]["timestamp"];
                nonceStr = data["data"]["response"]["noncestr"];
                wx.config({
                    debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
                    appId: data["data"]["response"]["appId"], // 必填，公众号的唯一标识
                    timestamp: data["data"]["response"]["timestamp"], // 必填，生成签名的时间戳
                    nonceStr: data["data"]["response"]["noncestr"], // 必填，生成签名的随机串
                    signature: data["data"]["response"]["paySign"], // 必填，签名，见附录1
                    jsApiList: ['chooseImage', 'uploadImage','chooseWXPay'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
                });
            } else {
                tipDialog.show(tip_fail, '温馨提示', data["message"]);
            }
        },
        error: function () {
            tipDialog.show(tip_fail, '温馨提示', "微信图片接口初始化失败！", function () {
                reloadPage();
            });
        }
    });
}

var currentImgCount=0,localIdsLenth=0,chooseimgLen=0,removeimgLen=0;

function fetchToQiniu(serviceId) {
    if ($("img[class='complain_square']").length >= 9) {
        tipDialog.show(tip_fail, '温馨提示', "最多只能添加9张图片！");
        return;
    }

    $.ajax({
        type: "POST",
        url: KL_BASE_URL + "/apigateway_wx/weixin/gch/pay/weixin/v1/fetchToQiniu.do",
        data: {
            serviceId: serviceId
        },
        dataType: "json",
        success: function (data) {
            if (data["code"] == 200) {
                var key = data["data"]["response"];
                addImgHtml(FILE_BASE_URL_PREX + key);
                currentImgCount++;
            } else {
                tipDialog.show(tip_fail, '温馨提示', data["message"]);
            }
        },
        error: function () {
            tipDialog.show(tip_fail, '温馨提示', "上传失败，请重试！");
        }
    });


}
function init() {
    initWx();
    wx.ready(function () {
        $("#add_pic").click(function () {
//限制9张
            var imglength=$("img[class='complain_square']").length;
            if (imglength>= 9||9-imglength<=0) {
                tipDialog.show(tip_fail, '温馨提示', "最多只能添加9张图片！");
                return;
            }
            wx.chooseImage({
                count: 9-imglength, // 默认9
                sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
                sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
                success: function (res) {
                    var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
                    localIdsLenth=localIds.length;
                    syncUpload(localIds);
                }
            });

            var syncUpload = function (localIds) {
                var localId = localIds.pop();
                wx.uploadImage({
                    localId: localId,
                    isShowProgressTips: 0,// 默认为1，显示进度提示
                    success: function (res) {
                        var serverId = res.serverId; // 返回图片的服务器端ID
//其他对serverId做处理的代码
                        fetchToQiniu(serverId);
                        if (localIds.length > 0) {
                            syncUpload(localIds);
                        }

                    }
                });
            }
        });


    });

}

function getContentJson() {
    var content_text = $("#content_text").val();
    if(content_text.length == 0){
        tipDialog.show(tip_fail,'温馨提示',"详情不能为空！");
        return;
    }
    if(content_text.length >50){
        content_text=content_text.substring(0,50);
        $("#content_text").val(content_text);
        tipDialog.show(tip_fail,'温馨提示',"详情内容超过限制的50个字符，</br>请重新填写确认");
        return;
    }
    var arr = new Array();
    arr.push({ "type": "text", "content": content_text });
    $(".pic_btn img").each(function () {
        arr.push({ "type": "image", "content": $(this).attr("src") });
    });
    return arr;
}

function checkupload(){
    chooseimgLen=$("img[class='complain_square']").length;
    if(currentImgCount!=(chooseimgLen+removeimgLen)||currentImgCount<localIdsLenth){
        return false;
    }
    else{
        return true;
    }
}

