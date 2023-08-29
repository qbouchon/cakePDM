//Pour upcoming_reservation gère un calendrier de réservations. à refactorer
const today = new Date();
var globalStartDate = getStartOfWeek(new Date(today));

$( document ).ready(function() {


	createReservationCalendar(globalStartDate);

	document.getElementById('previousWeek').addEventListener('click', function() {
        destroyReservationCalendar();
        const previousStartDate = new Date(globalStartDate);
        previousStartDate.setDate(globalStartDate.getDate() - 7);        
        createReservationCalendar(previousStartDate);
        globalStartDate = previousStartDate;
        
    });

    document.getElementById('nextWeek').addEventListener('click', function() {
         destroyReservationCalendar();
        const nextStartDate = new Date(globalStartDate);
        nextStartDate.setDate(globalStartDate.getDate() + 7);        
        createReservationCalendar(nextStartDate);
        globalStartDate = nextStartDate;
        
    });

});



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

function createReservationCalendar(startDate) {

    const table = document.getElementById('calendar');
    const headerRow = table.querySelector('thead tr');
    const days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];

    // Clear existing header cells
    headerRow.innerHTML = '';

    // Add Resource cell
    const resourceCell = document.createElement('th');
    resourceCell.textContent = 'Ressource';
    resourceCell.classList.add('text-center'); 
    headerRow.appendChild(resourceCell);

    // Populate header cells with dates
    for (let i = 0; i < 7; i++) {
        const headerCell = document.createElement('th');
        headerCell.classList.add('text-center'); 
        const currentDate = new Date(startDate);
        currentDate.setDate(startDate.getDate() + i);

        const dayName = days[i];
        //const dateText = currentDate.toLocaleDateString('fr-FR', { day: 'numeric', month: 'short' });
        const formattedDate = formatDate(currentDate);

        headerCell.innerHTML  = dayName + ' <br/> ' + formattedDate;
        headerRow.appendChild(headerCell);
    }
    	const endDate = new Date(startDate.getTime() + (6 * 24 * 60 * 60 * 1000));
    	const startDateString = startDate.toISOString().slice(0, 10); // Format: "yyyy-mm-dd"
		const endDateString = endDate.toISOString().slice(0, 10);
		// console.log(startDate);
		// console.log(endDate);
		// console.log(startDateString);
		// console.log(endDateString);
        displayReservations(startDateString,endDateString);
 }


 function displayReservations(date1String, date2String) {
    var url = webrootUrl + "/reservations/upcoming-reservations/" + date1String + "/" + date2String;

    $.get(url, function (reservationsTables) {
        console.log(reservationsTables);
        const table = document.getElementById('calendar');
        const tbody = table.querySelector('tbody');

        for (const resourceId in reservationsTables) {

            if (reservationsTables.hasOwnProperty(resourceId)) {

                const resourceData = reservationsTables[resourceId];
                const resource = resourceData.resource; // Données de la ressource
                const reservations = resourceData.reservations; // Tableau de réservations

                // on créé la ligne du tableau
                var tbodyRow = document.createElement('tr');
                tbody.appendChild(tbodyRow);

                // On crée la première case avec le nom de la resource
                const tbodyCellResource = document.createElement('td');
                tbodyCellResource.textContent = resource.name;
                tbodyRow.appendChild(tbodyCellResource);

                // Puis les cases suivantes avec la réservation
                for (let i = 0; i < 7; i++) {

                    var tbodyCell = document.createElement('td');

                    // Iterate through reservations to find matching date
                    for (const reservation of reservations) {

                        const reservationStartDate = new Date(reservation.start_date);
                        const reservationEndDate = new Date(reservation.end_date);

                        const date1 = new Date(date1String);
                        const currentDate = new Date(date1);
                        currentDate.setDate(date1.getDate() + i);

                        if (currentDate.getTime() >= reservationStartDate.getTime() && currentDate.getTime() <= reservationEndDate.getTime()) {
                           
                           	if(currentDate.getTime() == reservationStartDate.getTime() && currentDate.getTime() == reservationEndDate.getTime()){
                           		//Reservation de 1 jour
                            	tbodyCell.textContent = 'Début et fin';
                           	}
                            else if(currentDate.getTime() == reservationStartDate.getTime()){
                            	//Début de réservation
                            	tbodyCell.textContent = 'Début';
                            }
                            else if(currentDate.getTime() == reservationEndDate.getTime()){
                            	//Fin de réservation
                            	tbodyCell.textContent = 'fin';
                            }
                            else{
                            	//Milieu de réservation
                            	tbodyCell.textContent = 'En cours';
                            }
                        }
                    }

                    tbodyRow.appendChild(tbodyCell);
                }
            }
        }
    });


}

function destroyReservationCalendar() {
	    const table = document.getElementById('calendar');
	    const headerRow = table.querySelector('thead tr');
	    const tbody = table.querySelector('tbody');

	    // Clear header cells
	    headerRow.innerHTML = '';

	    // Clear table body
	    tbody.innerHTML = '';
}



