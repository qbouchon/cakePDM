
let picker;

$( document ).ready(function() {


        //Fonction de création du picker avec les dates d'indisponibilité de la resource
        function createPicker(resourceId)
        {

                    $('#picker-container').append("<input class='invisible' id='picker' type='text' readonly='readonly'/>");

                    // requêtes Ajax pour la récupération des dates et de la durée de réservation maximale. ResourceController


                    var getDateUrl =  webrootUrl+"resources/"+resourceId+"/reservations/dates";

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
            tomorrowDate.setDate(today.getDate()) // + 1); +1 si on veut qu'il y ai au moins un jour de délai entre la demande de réservation et le début de la réservation
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
                   
        $('#picker').remove();
        picker.destroy();
        $('#loadingAnimaion').removeClass('displaynone');
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


    //Validation des inputs
    $('#start_date').on('change', function(){

        resetValidationmessages();
        checkSelectedDates();
    });

    $('#end_date').on('change', function(){

        resetValidationmessages();
        checkSelectedDates();
    });
    



});


function resetValidationmessages() {
        $('#startDateFeedback').html('');
        $('#endDateFeedback').html('');
        $('#startDateFeedback').hide();
        $('#endDateFeedback').hide();

        $('#start-date-error').hide();
        $('#end-date-error').hide();

        $('#start_date').removeClass('is-invalid');
        $('#end_date').removeClass('is-invalid');
}



function checkSelectedDates() {

   



        if($('#start_date').val()){
             checkStartDate();
        }
        if($('#start_date').val() && $('#end_date').val())
        {
            checkDates();
            checkReservationDuration();
            checkOverlapeReservation();
            checkClosingDate();
        }



}

//Check if start_date after today
function checkStartDate()
{
        var today = new Date();

        var start_date = new Date($("#start_date").val());


        if(start_date<today){     
            
    
            $('#start_date').addClass('is-invalid');
            $("#startDateFeedback").html("Vous ne pouvez pas réserver une ressource avant la date de la demande");
           $("#startDateFeedback").show();   
        }
        
}


//Check if start_date before end_date
function checkDates()
{
        var start_date = new Date($("#start_date").val());
        var end_date = new Date($("#end_date").val());

        if(end_date < start_date){
         
            $('#start_date').addClass('is-invalid');
            $("#startDateFeedback").html("La date de début de réservation doit être avant la date de fin.");  
            $("#startDateFeedback").show();
        }
        
}

//Check if the duration of reservation is not greater than the maximum duration for the specific resource
function checkReservationDuration()
{
        var start_date = new Date($("#start_date").val());
        var end_date = new Date($("#end_date").val());
        var max_duration = picker.maxNights;

        var durationInDays = (end_date - start_date) / (24 * 60 * 60 * 1000);
        if(durationInDays >= max_duration && max_duration > 0){ //On considère 0 et les valeurs négatives comme une possibilité de réservation illimitée
            
            $('#end_date').addClass('is-invalid');
            $("#endDateFeedback").html("La Reservation dépasse la durée maximal d\'emprunt pour cette ressource");  
            $("#endDateFeedback").show();
        }
     
}

//Check if there is no overlape reservation for the resource
function checkOverlapeReservation()
{
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();     

                   
                if(picker.disabledDates.includes(start_date)){
                    

                    $('#start_date').addClass('is-invalid');
                    $("#startDateFeedback").html("La ressource n\'est pas disponible à ces date");  
                     $("#startDateFeedback").show();
                }
                if(picker.disabledDates.includes(end_date)){
                     
                    $('#end_date').addClass('is-invalid');
                    $("#endDateFeedback").html("La ressource n\'est pas disponible à ces date");  
                    $("#endDateFeedback").show();

                }

}


function checkClosingDate()
{
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();  
        
        if(picker.noCheckInDates.includes(start_date) || picker.noCheckOutDates.includes(start_date)){
                   
                    $('#start_date').addClass('is-invalid');
                    $("#startDateFeedback").html("Le CREST est fermé à ces date");   
                    $("#startDateFeedback").show();
        }
        if(picker.noCheckInDates.includes(end_date) || picker.noCheckOutDates.includes(end_date)){
                    
                    $('#end_date').addClass('is-invalid');
                    $("#endDateFeedback").html("Le CREST est fermé à cette date");
                    $("#endDateFeedback").show();
        }
        
}

  