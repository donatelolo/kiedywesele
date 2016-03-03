$(document).ready(function()
{
$.datepicker.setDefaults();

 $('#datepicker').datepicker({
     prevText: "Poprzedni", // Display text for previous month link
		nextText: "Następny", // Display text for next month link
		currentText: "Dzis", // Display text for current month link
		monthNames: ["Styczeń","Luty","Marzec","Kwiecień","Maj","Czerwiec",
			"Lipiec","Sierpień","Wrzesień","Październik","Listopad","Grudzień"], // Names of months for drop-down and formatting
		monthNamesShort: ["Sty", "Lut", "Mar", "Kwi", "Maj", "Cze", "Lip", "Sie", "Wrz", "Paź", "Lis", "Gru"], // For formatting
		dayNames: ["Niedziela", "Poniedziałek", "Wtorek", "Środa", "Czwartek", "Piątek", "Sobota"], // For formatting
		dayNamesShort: ["Nie", "Pon", "Wto", "Śro", "Czw", "Pią", "Sob"], // For formatting
		dayNamesMin: ["Nie","Pon","Wt","Śr","Czw","Pt","Sob"], // Column headings for days starting at Sunday
		weekHeader: "Wk", // Column header for week of the year
		dateFormat: "mm/dd/yy", // See format options on parseDate
 });

$('#log').validate({ // initialize the plugin
        rules: {
            login: {
                required: true,
                email: true
            },
            haslo: {
                required: true,
                minlength: 5
            }
        }
    });

});