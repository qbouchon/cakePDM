 $( document ).ready(function() {


 const DateTime = easepick.DateTime;


//Créer une fonction qui récupére les dates en fonction des reservations de la resourceS
 var rDates = [
          '2023-07-02',
          ['2023-07-06', '2023-07-11'],
          '2023-07-18',
          '2023-07-19',
          '2023-07-20',
          '2023-07-25',
          '2023-07-28'
          ];

 var bookedDates = rDates.map(d => {
          if (d instanceof Array) {
            const start = new DateTime(d[0], 'YYYY-MM-DD');
            const end = new DateTime(d[1], 'YYYY-MM-DD');

            return [start, end];
          }

          return new DateTime(d, 'YYYY-MM-DD');
      });



    createReservationPicker(bookedDates);


});


function createReservationPicker(bookedDates){



    const picker = new easepick.create({

        element: document.getElementById('reservationPicker'),
        css: [
          
          '../easepick/bundle/dist/index.css',
        ],
         lang: "fr-FR",
         plugins: ['RangePlugin', 'LockPlugin'],
         RangePlugin: {
          tooltip: true,
        },
        LockPlugin: {
                  minDate: new Date(),
                  minDays: 2,
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
        }
    });




}