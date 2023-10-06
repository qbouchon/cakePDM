var palette = ['#ffc107','#A80874 ','#DD4B1A','#D81159','#448FA3 ','#0197F6'];
var calendar;
var today = new Date();

$(document).ready(function() {

    // Gestion des vues 
    if(!localStorage.getItem('viewAdmin') || localStorage.getItem('viewAdmin') == 'list')
    {

        $('#calendarView').addClass('displaynone');
        $('#listView').removeClass('displaynone');

    }
    else if (localStorage.getItem('viewAdmin') == 'calendar')
    {
      
        $('#calendarView').removeClass('displaynone');
        $('#listView').addClass('displaynone');

        createCalendar();
    }
   
    $('#toggleCalendar').click(function(){

        $('#calendarView').removeClass('displaynone');
        $('#listView').addClass('displaynone');
        createCalendar();
        localStorage.setItem('viewAdmin','calendar');

    });

     $('#toggleList').click(function(){

        $('#calendarView').addClass('displaynone');
        $('#listView').removeClass('displaynone');
        calendar.destroy();
        localStorage.setItem('viewAdmin','list');
        
    });


});

// ------------------------------- FullCalendar ---------------------------------------------

function createCalendar()
{

  
    var calendarEl = document.getElementById('fullCalendar');

    calendar = new FullCalendar.Calendar(calendarEl, {

                                      initialView: 'dayGridMonth',
                                      locale: 'fr',
                                      firstDay: 1,
                                      themeSystem: 'standard',    
                                      height: 'auto',
                                      expandRows : true,
                                      stickyHeaderDates: true,
                                      aspectRatio:1.5,
                                      allDaySlot: true,
                                      weekends: false,
                                      weekNumbers: true,
                                      weekText: '',
                                      dayMaxEvents: true,

                                      dayHeaderFormat: 
                                                     { weekday: 'long'},
                                      buttonText: {

                                            today: 'Aujourd\'hui', 
                                            month: 'Mois',        
                                            week: 'Semaine',      
                                            day: 'Jour'  

                                        },
                                        

                                      headerToolbar: {

                                                    end: 'dayGridMonth,dayGridWeek,dayGridDay',
                                                    center: 'title',
                                                    start: 'prev,next,today'
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
                                        
                                        if(info.event.extendedProps.type != 'backgroundEvent') 
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
     
   
}

function createEventModal(event) {

    
    if(event.extendedProps.isBack){ 
        var setBackForm =   '<form id="setBackForm'+event.id+'" action="'+webrootUrl+'reservations/unSetBack/'+event.id+'" method="post">'
                       +                '<input type="hidden" name="_csrfToken" autocomplete="off" value="'+csrfToken+'">'
                       +           '<button  class="btn btn-secondary setBackFormButton" onclick="saveCalendarStatAndSubmitForm()" >Définir comme non rendue</button>'
                       +            '</form>';
    }
    else{
         var setBackForm =   '<form id="setBackForm'+event.id+'" action="'+webrootUrl+'reservations/setBack/'+event.id+'" method="post">'
                       +                '<input type="hidden" name="_csrfToken" autocomplete="off" value="'+csrfToken+'">'
                       +           '<button class="btn btn-secondary setBackFormButton" onclick="saveCalendarStateAndSubmitForm('+event.id+')">Définir comme rendue</button>'
                       +            '</form>';
    }


    var deleteForm = '<form id="deleteForm'+event.id+'" action="'+webrootUrl+'reservations/delete/'+event.id+'" method="post">'
                       +                '<input type="hidden" name="_csrfToken" autocomplete="off" value="'+csrfToken+'">'                   
                       +            '</form>'
                       +           '<button  class="btn btn-danger deleteFormButton" onClick="saveCalendarStateAndSubmitDeleteForm('+event.id+')">Supprimer</button>';

    var startDate = new Date(event.start);
    if(startDate > today)
        var editButton = '<a href="'+webrootUrl+'/reservations/edit-for-user/'+event.id+'" type="button" class="btn btn-secondary">Editer</a>';
    else
        var editButton = '';




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
            +           editButton
            +           setBackForm
            +           deleteForm
            // +       '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>'
            +      '</div>'
            +   '</div>'
            +  '</div>'
            +' </div>';

    $("#eventModals").append(modal);

    
}


function saveCalendarStateAndSubmitForm(id) {

    saveCalendarState(calendar);
    document.getElementById('setBackForm'+id).submit();
    
}

function saveCalendarStateAndSubmitDeleteForm(id) {

    var confirmation = confirm("Voulez-vous vairment supprimer cette réservation ?");
    
    if(confirmation)
    {
         saveCalendarState(calendar);
         document.getElementById('deleteForm'+id).submit();
    }
            
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

