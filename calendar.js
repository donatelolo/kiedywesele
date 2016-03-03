// funckja onload dla wielu funkcji
 function addLoadEvent(func) {
  var oldonload = window.onload;
  if (typeof window.onload != 'function') {
    window.onload = func;
  } else {
    window.onload = function() {
      if (oldonload) {
        oldonload();
      }
      func();
    }
  }
}

var WeekDays = [ "Poniedziałek", "Wtorek", "Środa", "Czwartek", "Piątek", "Sobota", "Niedziela"];
	var months = ["styczeń", "luty", "marzec", "kwiecień", "maj", "czerwiec", "lipiec", "sierpień", "wrzesień", "październik", "listopad", "grudzień"]
	var cal_days_in_month = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];


 function Today() {
 	
	var NewCalendar = document.getElementById("Calendar");
	var d = new Date();
	
	var year= d.getFullYear();
	var monthtime = d.getMonth();
	var monthtime = months[monthtime];
	var DayOfWeek = d.getDay() -1;
  
	var DayOfWeek = WeekDays[DayOfWeek];

	var DayOfMonth = d.getDate();
	var StrDate = DayOfWeek + " "+ DayOfMonth + " " + monthtime + " " + year;
	NewCalendar.innerHTML = StrDate;


				}

function NewDay(){
	 var CurrentDay = document.getElementById("Tommorow");
    CurrentDay.innerHTML = html;
	
}
  var d = new Date();
    

document.addEventListener("click", NextButton);
function NextButton() {
    Next_butt = document.getElementById("prev");
    var d = new Date();
    var monthtime = d.getMonth();
    var monthtime = months[monthtime];
    var dupa= d.setMonth(d.getMonth() - 1);
   
   

    }


 var cal_current_date = new Date(); 

function Calendar(month, year) {
  this.month = (isNaN(month) || month == null) ? cal_current_date.getMonth() : month;
  this.year  = (isNaN(year) || year == null) ? cal_current_date.getFullYear() : year;
  this.html = '';
}
Calendar.prototype.generateHTML = function Elo(){

  // Pierwszy dzień miesiąca
  var firstDay = new Date(this.year, this.month, 0);

  var startingDay = firstDay.getDay();
  
  var uniqueId = (function() {
    var id = 0;
    return function() {
        return id++;
    };
})();
  // Liczba dni w miesiący
  var monthLength = cal_days_in_month[this.month];
  
  // Luty
  if (this.month == 1) { 
      if((this.year % 4 == 0 && this.year % 100 != 0) || this.year % 400 == 0){
      monthLength = 29;
    }
  }


  // do the header
  var monthName = months[this.month]
  var html = '<table class="calendar-table">';
  html += '<tr><th colspan="7">';
  html +=  monthName + "&nbsp;" + this.year;
  html += '</th></tr>';
  html += '<tr class="calendar-header">';
  for (var i=0; i <7; i++ ) {
    html += '<td class="calendar-header-day" >';
    html += WeekDays[i];

    html += '</td>';
  }
  html += '</tr><tr>';

  // fill in the days
  var day = 1;


// id="' + id + '"
  // this loop is for is weeks (rows)
  for (var i = 0; i < 9; i++) {

    // this loop is for weekdays (cells)
    for (var j = 0; j <= 6; j++) { 
          
      html += '<td class="calendar-day" >';
      //zmienna ID 

 //var html ='<li id="' + id + '">'
      if (day <= monthLength && (i > 0 || j >= startingDay)) {
        html += day;
        day++;
      }
      html += '</td>';
    }
    // stop making rows if we've run out of days
    if (day > monthLength) {
      break;
    } else {
      html += '</tr><tr>';
    }
  }
  html += '</tr></table>';

  this.html = html;

}

Calendar.prototype.getHTML = function() {
  return this.html;
}


addLoadEvent(Today);
addLoadEvent(NewDay);
addLoadEvent(function() {
  /* more code to run on page load */
});


