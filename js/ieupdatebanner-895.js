if(!readCookie(ieCookieName)) {
    var ieUpBanner = '<div id="ieUpUpgradeReminderBanner">'
        + '<a href="#" id="ieUpUpgradeReminderBannerX" class="ub_close">close</a>'
        + '<p class="update_text"><strong>' + ieUpMsg + '</strong></p>'
        + '<p class="browsers">'
        + ' <a href="http://ie.microsoft.com/" class="explorer" target="_blank">Internet Explorer</a>'
        + ' <a href="http://www.google.com/chrome" class="chrome" target="_blank">Google Chrome</a>'
        + ' <a href="http://www.mozilla.com/firefox/" class="firefox" target="_blank">Mozilla Firefox</a>'
        + ' <a href="http://www.apple.com/safari/download/" class="safari" target="_blank">Safari</a>'
        + ' <a href="http://www.opera.com/download/" class="opera" target="_blank">Opera</a>'
        + '</p>'
        + '</div>';
    document.write(ieUpBanner);
    document.getElementById('ieUpUpgradeReminderBanner').style.display = 'block';
    document.getElementById('ieUpUpgradeReminderBannerX').attachEvent('onclick', function (){
        var ieCookieDate = new Date().getTime();
        ieCookieDate = new Date(ieCookieDate + ieCookieTime * 1000);
        createCookie(ieCookieName, ieCookieValue, ieCookieDate, ieCookieDomain, ieCookiePath);
        document.getElementById('ieUpUpgradeReminderBanner').style.display = 'none';
        return false;
    });
}