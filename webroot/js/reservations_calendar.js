const today = new Date();
today.setHours(0,0,0,0);
var globalStartDate = getStartOfWeek(today);
var palette = ['#ffc107','#A80874 ','#DD4B1A','#D81159','#448FA3 ','#0197F6'];


$(document).ready(function() {


    
    createCalendar();

});

// ------------------------------- FullCalendar ---------------------------------------------

function createCalendar()
{

  
    var calendarEl = document.getElementById('fullCalendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {

                                      initialView: 'dayGridWeek',
                                      locale: 'fr',
                                      firstDay: 1,
                                      themeSystem: 'standard',    
                                      height: 'auto',
                                      aspectRatio:1,
                                      allDaySlot: true,
                                      buttonText: {

                                            today: 'Aujourd\'hui', 
                                            month: 'Mois',        
                                            week: 'Semaine',      
                                            day: 'Jour'  

                                        },

                                      headerToolbar: {

                                                    start: 'dayGridMonth,dayGridWeek,dayGridDay',
                                                    center: 'title',
                                                    end: 'prev,next,today'
                                      }
                                        

                                    });
                                    calendar.render();

    var firstDisplayedDate = getStartOfWeek(new Date(calendar.getDate().getFullYear(),calendar.getDate().getMonth(),1));
    var lastDisplayedDate = new Date(firstDisplayedDate);
    lastDisplayedDate.setDate(lastDisplayedDate.getDate()+41);

    var firstDisplayedDateString = firstDisplayedDate.toISOString().slice(0, 10);
    var lastDisplayedDateString = lastDisplayedDate.toISOString().slice(0, 10);

    var url =  webrootUrl + '/reservations/upcoming-reservations/month/' + firstDisplayedDateString + '/' + lastDisplayedDateString;

        $.get(url, function(reservations){

                var colorIndex = 0;

                for(reservation of reservations)
                {
                                          
                    calendar.addEvent({

                                        id: reservation.id,
                                        title: reservation.resource.name,
                                        start: reservation.start_date,
                                        end: reservation.end_date,
                                        allDay: true,
                                        overlap: false,
                                        color: palette[colorIndex]


                    })
                                            
                    
                    colorIndex++;

                    if(colorIndex == palette.length)
                        colorIndex = 0;

                                                
                }

        });
}

function getStartOfWeek(date) {
        const dayOfWeek = date.getDay();
        const daysSinceMonday = (dayOfWeek + 6) % 7;
        date.setDate(date.getDate() - daysSinceMonday);
        return date;
}
