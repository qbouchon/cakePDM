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


                                calendar.setOption('eventSources', [
                                    {
                                      url: webrootUrl + '/reservations/upcoming-reservations/reservations_between'
                                    },
                                ]);


        calendar.render();
     
   
}

