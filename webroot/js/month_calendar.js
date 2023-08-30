const todayMonth = new Date();
todayMonth.setHours(0,0,0,0);
var globalMonthStartDate = getStartOfWeek(getStartOfMonth(todayMonth));

$(document).ready(function() {

     $('#monthLink').on('click', function() {

        destroyWeekReservationCalendar();
        createMonthReservationCalendar(globalMonthStartDate);
    });
    
});

function createMonthReservationCalendar(startDate) {

    const days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];

    const headerRow = $('#headerRow');
    const table = $('#calendar');
    const tbody = $('tbody');
    
    console.log(startDate);

    //Header
    for (let i = 0; i < 7; i++) {

          const headerCell = $('<th>')
          .addClass('text-center border calendarCell')
          .html(days[i]);

          headerRow.append(headerCell);
    }

    //Cells
    for(let tabRowIndex = 0; tabRowIndex<6; tabRowIndex++){


        const tabRow = $('<tr>').addClass('position-relative');
        tbody.append(tabRow);


        for (let tabColIndex = 0; tabColIndex < 7; tabColIndex++)
        {
            
            const tabCell = $('<td>').addClass('border calendarCell px-0 py-2').attr('id',tabRowIndex+''+tabColIndex).html(startDate);
            tabRow.append(tabCell);
            startDate.setDate(startDate.getDate()+1);
        }



    }







    const endDate = new Date(startDate.getTime() + (6 * 24 * 60 * 60 * 1000));
    const startDateString = startDate.toISOString().slice(0, 10);
    const endDateString = endDate.toISOString().slice(0, 10);
    //displayMonthReservations(startDateString, endDateString);
}


function displayMonthReservations(date1String, date2String) {
    const url = webrootUrl + '/reservations/upcoming-reservations/' + date1String + '/' + date2String;

    $.get(url, function(reservationsTables) {
        const table = $('#calendar');
        const tbody = $('tbody');


        //Creation de la table vierge
        $.each(reservationsTables, function(resourceId, resourceData) {
            const resource = resourceData.resource;
            const reservations = resourceData.reservations;

            const tbodyRow = $('<tr>').addClass('position-relative');
            tbody.append(tbodyRow);

            const tbodyCellResource = $('<td>')
                .addClass('resourceCell text-end border')
                .text(resource.name);
            tbodyRow.append(tbodyCellResource);

            //Creation des cases vierges
            for (let i = 0; i < 7; i++) {

                const tbodyCell = $('<td>').addClass('border calendarCell px-0 py-2').attr('id',resourceId+i);
                tbodyRow.append(tbodyCell);
            }

            //Création des badges
             $.each(reservations, function(_, reservation) {
                    const reservationStartDate = new Date(reservation.start_date);
                    const reservationEndDate = new Date(reservation.end_date);
                    reservationStartDate.setHours(0,0,0,0);
                    reservationEndDate.setHours(0,0,0,0);
                    const duration = (reservationEndDate.getTime() - reservationStartDate.getTime())/ (1000 * 60 * 60 * 24)+1;

                    console.log('reservationStartDate : '+reservationStartDate);
                    console.log('reservationEndDate : '+reservationEndDate);
                    console.log('globalStartDate : '+globalStartDate);

                    var startIndex = Math.floor((reservationStartDate.getTime() - globalStartDate.getTime()) / (1000 * 60 * 60 * 24));
                    console.log("start index before update : " +startIndex );
                    if(startIndex < 0)
                        startIndex = 0;

                    var endIndex = Math.floor((reservationEndDate.getTime() - globalStartDate.getTime()) / (1000 * 60 * 60 * 24));
                    console.log("end index before update : " +endIndex );
                    if(endIndex > 6)
                        endIndex = 6;

                    var dayclass = 'day-'+(endIndex - startIndex);
                    var idCell = '#'+resourceId+startIndex;


                    console.log('startIndex : ' +startIndex)
                    console.log('endIndex : ' +endIndex)
                    console.log('dayclass : ' +dayclass);
                    console.log('idCell : ' +idCell);


                    $(idCell).html("<div id='"+reservation.id+"'class='"+dayclass+" bg-secondary position-absolute mx-1  text-center px-auto text-white'>Réservation</div>");

                    if(globalStartDate.getTime() <= reservationStartDate.getTime()){
                        $('#'+reservation.id).removeClass('bg-info');              
                        $('#'+reservation.id).addClass('rounded-start border-start bg-warning');
                    }

                    if((globalStartDate.getTime() + (6 * 24 * 60 * 60 * 1000)) > reservationEndDate.getTime()){
                      
                        $('#'+reservation.id).addClass('rounded-end border-end');
                    }


                });


        });





    });
}

function destroyMonthReservationCalendar() {
    const headerRow = $('#headerRow');
    const tbody = $('tbody');

    headerRow.empty();
    tbody.empty();
}



function getStartOfWeek(date) {
        const dayOfWeek = date.getDay();
        const daysSinceMonday = (dayOfWeek + 6) % 7;
        date.setDate(date.getDate() - daysSinceMonday);
        return date;
}

function formatDate(date) {
        const day = date.toLocaleDateString('fr-FR', { day: '2-digit' });
        const month = date.toLocaleDateString('fr-FR', { month: '2-digit' });
        const year = date.getFullYear();
        return `${day}/${month}/${year}`;
}

function getStartOfMonth(date) {

// Réglez le jour de la date d'aujourd'hui sur le 1er jour du mois
return new Date(date.getFullYear(), today.getMonth(), 1);

}



