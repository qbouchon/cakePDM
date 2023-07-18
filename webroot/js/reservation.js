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

});





function displayPicker(bookedDates, maxResourceDays){

    const DateTime = easepick.DateTime;
    const picker = new easepick.create({
        element: "#checkin",
        css: [
             webrootUrl+'/easepick/bundle/dist/index.css'
        ],
        zIndex: 10,
        readonly: false,
        lang: "fr-FR",
        format: "DD/MM/YYYY",
        grid: 2,
        calendars: 2,
        inline: true,
        RangePlugin: {
            elementEnd: "#checkout",
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
        ]
    })
    

}


function destroyPicker()
{
    
    $('#picker').html("<input class=''  id='checkin'\><input class='' id='checkout'\>");
  
}



//Création du picker avec les dates d'indisponibilité de la resource
function createPicker(resourceId)
{

            // Ajax request pour la récupération des dates. ResourceController
            $.ajax({
                url: webrootUrl+"resources/"+resourceId+"/reservations/dates", // URL to the specific action
                type: "GET", // HTTP method (GET, POST, etc.)
                dataType: "json", // Expected data type in response
                success: function (data) {
                    // Handle the successful response here
                    console.log(data); // You can access the data returned from the server

                    displayPicker(arrayToDateTime(data),null);
                    
                    return data;                
                },
                error: function (xhr, status, error) {
                    // Handle errors if the AJAX request fails
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

    
    // Split the original date string using the "/" delimiter
    const dateParts = dateString.split('/');

    // Rearrange the parts to form the new date string in "yyyy-mm-dd" format
    const newDate = `${dateParts[2]}-${dateParts[1]}-${dateParts[0]}`;

    return newDate;
}