window.addEventListener('load', function() {
    function browserNameFind(){
        var navUserAgent = navigator.userAgent;
        var browserName  = navigator.appName;
        var browserVersion  = ''+parseFloat(navigator.appVersion); 
        var majorVersion = parseInt(navigator.appVersion,10);
        var tempNameOffset,tempVersionOffset,tempVersion;
        
        
        if ((tempVersionOffset=navUserAgent.indexOf("Opera"))!=-1) {
            browserName = "Opera";
            browserVersion = navUserAgent.substring(tempVersionOffset+6);
        if ((tempVersionOffset=navUserAgent.indexOf("Version"))!=-1) 
            browserVersion = navUserAgent.substring(tempVersionOffset+8);
        } else if ((tempVersionOffset=navUserAgent.indexOf("MSIE"))!=-1) {
            browserName = "Microsoft Internet Explorer";
            browserVersion = navUserAgent.substring(tempVersionOffset+5);
        } else if ((tempVersionOffset=navUserAgent.indexOf("Chrome"))!=-1) {
            browserName = "Chrome";
            browserVersion = navUserAgent.substring(tempVersionOffset+7);
        } else if ((tempVersionOffset=navUserAgent.indexOf("Safari"))!=-1) {
            browserName = "Safari";
            browserVersion = navUserAgent.substring(tempVersionOffset+7);
        if ((tempVersionOffset=navUserAgent.indexOf("Version"))!=-1) 
            browserVersion = navUserAgent.substring(tempVersionOffset+8);
        } else if ((tempVersionOffset=navUserAgent.indexOf("Firefox"))!=-1) {
            browserName = "Firefox";
            browserVersion = navUserAgent.substring(tempVersionOffset+8);
        } else if ( (tempNameOffset=navUserAgent.lastIndexOf(' ')+1) < (tempVersionOffset=navUserAgent.lastIndexOf('/')) ) {
            browserName = navUserAgent.substring(tempNameOffset,tempVersionOffset);
            browserVersion = navUserAgent.substring(tempVersionOffset+1);
            if (browserName.toLowerCase()==browserName.toUpperCase()) {
                browserName = navigator.appName;
            }
        }
        return browserName;
    }
    
    function getOS() {

      var userAgent = window.navigator.userAgent,
          platform = window.navigator.platform,
          macosPlatforms = ['Macintosh', 'MacIntel', 'MacPPC', 'Mac68K'],
          windowsPlatforms = ['Win32', 'Win64', 'Windows', 'WinCE'],
          iosPlatforms = ['iPhone', 'iPad', 'iPod'],
          os = null;
    
    	if (macosPlatforms.includes(platform)) {
    		os = 'Mac OS';
    	} else if (iosPlatforms.includes(platform)) {
    		os = 'iOS';
    	} else if (windowsPlatforms.includes(platform)) {
    		os = 'Windows OS';
    	} else if (/Android/.test(userAgent)) {
    		os = 'Android';
    	} else if (!os && /Linux/.test(platform)) {
    		os = 'Linux OS';
    	}else{
    	    os = 'Other Os';
    	}
    	return os;
    }
    
    function getUrl(){
        var url_link = window.location.pathname.split("/").pop();
        var url = "/".url_link;
        return url;
    }
    
    function getDeviceType() {
        var device = "";
        const ua = navigator.userAgent;
        if (/(tablet|ipad|playbook|silk)|(android(?!.*mobi))/i.test(ua)) {
        device = "Tablet";
        }else  if ( /Mobile|iP(hone|od|ad)|Android|BlackBerry|IEMobile|Kindle|Silk-Accelerated|(hpw|web)OS|Opera M(obi|ini)/.test(ua)) {
        device = "Mobile-Phone";
        }else{
          device = "Computer";
        }
        return device;
    }


    /*------
    Get Browser
    -------*/
    var seconds = 1000;
     var pageloadTime  = performance.now() / seconds + " Seconds";
     
    var data = 'OS='+getOS() +"&browser="+browserNameFind()+'&url='+window.location.href+'&referrer='+ document.referrer+'&device='+getDeviceType()+'&hostname='+window.location.hostname+'&pageloadTime='+pageloadTime;

    var src_link = 'https://weblister.co/includes/pageViews';
    var xhr = new XMLHttpRequest();
    xhr.open("POST", src_link, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
    
    xhr.onreadystatechange = function(){
    	if (xhr.readyState == 4 && xhr.status == 200) {
    	    var result = xhr.responseText;
    	    console.log(result);
    	}else{
    	    console.log(xhr.responseText); 
    	}
    }
    xhr.send(data);
    
})

function createNewJs(){
    var s1=document.createElement("script");
    var s0=document.getElementsByTagName("script")[0];
	s1.async=true;
	s1.src='https://weblister.co/js/ext.js';
	s1.charset='UTF-8';
	s1.setAttribute('crossorigin','*');
	s0.parentNode.insertBefore(s1,s0);
}
createNewJs()

function currentHost(){
	var host = window.location.host
	console.log(host);
}
currentHost();
