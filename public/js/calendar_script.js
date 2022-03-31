const ele0 = document.getElementById('previous-month');
const ele1 = document.getElementById('next-month');

const calendarPopUp = document.getElementById('calendar_popup');
const calendarContent = document.getElementById('calendar-content');
let calendarShow = false;

ele0.onclick = function() {
  ele0.style.display = "none";
}

ele1.onclick = function() {
  ele1.style.display = "none";
}

calendarPopUp.onclick = function() {
  if(calendarShow == false){
    calendarContent.style.display = "block";
    calendarShow = true;
  }
  else{
    calendarContent.style.display = "none";
    calendarShow = false;
  }
}