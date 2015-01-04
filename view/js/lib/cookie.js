/**
 * @author: fenicesun <fenicesun@tencent.com>
 * @date: 2015/1/4
 * cookie operation
 * add,get,delete 
 *
 *
 */

;(function($) {
    
    var cookie = {
        
        setCookie: function(key, value, expires, Path, Domain, Secure) {
                        var cookieString = key + "=" + encodeURIComponent(value);

                        if (expires) {
                            var date = new Date();
                            date.setTime(date.getTime + expires * 3600 * 1000);
                            cookieString += "; expires=" + date.toGMTString();
                        }

                        if (Path) {
                            cookieString += "; path=" + Path;
                        }

                        if (Domain) {
                            cookieString += "; domain=" + Domain;
                        }

                        if (Secure) {
                            cookieString += "; secure";
                        }
                        document.cookie = cookieString;
                },
        
        getCookie: function(key) {
                        var sRE = "(?:; )?" + key + "=([^;]*);?";
                        var oRE = new RegExp(sRE);
                        if (oRE.test(document.cookie)) {
                            return decodeURIComponent(RegExp["$1"]);
                        } else {
                            return null;
                        }
                },

        deleteCookie: function(key, Path, Domain) {
                        var date = new Date(0);
                        this.setCookie(key, '', date.toGMTString(), Path, Domain);
                }

    }

    $.COOKIE = cookie;
        
})(jQuery);
