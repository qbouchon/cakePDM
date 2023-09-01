var palette = ['#ffc107','#A80874 ','#DD4B1A','#D81159','#448FA3 ','#0197F6'];

$(document).ready(function() {

            $('#monthLink').on('click', function() {

                                    destroyWeekReservationCalendar();
                                    var calendarEl = document.getElementById('fullCalendar');
                                    var calendar = new FullCalendar.Calendar(calendarEl, {

                                      initialView: 'dayGridWeek',
                                      locale: 'fr',
                                      firstDay: 1,
                                      themeSystem: 'bootstrap5',    
                                      height: 'auto',
                                      aspectRatio:1,
                                      allDaySlot: true,
                                       buttonText: {
                                            today: 'Aujourd\'hui', // Customize 'today' button text
                                            month: 'Mois',        // Customize 'month' button text
                                            week: 'Semaine',      // Customize 'week' button text
                                            day: 'Jour'           // Customize 'day' button text
                                            // Add more button text translations as needed
                                        },
                                      headerToolbar: {
                                                    start: 'prev,today,next',
                                                    center: 'title',
                                                    end: 'dayGridMonth,dayGridWeek,dayGridDay'
                                      }
                                        

                                    });
                                    calendar.render();

                            var firstDisplayedDate = getStartOfWeek(new Date(calendar.getDate().getFullYear(),calendar.getDate().getMonth(),1));
                            var lastDisplayedDate = new Date(firstDisplayedDate);
                            lastDisplayedDate.setDate(lastDisplayedDate.getDate()+41);

                            console.log(firstDisplayedDate);
                            console.log(lastDisplayedDate);

                            var firstDisplayedDateString = firstDisplayedDate.toISOString().slice(0, 10);
                            var lastDisplayedDateString = lastDisplayedDate.toISOString().slice(0, 10);

                            var url =  webrootUrl + '/reservations/upcoming-reservations/month/' + firstDisplayedDateString + '/' + lastDisplayedDateString;

                                $.get(url, function(reservations){

                                        var colorIndex = 0;

                                        for(reservation of reservations)
                                        {
                                            console.log('------------------Reservation-----------------------------');
                                            console.log(reservation.id);
                                            console.log(reservation.resource.name);
                                            console.log(reservation.start_date);
                                            console.log(reservation.end_date);

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

        });


});



function getStartOfWeek(date) {
        const dayOfWeek = date.getDay();
        const daysSinceMonday = (dayOfWeek + 6) % 7;
        date.setDate(date.getDate() - daysSinceMonday);

        return date;

}





function createCalendar()
{
    
}


























// const todayMonth = new Date();
// todayMonth.setHours(0,0,0,0);
// var globalMonthStartDate = todayMonth;



// $(document).ready(function() {


//      $('#monthLink').on('click', function() {

//         destroyWeekReservationCalendar();
//         createMonthReservationCalendar(getStartOfWeek(getStartOfMonth(new Date(globalMonthStartDate))));
//     });

//           $('#previousMonth').on('click', function() {
//             destroyMonthReservationCalendar();

//             globalMonthStartDate.setDate(1); //On repars au premier du mois
//             globalMonthStartDate.setMonth(globalMonthStartDate.getMonth() - 1)//On retire un mois
//             console.log('globalMonthStartDate '+globalMonthStartDate);

//             createMonthReservationCalendar(getStartOfWeek(new Date(globalMonthStartDate)));


//         });

//         $('#nextMonth').on('click', function() {
//             destroyMonthReservationCalendar();

//             globalMonthStartDate.setDate(1); //On repars au premier du mois
//             globalMonthStartDate.setMonth(globalMonthStartDate.getMonth() + 1)//On ajoute un mois

//             console.log('globalMonthStartDate '+globalMonthStartDate);

//             createMonthReservationCalendar(getStartOfWeek(new Date (globalMonthStartDate)));
            
//         });
    
// });

// function createMonthReservationCalendar(startDate) {

//     const days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];

//     const headerRow = $('#headerRow');
//     const table = $('#calendar');
//     const tbody = $('tbody');

 


//     //Affiche du mois et de l'année
//     displayMonthYear(globalMonthStartDate);

//     //Header
//     for (let i = 0; i < 7; i++) {

//           const headerCell = $('<th>')
//           .addClass('text-center border calendarCell')
//           .html(days[i]);

//           headerRow.append(headerCell);
//     }

//     //Cells
//     var sDate = new Date(startDate);

//     for(let tabRowIndex = 0; tabRowIndex<6; tabRowIndex++){


//         const tabRow = $('<tr>').addClass('position-relative');
//         tbody.append(tabRow);



//         for (let tabColIndex = 0; tabColIndex < 7; tabColIndex++)
//         {
            
//             const tabCell = $('<td>').addClass('border calendarCell squareCell px-0 py-2 text-end').attr('id',sDate.getDate()+''+(sDate.getMonth()+1)).html(sDate.getDate()+'/'+(sDate.getMonth()+1));


//             // console.log('globalStart'+globalMonthStartDate);
//             // if(startDate.getMonth() != globalMonthStartDate.getMonth())
//             //     tabCell.addClass('bg-secondary opacity-50');

//             tabRow.append(tabCell);
//             sDate.setDate(sDate.getDate()+1);
//         }



//     }

//     const endDate = new Date(startDate.getTime() + (41 * 24 * 60 * 60 * 1000));
//     const startDateString = startDate.toISOString().slice(0, 10);
//     const endDateString = endDate.toISOString().slice(0, 10);

//     console.log("startDate : " + startDate);
//     displayMonthReservations(startDateString, endDateString, startDate);
// }


// function displayMonthReservations(date1String, date2String, startDate) {
//     const url = webrootUrl + '/reservations/upcoming-reservations/' + date1String + '/' + date2String;
//     //const startDate = getStartOfWeek(new Date (globalMonthStartDate));


//     $.get(url, function(reservationsTables) {
//         const table = $('#calendar');
//         const tbody = $('tbody');
        
  

//         //Creation de la table vierge
//         $.each(reservationsTables, function(resourceId, resourceData) {
//             const resource = resourceData.resource;
//             const reservations = resourceData.reservations;

//             //Création des badges
//                            $.each(reservations, function(_, reservation) {

//                             console.log('---------------------------------------------Reservation ---------------------------------------------');
//                             console.log('id: '+reservation.id);
//                             const reservationStartDate = new Date(reservation.start_date);
//                             const reservationEndDate = new Date(reservation.end_date);

//                             // const endDate = new Date(startDate.getTime() + (41 * 24 * 60 * 60 * 1000));
//                             // endDate.setHours(0,0,0,0);

//                             reservationStartDate.setHours(0,0,0,0);
//                             reservationEndDate.setHours(0,0,0,0);

//                             if(reservationStartDate.getTime() < startDate.getTime())
//                             {
                              
//                                 sIndex = '#'+startDate.getDate()+''+(startDate.getMonth()+1);
//                                  console.log("inff : "+sIndex);
//                             }
//                             else{
//                                 sIndex = '#'+reservationStartDate.getDate()+''+(reservationStartDate.getMonth()+1);
//                                  console.log("supp : "+reservationStartDate+'   dtart '+startDate);
//                             }

//                             console.log('sindex : ' + sIndex);

//                             //Calcul le nombre de jour de reservation
//                             const duration = (reservationEndDate.getTime() - reservationStartDate.getTime())/ (1000 * 60 * 60 * 24)+1;

//                             var nbLoop = Math.floor(duration/7)+1;
//                             if(nbLoop > 6)
//                                 nbLoop = 6;

//                             console.log(nbLoop);
//                             const nSDate = new Date(startDate);
//                             var d = 0;
//                             var dayclass = "";

//                             for(let row = 0; row < nbLoop; row++)
//                             {
//                                 var endDateRow = new Date(nSDate);
//                                 endDateRow.setDate(endDateRow.getDate()+6);

                               


//                                 if(row == 0){
//                                        console.log('sIndex'+sIndex);
//                                         if(reservationStartDate.getTime() < startDate.getTime())
//                                         {
//                                            d =  (reservationEndDate.getTime() - startDate.getTime())/ (1000 * 60 * 60 * 24)+1;
//                                            if(d > 6)
//                                                 dayclass = 'day-6';
//                                            else
//                                                 dayclass = 'day-'+d;
//                                         }
//                                         else{
//                                              d =  (reservationEndDate.getTime() - reservationStartDate.getTime())/ (1000 * 60 * 60 * 24)+1;
//                                            if(d > 6)
//                                                 dayclass = 'day-6';
//                                            else
//                                                 dayclass = 'day-'+d;
//                                         }

//                                         console.log(dayclass);
//                                         $(sIndex).html("<div id='"+reservation.id+"'class='"+dayclass+" bg-secondary opacity-50 position-absolute mx-1  text-center px-auto text-white'>Réservation</div>");

                                    
//                                 }
//                                 else
//                                 {
//                                     nSDate.setDate(nSDate.getDate()+row*7);
//                                     sIndex = '#'+nSDate.getDate()+''+(nSDate.getMonth()+1);
//                                     console.log('sIndex'+sIndex);


                                       
//                                             d =  (reservationEndDate.getTime() - nSDate.getTime())/ (1000 * 60 * 60 * 24)+1;
//                                            if(d > 6)
//                                                 dayclass = 'day-6';
//                                            else
//                                                 dayclass = 'day-'+d;

//                                     console.log(dayclass);    

//                                     $(sIndex).html("<div id='"+reservation.id+"'class='"+dayclass+" bg-secondary opacity-50 position-absolute mx-1  text-center px-auto text-white'>Réservation</div>");
//                                 }

//                             }



//                         });



//         });





//     });
// }

// function destroyMonthReservationCalendar() {
//     const headerRow = $('#headerRow');
//     const tbody = $('tbody');

//     headerRow.empty();
//     tbody.empty();
// }



// function getStartOfWeek(date) {
//         const dayOfWeek = date.getDay();
//         const daysSinceMonday = (dayOfWeek + 6) % 7;
//         date.setDate(date.getDate() - daysSinceMonday);

//         return date;
// }

// function formatDate(date) {
//         const day = date.toLocaleDateString('fr-FR', { day: '2-digit' });
//         const month = date.toLocaleDateString('fr-FR', { month: '2-digit' });
//         const year = date.getFullYear();
//         return `${day}/${month}/${year}`;
// }

// function getStartOfMonth(date) {

// return new Date(date.getFullYear(), date.getMonth(), 1);

// }

// function displayMonthYear(date)
// {
//        const months = ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Aout','Septembre','Octobre','Novembre','Décembre'];

//        $('#month').html(months[date.getMonth()]+' '+date.getFullYear());
// }


