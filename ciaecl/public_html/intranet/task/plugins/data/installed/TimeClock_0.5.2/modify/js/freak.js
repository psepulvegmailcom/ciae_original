---[find]---
		arr = new Array('desc','comm','hist');
---[replace]---
//--> begin Time Clock edit
		arr = new Array('desc','comm','time','hist');
//<-- end Time Clock edit
---[find]---
	freak_stop();
}
---[replace]---
	freak_stop();
}

//--> begin Time Clock addition
// button start/stop function
function freak_time(id,clockId,isRunning,totalTime) {
	freak_start();
	var e = gE('etimeImg'+id);
	var skin = gE('skin');
	
	// parse totalTime string and remove commas
	totalTime = totalTime.replace(/,/g,"");
	totalTime = parseInt(totalTime);

	if (isRunning == false) {
	 	// start clock
		xajax_task_clock_start(id,clockId,totalTime);
		e.src = "skins/"+skin.value+"/images/b_stop.png";
	}
	else {
		// stop clock
		xajax_task_clock_stop(id,clockId);
		e.src = "skins/"+skin.value+"/images/b_start.png";
	}
}

// javascript timer, runs every second
function freak_timer(startTime,elementId,dayAbbr) {

	var nextTime = startTime + 1;
	
	//convert to milliseconds
 	var timeMsec = startTime * 1000;
	var objTime = new Date(timeMsec);

	// need to use GMT time zone
	gmtTime = objTime.getTime() + (objTime.getTimezoneOffset() * 60000);
	var t = new Date(gmtTime);

	// calculate days
	var secInDay = 86400;
	var numOfDays = startTime / secInDay;
	var d = Math.floor(numOfDays);

	var h=t.getHours();
	var m=t.getMinutes();
	var s=t.getSeconds();

	// add a zero in front of numbers, if less than 10
	h=freak_timer_format(h);
	m=freak_timer_format(m);
	s=freak_timer_format(s);

	// show results
	var ei = gE(elementId);
	if (ei) {
		var output = "";
	 	if (d > 0) {
			var output = d+dayAbbr+" ";
		}
		ei.innerHTML = output+h+":"+m+":"+s;
		setTimeout("freak_timer("+nextTime+",'"+elementId+"','"+dayAbbr+"')",1000);
	}
}

// add a zero in front of numbers, if less than 10
function freak_timer_format(i) {
	if (i<10) {
	 	i="0" + i;
	}
	return i;
}

// restart timer
function freak_timer_restart(id,clockId,totalTime) {
	freak_start();
	xajax_task_clock_timer_restart(id,clockId,totalTime);	
}

function freak_edit_time(field,totalTime,dayAbbr) {
	//set checkbox value
	ff.elements[field].checked = false;
	var index = 1;
	var d = gE('t_days');

	//show current time in drop-downs
	if (totalTime!="") {
		var h = gE('t_hours');
		var m = gE('t_mins');
		var s = gE('t_secs');

		//parse time format Dd HH:MM:SS
		totalTime = totalTime.replace("  ","");

		var totalArray = totalTime.split(dayAbbr); //not necessarily "d"
		var days = totalArray[0];
		if (isNaN(days)) { // no days, only time
			var days = 0;
		}
		if (totalArray[1]==null) { 
			index = 0; 
		}
		var timeArray = totalArray[index].split(":");
		var hours = timeArray[0];
		var mins = timeArray[1];
		var secs = timeArray[2];

		d.value = days;
		h.selectedIndex = hours;
		m.selectedIndex = mins;
		s.selectedIndex = secs;
	}
	else{
		d.value = 0;
	}

}
//<-- end Time Clock addition