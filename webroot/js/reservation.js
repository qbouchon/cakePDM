
let picker;
$( document ).ready(function() {


        //Fonction de création du picker avec les dates d'indisponibilité de la resource
        function createPicker(resourceId)
        {

                    $('#picker-container').append("<input class='invisible' id='picker' type='text' readonly='readonly'/>");

                    // requêtes Ajax pour la récupération des dates et de la durée de réservation maximale. ResourceController


                    var getDateUrl =  webrootUrl+"resources/"+resourceId+"/reservations/dates";



                    var getMaxDurationUrl =  webrootUrl+"resources/"+resourceId+"/max_duration";

                    $.get(getDateUrl, function(bookedDates) {
                             $.get(getMaxDurationUrl, function(maxDuration) {
                                    
                                    var maxDuration = parseInt(maxDuration);
                                    
                                    //Côté serveur max duration = 0 signifie qu'il n'y a pas de limite dans la durée de réservation
                                    if(maxDuration === 0)
                                    {
                                        displayPicker(datesBetween(bookedDates,false));
                                    }
                                    else{
                                        displayPicker(datesBetween(bookedDates), maxDuration);
                                    }

                            });                
                    });


        }





        function displayPicker(bookedDates, maxDuration)
        {
            var today = new Date();
            var tomorrowDate = new Date(today);
            tomorrowDate.setDate(today.getDate() + 1);
            var tomorrowString = tomorrowDate.toISOString().split('T')[0];

            picker = new HotelDatepicker(document.getElementById('picker'),document.getElementById('start_date'),document.getElementById('end_date'), {
                noCheckInDaysOfWeek: ['Samedi','Dimanche'],
                noCheckOutDaysOfWeek: ['Samedi','Dimanche'],
                disabledDates: bookedDates,
                inline: true,
                startOfWeek: 'monday',
                moveBothMonths : true,
                maxNights : maxDuration,
                startDate : tomorrowString,      

            });

        }


        //A déplacer côté serveur
        function datesBetween(dateRanges) {
             const datesArray = [];

             dateRanges.forEach((range) => {
                            const startDate = new Date(range[0]);
                            const endDate = new Date(range[1]);
                            
                            // Loop through each date between the start and end dates
                            let currentDate = new Date(startDate);
                            while (currentDate <= endDate) {
                              datesArray.push(currentDate.toISOString().slice(0, 10));
                              currentDate.setDate(currentDate.getDate() + 1);
                    }
            });

            return datesArray;
        }



    //Créer le picker au chargement de la page
    createPicker($("#resourceInput").val());

    //Recrée le picker quand on change de ressource
    $('#resourceInput').on('change', function(){
                   
        $('#picker').remove();
        picker.destroy();
        createPicker($(this).val());

    });

    // //Empêche le picker html5 de s'ouvrir
    // $('#start_date').on('click', function(e){
    //     e.preventDefault();
    // });

    //permet de clear la selection avec un clic droit sur le picker
    $('#picker-container').on('contextmenu', function(e){
        e.preventDefault();
        picker.clear();        
    });


    



});