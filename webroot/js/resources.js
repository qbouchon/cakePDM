$( document ).ready(function() {

             new DataTable('#unArchivedResources', {
                    lengthChange: false,
                    info: false
                });

             new DataTable('#archivedResources', {
                     lengthChange: false,
                     info: false
                });
});