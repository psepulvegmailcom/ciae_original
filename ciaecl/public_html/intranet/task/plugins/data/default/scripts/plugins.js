function GetID(ID) {
	return document.getElementById(ID);
}

function OkCancel(Msg) {
	this.blur();
  if (confirm(Msg)) return true;
  else return false;
}

var plg_RedirTime = false;
function plg_Redirector(Timer) {
	if (plg_RedirTime === false) plg_RedirTime = Timer;
	if (plg_RedirTime > 0) {
		GetID('plg_redirector').innerHTML = 'Redirecting in <span style="color:#990000>' + plg_RedirTime-- + '</span> seconds...'
		plg_RedirID = self.setTimeout("plg_Redirector()", 1000)
	}
  else {
		clearTimeout(plg_RedirID);
    location.href='plugins.php';
  }
}