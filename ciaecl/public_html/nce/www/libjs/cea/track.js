/**
* @author Pablo Roman (proman@ing.uchile.cl)
* @version 1.0 2009
* Web Log generator based on cookie tracking
* store user anonymous sessions.
*/

function getCookie(NameOfCookie) {
if (document.cookie.length > 0) {
	begin = document.cookie.indexOf(NameOfCookie+"=");
	if (begin != -1) {
		begin += NameOfCookie.length+1;
		end = document.cookie.indexOf(";", begin);
		if (end == -1) end = document.cookie.length;
		return unescape(document.cookie.substring(begin, end)); 
	}
}
return null;
}

function setCookie (name, value, lifesecond, access_path, domain) {
  var cookietext = name + "=" + escape(value);
    if (lifesecond != null) {
      var today=new Date();
      var expiredate = new Date();
      expiredate.setTime(today.getTime() + 1000*lifesecond);
      cookietext += "; expires=" + expiredate.toGMTString();
    }
    if (access_path != null) {
      cookietext += "; PATH="+access_path ;
    } if (domain != null) {
      cookietext += "; domain=" + domain;
    }
   document.cookie = cookietext;
   return null;
}

function trackCookie(callid) {
   var dummyImage, cookie, query, query2, query3;
   
// setting cookie if not set
   cookie=getCookie('DIIWUM');
   if(cookie==null|cookie=="") {
	cookie='DII'+Math.random();
	setCookie('DIIWUM', cookie, 1800);
   }
   
   dummyImage = new Image();
   url=document.URL;
   //**********
   query="/track.php?x="+url;
   //**********
   query2="&y="+cookie;
   query3="&z="+callid;
   dummyImage.src=query+query2+query3;
   return dummyImage;
}

function trackOUT() {
   trackCookie("OUT");
}

var x=trackCookie("IN");
window.onbeforeunload = trackOUT; 
