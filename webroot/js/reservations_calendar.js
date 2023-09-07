var palette = ['#ffc107','#A80874 ','#DD4B1A','#D81159','#448FA3 ','#0197F6'];
var calendar;

$(document).ready(function() {

        createCalendar()

    

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
                                      stickyHeaderDates: true,
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
                                        info.el.setAttribute('data-bs-toggle','modal');
                                        info.el.setAttribute('data-bs-target','#modal'+info.event.id);

                                        if(info.event.extendedProps.isBack){

                                            var titleEl = info.el.querySelector('.fc-event-title');
                                            titleEl.classList.add('text-decoration-line-through');
                                        }

                                        tippy(info.el, {
                                        content: info.event.extendedProps.tooltip,
                                        duration: 0,
                                        allowHTML:true,
                                        followCursor: 'initial',
                                        // trigger: 'click'

                                        });
                                         
                                        createEventModal(info.event);
                                     }
                                        

                                    });


     calendar.setOption('eventSources', [
                          {
                              url: webrootUrl + '/reservations/upcoming-reservations/reservations_between'
                           },
     ]);


 





    restoreCalendarState(calendar);

    calendar.render();

    cleanCalendarState(calendar);


    $('.setBackFormButton').on('click',function(){

        saveCalendarStatAndSubmitForm();

    });
     
   
}

function createEventModal(event) {

    
    if(event.extendedProps.isBack){ 
        var setBackForm =   '<form id="setBackForm" action="'+webrootUrl+'/reservations/unSetBack/'+event.id+'" method="post">'
                       +                '<input type="hidden" name="_csrfToken" autocomplete="off" value="'+csrfToken+'">'
                       +           '<button  class="btn btn-secondary setBackFormButton" onclick="saveCalendarStatAndSubmitForm()" >Définir comme non rendue</button>'
                       +            '</form>';
    }
    else{
         var setBackForm =   '<form id="setBackForm" action="'+webrootUrl+'/reservations/setBack/'+event.id+'" method="post">'
                       +                '<input type="hidden" name="_csrfToken" autocomplete="off" value="'+csrfToken+'">'
                       +           '<button class="btn btn-secondary setBackFormButton" onclick="saveCalendarStatAndSubmitForm()">Définir comme rendue</button>'
                       +            '</form>';
    }

    var modal = '<div class="modal " id="modal'+event.id+'" tabindex="-1">'
            + ' <div class="modal-dialog modal-dialog-centered">'
            +   ' <div class="modal-content">'
            +     ' <div class="modal-header">'
            +       ' <h5 class="">'+event.extendedProps.tooltip+'</h5>'

            +       ' <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>'
            +     ' </div>'
            +     ' <div class="modal-body">'
            +      '  <p><img src="'+webrootUrl+'img/resources/'+ encodeURIComponent(event.extendedProps.picture)+'" class="img-fluid" ></img></p>'
            +     ' </div>'
            +     ' <div class="modal-footer">'
            +       '<a href="'+webrootUrl+'/reservations/edit-for-user/'+event.id+'" type="button" class="btn btn-secondary">Editer</a>'
            +        setBackForm
            // +       '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>'
            +      '</div>'
            +   '</div>'
            +  '</div>'
            +' </div>';

    $("#eventModals").append(modal);

    
}


function saveCalendarStatAndSubmitForm() {

        saveCalendarState(calendar);
        document.getElementById('setBackForm').submit();
    
}


function saveCalendarState(){



    const calendarState = {
        view: calendar.view.type,
        date: calendar.getDate(),
    };

        localStorage.setItem('calendarState', JSON.stringify(calendarState));

}

function restoreCalendarState(calendar) {

    const storedState = localStorage.getItem('calendarState');

    if (storedState) {
        const calendarState = JSON.parse(storedState);

        // Restore the calendar state
        calendar.changeView(calendarState.view, calendarState.date);
    }
}

function cleanCalendarState(calendar) {

    if(localStorage.getItem('calendarState'))
        localStorage.removeItem('calendarState');
}

