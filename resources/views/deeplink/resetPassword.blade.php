
<!DOCTYPE html>
<html lang="en">
<head> 
<META NAME="MSSmartTagsPreventParsing" CONTENT="True">
<META HTTP-EQUIV="Expires" CONTENT="0">
<META HTTP-EQUIV="Pragma" CONTENT="No-Cache">
<META HTTP-EQUIV="Cache-Control" CONTENT="No-Cache,Must-Revalidate,No-Store">  
<meta property="og:locale" content="en_US" />
<meta property="og:type" content="article" />
<meta property="og:title" content="Hupo" />
<meta property="og:description" content="Hupo platform" />
<meta property="og:image" content="" />
<meta property="og:site_name" content="Gospic Application" />
</head>
</body>

<input type="hidden" name="baseUrl" value="{{url('/')}}">
</body>
<script src='//code.jquery.com/jquery-1.11.2.min.js'></script>
<script src='//mobileesp.googlecode.com/svn/JavaScript/mdetect.js'></script>
<script type="text/javascript">
(function() {	
   
    var ua = navigator.userAgent.toLowerCase();
    var isAndroid = ua.indexOf("android") > -1; //&& ua.indexOf("mobile");
    var isIphone = ua.indexOf("iphone") > -1;
    var url = window.location.href;
    var em = 0;//test for
  
 var baseUrl = $("input[name=baseUrl]").val();
    if(isAndroid) {
        var url = 'jobcaster://com.caltexmusic.app?type=reset';
       // var appURL = 'https://play.google.com/store/apps/details?id=com.jobcaster';
        var appURL = 'https://play.google.com/store/apps';
         window.location = url;
                var now = new Date().valueOf();
                setTimeout(function () {
                    if ((new Date().valueOf() - now) > 1500)
                        return;
                    window.location = appURL;
                }, 5000);
   
  } else if (isIphone) {
                window.location.replace("caltexlogin://type=reset");    
                  this.timer = setTimeout(this.openWebApp, 10000);
            } else {
              
             window.location.href = baseUrl;    
    }

  app.launchApp();
})();
</script>

</html>