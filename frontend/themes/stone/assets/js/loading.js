// 浏览器兼容 取得浏览器可视区高度
function getWindowInnerHeight() {
    var winHeight = window.innerHeight
        || (document.documentElement && document.documentElement.clientHeight)
        || (document.body && document.body.clientHeight);
    return winHeight;

}

// 浏览器兼容 取得浏览器可视区宽度
function getWindowInnerWidth() {
    var winWidth = window.innerWidth
        || (document.documentElement && document.documentElement.clientWidth)
        || (document.body && document.body.clientWidth);
    return winWidth;

}

/**
 * 显示遮罩层
 */
function showOverlay() {
    // 遮罩层宽高分别为页面内容的宽高
    $('.overlay').css({'height': $(document).height(), 'width': $(document).width()});
    $('.overlay').show();
}

/**
 * 显示Loading提示
 */
function showLoading() {
    // 先显示遮罩层
    showOverlay();
    // Loading提示窗口居中
    $("#loadingTip").css('top',
        (getWindowInnerHeight() - $("#loadingTip").height()) / 2 + 'px');
    $("#loadingTip").css('left',
        (getWindowInnerWidth() - $("#loadingTip").width()) / 2 + 'px');

    $("#loadingTip").show();
    $(document).scroll(function () {
        return false;
    });
}

/**
 * 隐藏Loading提示
 */
function hideLoading() {
    $('.overlay').hide();
    $("#loadingTip").hide();
    $(document).scroll(function () {
        return true;
    });
}