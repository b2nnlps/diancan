// JavaScript Document
function autoScroll(obj) {
    $(obj).find("ul").animate({
        marginTop: "-30px"
    }, 500, function () {
        $(this).css({marginTop: "0px"}).find("li:first").appendTo(this);
    })
}
$(function () {
    setInterval('autoScroll(".maquee")', 3000);
    setInterval('autoScroll(".apple")', 2000);
})