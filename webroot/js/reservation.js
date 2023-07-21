
let picker;
$( document ).ready(function() {




        //Fonction de création du picker avec les dates d'indisponibilité de la resource
        function createPicker(resourceId)
        {


                    $('#picker-container').append("<input class='invisible' id='picker' type='text' readonly='readonly'/>");
                    // requête Ajax pour la récupération des dates. ResourceController
                    //crée  le datepicker associé on success
                    $.ajax({
                        url: webrootUrl+"resources/"+resourceId+"/reservations/dates", 
                        type: "GET", 
                        dataType: "json", 
                        success: function (data) {
                            

                            console.log(data);
                            displayPicker(datesBetween(data));
                        
                            return data;                
                        },
                        error: function (xhr, status, error) {
                                             
                            console.log(xhr.responseText);
                            console.log("AJAX Request Error: " + error);
                            return [];
                        }
                    });

        }



        function displayPicker(bookedDates)
        {

            picker = new HotelDatepicker(document.getElementById('picker'),document.getElementById('start_date'),document.getElementById('end_date'), {

                //format: 'DD-MM-YYYY',
                disabledDates: bookedDates,
                inline: true,
                startOfWeek: 'monday',
                //disabledDaysOfWeek: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
                onSelectRange: function(){

                   //$('#picker').trigger('blur');


                }

            });

            //picker.getDDays();

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

    //Recrée le picker quand on change dee ressource
    $('#resourceInput').on('change', function(){
                   
                   $('#picker').remove();
                    picker.destroy();
                   // picker.getDDays();
                    createPicker($(this).val());

    });


    $('#start_date').on('click', function(e){
        e.preventDefault;
    });




});