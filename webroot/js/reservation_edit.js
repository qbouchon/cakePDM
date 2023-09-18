
let picker;
$( document ).ready(function() {


        //Fonction de création du picker avec les dates d'indisponibilité de la resource
        function createPicker(resourceId)
        {

                    $('#picker-container').append("<input class='invisible' id='picker' type='text' readonly='readonly'/>");

                    // requêtes Ajax pour la récupération des dates et de la durée de réservation maximale. ResourceController

                   
                    var getDateUrl =  webrootUrl+"resources/"+resourceId+"/reservations/dates/"+reservationId;                    

                    var getMaxDurationUrl =  webrootUrl+"resources/"+resourceId+"/max_duration";

                    var getClosingDateUrl = webrootUrl+"closing-dates/dates/"

                    $.get(getDateUrl, function(bookedDates) {
                             $.get(getMaxDurationUrl, function(maxDuration) {
                                    $.get(getClosingDateUrl, function(closingDates) {

                                                    var maxDurationInt = parseInt(maxDuration);
                                                    
                                                    //Côté serveur max duration = 0 signifie qu'il n'y a pas de limite dans la durée de réservation
                                                    if(maxDurationInt <= 0)
                                                    {
                                                        $('#maxDurationInfo').html("");
                                                        displayPicker(datesBetween(bookedDates), closingDates, false,);
                                                    }
                                                    else{
                                                        $('#maxDurationInfo').html("La durée maximale de réservation pour cette ressource est de " + maxDurationInt + " jour(s).");
                                                        displayPicker(datesBetween(bookedDates), closingDates, maxDurationInt);
                                                    }

                                    }); 
                            });                
                    });


        }





        function displayPicker(bookedDates, closingDates, maxDuration)
        {
            var today = new Date();
            var tomorrowDate = new Date(today);
            tomorrowDate.setDate(today.getDate() + 1);
            var tomorrowString = tomorrowDate.toISOString().split('T')[0];

            picker = new HotelDatepicker(document.getElementById('picker'),document.getElementById('start_date'),document.getElementById('end_date'), {
                noCheckInDaysOfWeek: ['Samedi','Dimanche'],
                noCheckOutDaysOfWeek: ['Samedi','Dimanche'],
                noCheckInDates: closingDates,
                noCheckOutDates: closingDates,
                disabledDates: bookedDates,
                inline: true,
                startOfWeek: 'monday',
                moveBothMonths : true,
                maxNights : maxDuration,
                startDate : tomorrowString,

            });

            picker.setRange($('#start_date').val(),$('#end_date').val());

             $('#loadingAnimaion').addClass('displaynone');

            //Création des tooltips
            tippy('.datepicker__month-day--no-checkin', {
                                        content: 'Le CREST est fermé à cette date.',
                                        duration: 0,
                                        allowHTML:true,
                                      
                                        

            });

            tippy('.datepicker__month-day--disabled', {
                                        content: 'La ressource est indisponible à cette date',
                                        duration: 0,
                                        allowHTML:true,
                                      
                                        

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
             
        var sDateValue = $('#start_date').val();    
        var eDateValue = $('#end_date').val(); 
        $('#picker').remove();
        picker.destroy();
        $('#loadingAnimaion').removeClass('displaynone');
        $('#start_date').val(sDateValue);
        $('#end_date').val(eDateValue);  //On remet les valeurs car picker.destroy() les reset
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