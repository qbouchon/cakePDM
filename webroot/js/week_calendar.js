const today = new Date();
today.setHours(0,0,0,0);
var globalStartDate = getStartOfWeek(today);

$(document).ready(function() {
    createWeekReservationCalendar(globalStartDate);

    $('#previousWeek').on('click', function() {
        destroyReservationCalendar();
        const previousStartDate = new Date(globalStartDate);
        previousStartDate.setDate(globalStartDate.getDate() - 7);
        createWeekReservationCalendar(previousStartDate);
        globalStartDate = previousStartDate;
    });

    $('#nextWeek').on('click', function() {
        destroyWeekReservationCalendar();
        const nextStartDate = new Date(globalStartDate);
        nextStartDate.setDate(globalStartDate.getDate() + 7);
        createWeekReservationCalendar(nextStartDate);
        globalStartDate = nextStartDate;
    });
});

function createWeekReservationCalendar(startDate) {
    const days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];

    const headerRow = $('#headerRow');
    headerRow.empty();

    const resourceCell = $('<th>').addClass('text-center border resourceCell').text('Ressource');
    headerRow.append(resourceCell);

    for (let i = 0; i < 7; i++) {
        const currentDate = new Date(startDate);
        currentDate.setDate(startDate.getDate() + i);

        const dayName = days[i];
        const formattedDate = formatDate(currentDate);

        const headerCell = $('<th>')
            .addClass('text-center border calendarCell')
            .html(dayName + '<br/>' + formattedDate);

        headerRow.append(headerCell);
    }

    const endDate = new Date(startDate.getTime() + (6 * 24 * 60 * 60 * 1000));
    const startDateString = startDate.toISOString().slice(0, 10);
    const endDateString = endDate.toISOString().slice(0, 10);
    displayWeekReservations(startDateString, endDateString);
}

function displayWeekReservations(date1String, date2String) {
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

function destroyWeekReservationCalendar() {
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



