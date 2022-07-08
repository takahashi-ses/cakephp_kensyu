function showDate() {
  let dateObj   = new Date();
  let dateYear  = dateObj.getFullYear();
	let dateMonth = dateObj.getMonth() + 1;
	let dateDay   = dateObj.getDate();
  let dateWeek  = dateObj.getDay();
  let weekNames = ['日', '月', '火', '水', '木', '金', '土'];
  let str = '';
  str  = dateYear + '年' + dateMonth + '月' + dateDay + '日' + '（' + weekNames[dateWeek] + '） ';
  document.getElementById("date").innerHTML = str;
}
function twoDigit(num) {
  let ret;
  if( num < 10 )
    ret = "0" + num;
  else
    ret = num;
  return ret;
}
function showClock() {
  let nowTime = new Date();
  let nowHour = twoDigit( nowTime.getHours() );
  let nowMin  = twoDigit( nowTime.getMinutes() );
  let nowSec  = twoDigit( nowTime.getSeconds() );
  let msg = nowHour + ":" + nowMin + ":" + nowSec;
  document.getElementById("realtime").innerHTML = msg;
}
setInterval('showDate()',1000);
setInterval('showClock()',1000);
