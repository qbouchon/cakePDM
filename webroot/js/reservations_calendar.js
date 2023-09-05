const today = new Date();
today.setHours(0,0,0,0);
var globalStartDate = getStartOfWeek(today);
var palette = ['#ffc107','#A80874 ','#DD4B1A','#D81159','#448FA3 ','#0197F6'];
var calendar;

$(document).ready(function() {


    
    createCalendar();

});

// ------------------------------- FullCalendar ---------------------------------------------

function createCalendar()
{

  
    var calendarEl = document.getElementById('fullCalendar');

    calendar = new FullCalendar.Calendar(calendarEl, {

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
                                      },
                             
                                     eventDidMount: function(info) {

                                        info.el.classList.add('cursor-pointer');

                                        if(info.event.extendedProps.isBack){

                                            var titleEl = info.el.querySelector('.fc-event-title');
                                            titleEl.classList.add('text-decoration-line-through');
                                        }

                                        tippy(info.el, {
                                        content: info.event.extendedProps.tooltip,
                                        duration: 0,
                                        allowHTML:true,
                                        followCursor: 'initial',
                                        trigger: 'click'

                                      });
                                   
                                     }
                                        

                                    });
                                    calendar.render();
                            var firstDisplayedDate = getStartOfWeek(new Date(calendar.getDate().getFullYear(),calendar.getDate().getMonth(),1));
                            var lastDisplayedDate = new Date(firstDisplayedDate);
                            lastDisplayedDate.setDate(lastDisplayedDate.getDate()+41);
                            createEvents(firstDisplayedDate,lastDisplayedDate);
   
}









function createEvents(startDate, endDate)
{
   

    var firstDateString = startDate.toISOString().slice(0, 10);
    var lastDateString = endDate.toISOString().slice(0, 10);

    var url =  webrootUrl + '/reservations/upcoming-reservations/month/' + firstDateString + '/' + lastDateString;

        $.get(url, function(reservations){

                var colorIndex = 0;

                for(reservation of reservations)
                {
                    // console.log('---------------'+reservation.resource.name+'------------------------');
                    // console.log("rsD "+reservation.start_date);
                    // console.log('reD '+reservation.end_date);
                    

                    var formattedStartDate = fecha.format(new Date(reservation.start_date),'DD/MM/YYYY');
                    var formattedEndDate = fecha.format(new Date (reservation.end_date),'DD/MM/YYYY');

                    //+1 jour fullcalendar affiche la reservation sur -1 jour
                    var endDate = new Date(reservation.end_date);
                    endDate.setDate(endDate.getDate() + 1);

                    if(reservation.is_back){
                        var eventColor = '#808080';
                    }
                    else{
                       var eventColor = palette[colorIndex];
                    }

                    calendar.addEvent({

                                        id: reservation.id,
                                        title: reservation.resource.name,
                                        start: reservation.start_date,
                                        end: endDate,
                                        allDay: true,
                                        overlap: false,
                                        color: eventColor,
                                        isBack: reservation.is_back,
                                        tooltip: '<div class="text-center"><b>Réservation</b></div>'+ reservation.resource.name+'<br> Du  <b>'+formattedStartDate+'</b> au <b>'+ formattedEndDate+'</b> par : <b>'+reservation.user.username+'</b>' 


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
