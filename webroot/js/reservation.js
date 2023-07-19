let picker;
let tomorrow = new Date();
tomorrow.setDate(tomorrow.getDate() + 1);

$( document ).ready(function() {


    //Initialisation du easypick avec la ressource séléctionnée au chargement de la page
    rId = $('#resourceInput').value;
    createPicker($('#resourceInput').val());



        function displayPicker(bD, maxResourceDays){

            
            const DateTime = easepick.DateTime;

            bookedDates = bD.map(d => {

                                    if (d instanceof Array) {
                                        const start = new DateTime(d[0], 'YYYY-MM-DD');
                                        const end = new DateTime(d[1], 'YYYY-MM-DD');
                                        return [start, end];
                                    }

                                    return new DateTime(d, 'YYYY-MM-DD');
            });
          
            picker = new easepick.create({
                element: "#start_date",
                css: [
                     webrootUrl+'/easepick/bundle/dist/custom.css'
                ],
                zIndex: 10,
                readonly: true,
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
                    minDate: tomorrow,
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

           
                            
        }


        // function checkDates(sD, eD, bD) {



        //            var startDate = new DateTime(sD,'YYYY-MM-DD');
        //           var  endDate = new DateTime(eD, 'YYYY-MM-DD');

        //         if(startDate != null && endDate != null )
        //         {
        //                     if(startDate.isSameOrBefore(tomorrow))
        //                     {
        //                         alert("same or before tommorrow  "+startDate+"  tomorrow :  "+tomorrow)
        //                         return false;
        //                     }

        //                     if (endDate.isBefore(startDate)) {
        //                         // If startDate is before endDate, return false.
        //                         alert("before");
        //                         return false;
        //                     }

        //                     let currentDate = startDate.clone();
        //                     while (currentDate.isSameOrBefore(endDate)) {
        //                         if (bD.includes(currentDate.format('YYYY-MM-DD'))) {
        //                             // If any date between startDate and endDate is in bookedDates, return false.
        //                             alert("inArray");
        //                             return false;
        //                         }
        //                         currentDate.add(1, 'day'); // Move to the next date
        //                     }

        //              return true;        

        //         }            
        //         // If none of the previous conditions are matched, return true.
        //        alert("null");
        //         return false;
        // }



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
                            
                            console.log(data);
                            displayPicker(data,null);
                            
                            return data;                
                        },
                        error: function (xhr, status, error) {
                                             
                            console.log("coucou"+xhr.responseText);
                            console.log("AJAX Request Error: " + error);
                            return [];
                        }
                    });

        }



                //Gestion des interaction entre le easepicker et les inputs
                
                //empèche l'ouverture du picker html5
                $('#start_date').on('click', function(e){
                        e.preventDefault();
                });

                $('#end_date').on('click', function(e){
                        e.preventDefault();
                });


                // met à jour le easepick avec les dates directemententrée dans les inputes
                 $('#start_date').on('blur', function(e){



                    //alert(checkDates($('#start_date').val(), $('#end_date').val(),bookedDates));
                    picker.setStartDate($(this).val());

                 });
                 

                 $('#end_date').on('blur', function(e){

                    //alert(checkDates($('#start_date').val(), $('#end_date').val(),bookedDates));
                    picker.setEndDate($(this).val());

                });

                 //Recharge le picker avec les dates d'indisponibilité de la ressource sélectionnée
                $('#resourceInput').on('change', function(){
                   
                    picker.destroy();
                    createPicker($(this).val());

                });

});