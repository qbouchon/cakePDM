
let picker;

$( document ).ready(function() {

    //Fonction de création du picker avec les dates d'indisponibilité de la resource
    function createPicker(resourceId)
    {

                $('#picker-container').append("<input class='invisible' id='picker' type='text' readonly='readonly'/>");

                // requêtes Ajax pour la récupération des dates et de la durée de réservation maximale. ResourceController

                var getDateUrl =  webrootUrl+"resources/"+resourceId+"/reservations/dates";

                var getMaxDurationUrl =  webrootUrl+"resources/"+resourceId+"/max_duration";

                var getClosingDateUrl = webrootUrl+"closing-dates/dates/";

                var getClosingDaysUrl = webrootUrl+"configuration/closing-days"

                $.get(getDateUrl, function(bookedDates) {
                         $.get(getMaxDurationUrl, function(maxDuration) {
                                $.get(getClosingDateUrl, function(closingDates) {
                                     $.get(getClosingDaysUrl, function(closingDays) {

                                            var maxDurationInt = parseInt(maxDuration);
                                            
                                            
                                            //Côté serveur max duration = 0 signifie qu'il n'y a pas de limite dans la durée de réservation
                                            if(maxDurationInt <= 0)
                                            {
                                                $('#maxDurationInfo').html("");
                                                displayPicker(bookedDates, closingDates, false, closingDays);
                                            }
                                            else
                                            {
                                                $('#maxDurationInfo').html("La durée maximale de réservation pour cette ressource est de " + maxDurationInt + " jour(s).");
                                                displayPicker(bookedDates, closingDates, maxDurationInt, closingDays);
                                            }

                                     });
                                }); 
                        });                
                });


    }


    function displayPicker(bookedDates, closingDates, maxDuration, closingDays)
    {
        var today = new Date();
        var tomorrowDate = new Date(today);
        tomorrowDate.setDate(today.getDate()) // + 1); +1 si on veut qu'il y ai au moins un jour de délai entre la demande de réservation et le début de la réservation
        var tomorrowString = tomorrowDate.toISOString().split('T')[0];

        picker = new HotelDatepicker(document.getElementById('picker'),document.getElementById('start_date'),document.getElementById('end_date'), {
            noCheckInDaysOfWeek: closingDays,
            noCheckOutDaysOfWeek: closingDays,
            noCheckInDates: closingDates,
            noCheckOutDates: closingDates,
            disabledDates: bookedDates,
            inline: true,
            startOfWeek: 'monday',
            moveBothMonths : true,
            maxNights : maxDuration,
            startDate : tomorrowString,
            onDayClick: function() {
                    resetValidationmessages(); //Pas besoin de check les dates
            },
            onSelectRange: function() {
                    resetValidationmessages(); //Pas besoin de check les dates
            },


        });

        $('#loadingAnimation').addClass('displaynone');

        //Création des tooltips
        createDisabledDayTooltips();
      
    }

    function createOpeningDaysToolTip(){

        var getOpeningDaysUrl = webrootUrl+"configuration/opening-days";

        $.get(getOpeningDaysUrl, function(openingDays){

                var openingDaysContent = '<div class="text-center"><b>Horaires</b></div>';

                for (const day in openingDays) {
                         openingDaysContent+='<div>'+day+' : '+openingDays[day][0]+'-'+openingDays[day][1]+'</div>'            }
                
                tippy('.openingDaysButton', {
                                    content: openingDaysContent,
                                    duration: 0,
                                    allowHTML:true,
                                    trigger: 'click',
                                                                      
                });
        });
    }

    function createDisabledDayTooltips()
    {
        
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





    //Créer le toolTip avec les horaires d'ouverture
    createOpeningDaysToolTip();

    //Créer le picker au chargement de la page
    createPicker($("#resourceInput").val());

    //Recrée le picker quand on change de ressource
    $('#resourceInput').on('change', function(){
                   
        $('#picker').remove();
        picker.destroy();
        resetValidationmessages();
        $('#loadingAnimation').removeClass('displaynone');
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
     
    //Tooltips needs to be create for new dates on month change. the event is throw in ugaDatePicker
    $( document ).on('OnMonthChange', function(){
      
        createDisabledDayTooltips()
    })


});

 // ------------------------------------------------------------------------- Validators pour les dates entrées à la main -------------------------------------------------------------------



function formatDate(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0'); // Month is zero-based
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
}



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
   
        if($('#start_date').val())
        {
             checkStartDate();
             checkStartClosingDays();
        }
        if($('#end_date').val())
        {
            checkEndClosingDays()
        }
        if($('#start_date').val() && $('#end_date').val())
        {
            checkDates();
            checkReservationDuration();
            checkOverlapeReservation();
            checkClosingDates();
          
        }

}

//Check if start_date after today
function checkStartDate()
{
        var today = new Date();

        var start_date = new Date($("#start_date").val());

        if(start_date<today)
        {                 
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

        if(end_date < start_date)
        {        
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

        if(durationInDays >= max_duration && max_duration > 0) //On considère 0 et les valeurs négatives comme une possibilité de réservation illimitée
        {             
            $('#end_date').addClass('is-invalid');
            $("#endDateFeedback").html("La Reservation dépasse la durée maximal d\'emprunt pour cette ressource");  
            $("#endDateFeedback").show();
        }
     
}

//Check if there is no overlape reservation for the resource
function checkOverlapeReservation()
{
        var start_date = new Date($("#start_date").val());
        var end_date = new Date($("#end_date").val());     

        it_date = new Date(start_date);

        while(it_date < end_date)
        {   

            if(picker.disabledDates.includes(formatDate(it_date)))
            {   
                
                $('#start_date').addClass('is-invalid');
                $('#end_date').addClass('is-invalid');
                $("#startDateFeedback").html("Il y a déjà une réservation entre ces dates");  
                $("#startDateFeedback").show();
                $("#endDateFeedback").html("Il y a déjà une réservation entre ces dates");  
                $("#endDateFeedback").show();
                break;
            }

            it_date.setDate(it_date.getDate() + 1); 
           
        }

}


function checkClosingDates()
{
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();  


        if(picker.noCheckInDates.includes(start_date) || picker.noCheckOutDates.includes(start_date) )
        {                   
            $('#start_date').addClass('is-invalid');
            $("#startDateFeedback").html("Le CREST est fermé à ces date");   
            $("#startDateFeedback").show();
        }
        if(picker.noCheckInDates.includes(end_date) || picker.noCheckOutDates.includes(end_date) )
        {                    
            $('#end_date').addClass('is-invalid');
            $("#endDateFeedback").html("Le CREST est fermé à cette date");
            $("#endDateFeedback").show();
        }
        
}


function checkStartClosingDays()
{
        var start_date = new Date($("#start_date").val());
        
        if(picker.noCheckInDaysOfWeek.includes(getDayName(start_date.getDay())) || picker.noCheckOutDaysOfWeek.includes(getDayName(start_date.getDay())))
        {                   
            $('#start_date').addClass('is-invalid');
            $("#startDateFeedback").html("Hors des jours d'ouverture du CREST");   
            $("#startDateFeedback").show();
        }
     

}

function checkEndClosingDays()
{
        var end_date = new Date($("#end_date").val());

        if(picker.noCheckInDaysOfWeek.includes(getDayName(end_date.getDay())) || picker.noCheckOutDaysOfWeek.includes(getDayName(end_date.getDay())))
        {                    
            $('#end_date').addClass('is-invalid');
            $("#endDateFeedback").html("Hors des jours d'ouverture du CREST");
            $("#endDateFeedback").show();
        }
}

//Comme le datepicker prend les disbledDayOfWeek sous forme de chaine de character on doit bricoller un peu.
function getDayNumber(dayName)
{
   switch(dayName.toLowerCase()) {
        case "lundi":
            return 1;
        case "mardi":
            return 2;
        case "mercredi":
            return 3;
        case "jeudi":
            return 4;
        case "vendredi":
            return 5;
        case "samedi":
            return 6;
        case "dimanche":
            return 0;
        default:
            return null;
    }
}

function getDayName(dayNumber)
{
    switch(dayNumber){
        case 0:
            return "Dimanche";
        case 1:
            return "Lundi";
        case 2:
            return "Mardi";
        case 3:
            return "Mercredi";
        case 4:
            return "Jeudi";
        case 5:
            return "Vendredi";
        case 6:
            return "Samedi";
        default:
            return null;
    }

}