$( document ).ready(function() {


    //Initialisation du easypick
    rId = $('#resourceInput').value;
    createPicker($('#resourceInput').val());
   
    
    $('#resourceInput').on('change', function(){
   
        destroyPicker();
        createPicker($(this).val());

    });



    $('#checkin').on('change', function(){

        dateString = $(this).val();
        newDate = toDateTime(dateString);
        $('#start_date').val(newDate);

    });

    $('#checkout').on('change', function(){

        dateString = $(this).val();
        newDate = toDateTime(dateString);
        $('#end_date').val(newDate);

    });


     $('#start_date').on('click', function(e){
        e.preventDefault();
     });

     $('#end_date').on('click', function(e){
        e.preventDefault();
     });


     $('#start_date').on('change', function(e){
        e.preventDefault();

     });



});





function displayPicker(bookedDates, maxResourceDays){

    const DateTime = easepick.DateTime;
    const picker = new easepick.create({
        element: "#start_date",
        css: [
             webrootUrl+'/easepick/bundle/dist/index.css'
        ],
        zIndex: 10,
        readonly: false,
        lang: "fr-FR",
        format: "YYYY-MM-DD",
        grid: 2,
        calendars: 2,
        inline: true,
        RangePlugin: {
            elementEnd: "#end_date",
            repick: true,
            strict: false,
            locale: {
                one: "jour",
                other: "jours"
            }
        },
        LockPlugin: {
            minDate: new Date() + 1,
            minDays: 0,
             maxDays : maxResourceDays,
            selectForward: true,
            inseparable: true,
            filter(date, picked) 
            {
                                    if (picked.length === 1) 
                                    {
                                                  const incl = date.isBefore(picked[0]) ? '[)' : '(]';
                                                  return !picked[0].isSame(date, 'day') && date.inArray(bookedDates, incl);
                                    }
                                    return date.inArray(bookedDates, '[)');
            }
        },
        plugins: [
            "RangePlugin",
            "LockPlugin"
        ],

    });

       $('#start_date').on('blur', function(e){

        picker.setStartDate($(this).val());
     });
       $('#end_date').on('blur', function(e){

        picker.setEndDate($(this).val());
     });
                    

}


function destroyPicker()
{
    
    $('#picker').html("<input class=''  id='checkin'\><input class='' id='checkout'\>");
  
}



//Création du picker avec les dates d'indisponibilité de la resource
function createPicker(resourceId)
{

            // requête Ajax pour la récupération des dates. ResourceController
            //crée  le datepicker associé on success
            $.ajax({
                url: webrootUrl+"resources/"+resourceId+"/reservations/dates", 
                type: "GET", 
                dataType: "json", 
                success: function (data) {
    
                    displayPicker(arrayToDateTime(data),null);
                    
                    return data;                
                },
                error: function (xhr, status, error) {
                    
                    alert('yo');
                    console.log("coucou"+xhr.responseText);
                    console.log("AJAX Request Error: " + error);
                    return [];
                }
            });

}



function arrayToDateTime(bookedDatesData)
{
    const DateTime = easepick.DateTime;

    bookedDatesData.map(d => {
          if (d instanceof Array) {
            const start = new DateTime(d[0], 'YYYY-MM-DD');
            const end = new DateTime(d[1], 'YYYY-MM-DD');

            return [start, end];
          }

          return new DateTime(d, 'YYYY-MM-DD');
      });

    return [];
}

function toDateTime(dateString)
{

    const dateParts = dateString.split('/');
    const newDate = `${dateParts[2]}-${dateParts[1]}-${dateParts[0]}`;

    return newDate;
}