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
   

    const headerRow = document.getElementById('headerRow');
    const days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];

    // Clear existing header cells
    headerRow.innerHTML = '';

    // Add Resource cell
    const resourceCell = document.createElement('div');
    resourceCell.classList.add('col-5','text-center','border');
    resourceCell.textContent = 'Ressource';
    headerRow.appendChild(resourceCell);

    // Populate header cells with dates
    for (let i = 0; i < 7; i++) {
        const headerCell = document.createElement('div');
        headerCell.classList.add('col-1','text-center','border'); 
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
        const tbody = document.getElementById('tbody');

         const tableEvent = document.getElementById('events');

        for (const resourceId in reservationsTables) {

            if (reservationsTables.hasOwnProperty(resourceId)) {

                const resourceData = reservationsTables[resourceId];
                const resource = resourceData.resource; // Données de la ressource
                const reservations = resourceData.reservations; // Tableau de réservations

                // on créé la ligne du tableau
                var tbodyRow = document.createElement('div');
                tbodyRow.classList.add('row');
                tbody.appendChild(tbodyRow);

                // On crée la première case avec le nom de la resource
                const tbodyCellResource = document.createElement('div');
                tbodyCellResource.classList.add('col-5','text-end','border');
                tbodyCellResource.textContent = resource.name;
                tbodyRow.appendChild(tbodyCellResource);

                // Puis les cases suivantes avec la réservation
                var colWidth = 1;
                for (let i = 0; i < 7; i++) {

                var resaMatch = false;
                if(i == 0)
                {
                    var tbodyCell = document.createElement('div'); 
                    tbodyCell.classList.add('border');
                }
                    

                                                //Pour chaque reservation on va chercher si les dates match. L'idée est de mettre à jour la class de tbodycell pour lui afffecter la bonne largeur entre 1 et 7 (sorte de collspan) 
                                                //pour n'avoir qu'une colonne par réservation
                                                for (const reservation of reservations) {

                                                    
                                                    const reservationStartDate = new Date(reservation.start_date);
                                                    const reservationEndDate = new Date(reservation.end_date);

                                                    const date1 = new Date(date1String);
                                                    const currentDate = new Date(date1);
                                                    currentDate.setDate(date1.getDate() + i);


                                                    //Matching date
                                                    if (currentDate.getTime() >= reservationStartDate.getTime() && currentDate.getTime() <= reservationEndDate.getTime()) {
                                                       
                                                                   	if(currentDate.getTime() == reservationStartDate.getTime() && currentDate.getTime() == reservationEndDate.getTime()){
                                                                   		
                                                                        console.log('resa 1 jour '+reservation.start_date+' : RSD '+currentDate+' : currentDate '+colWidth+' : colWidth');
                                                                        resaMatch = true;
                                                                        //Reservation de 1 jour
                                                                        colWidth=1;
                                                                       
                                                                        tbodyCell.classList.add('col-1'); 
                                                                        tbodyCell.textContent += "resa 1 jour";
                                                                        tbodyRow.appendChild(tbodyCell);

                                                                        break;
                                                                    	
                                                                   	}
                                                                    else if(currentDate.getTime() == reservationStartDate.getTime()){
                                                                    	console.log('D resa '+reservation.start_date+' : RSD '+currentDate+' : currentDate '+colWidth+' : colWidth');
                                                                        resaMatch = true;
                                                                        tbodyCell.textContent += "début resa";
                                                                        //Début de réservation
                                                                        if(i != 0)
                                                                            var tbodyCell = document.createElement('div');
                                                                        
                                                                    	colWidth=1;

                                                                        //Dans le cas de la dernière case
                                                                        if(i == 6)
                                                                             tbodyRow.appendChild(tbodyCell);

                                                                        break;
                                                                        
                                                                    }
                                                                    else if(currentDate.getTime() == reservationEndDate.getTime()){
                                                                    	console.log('F resa '+reservation.start_date+' : RSD '+currentDate+' : currentDate '+colWidth+' : colWidth');
                                                                        resaMatch = true;
                                                                        tbodyCell.textContent += "Fin resa";
                                                                        //Fin de réservation
                                                                    	colWidth++;

                                                                        //On append la cellule quand on arrive sur une fin de resa
                                                                        tbodyCell.classList.add('col-'+colWidth);
                                                                        tbodyRow.appendChild(tbodyCell);
                                                                        colWidth=1;
                                                                        break;
                                                                    }
                                                                    else{
                                                                        console.log('M Resa '+reservation.start_date+' : RSD '+currentDate+' : currentDate '+colWidth+' : colWidth');
                                                                        resaMatch = true;
                                                                        tbodyCell.textContent += "milieu resa";
                                                                    	//Milieu de réservation
                                                                        colWidth++;
                                                                        //Dans le cas de la dernière case
                                                                        if(i == 6)
                                                                        {
                                                                             tbodyCell.classList.add('col-'+colWidth);
                                                                             tbodyRow.appendChild(tbodyCell);
                                                                        }

                                                                        break;

                                                                    }
                                                    }


                                                }


                    //Si aucune resa ce jour
                    if(!resaMatch)
                    {
                        tbodyCell.textContent = "libre";
                        colWidth=1; 
                        if(i!=0)
                            var tbodyCell = document.createElement('div');
                        tbodyCell.classList.add('col-1'); 
                        tbodyRow.appendChild(tbodyCell);
                    }
                       

                }
            }
        }
    });


}

function destroyReservationCalendar() {
	    const table = document.getElementById('calendar');
	    const headerRow = document.getElementById('headerRow');
	    const tbody = document.getElementById('tbody');

	    // Clear header cells
	    headerRow.innerHTML = '';

	    // Clear table body
	    tbody.innerHTML = '';
}



