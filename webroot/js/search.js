function search() {

    // var input, filter, table, tr;
    // input = $("#searchBox");
    // filter = input.val().toUpperCase();
    // table = $("#searchTable");
    // tr = table.find("tr");

    // tr.each(function (index){

    //     if (index === 0)
    //         return true; 

    //     var displayRow = false;
    //     var row = $(this);

    //     row.find("td:not(:last-child)").each(function () {

    //         var td = $(this);
    //         var txtValue = td.text();

    //         if (txtValue.toUpperCase().indexOf(filter) > -1) 
    //         {
    //             displayRow = true;
    //             return false; 
    //         }

    //     });

    //       if (displayRow)
    //           row.show();
    //       else
    //           row.hide();
      
    // });

    if($('#searchBox').val() != '')
    {
            $('#resetSearch').removeClass('displaynone');
    }
}

$(document).ready(function() {
    if($('#searchBox').val() != '')
    {
            $('#resetSearch').removeClass('displaynone');

            tippy('#resetSearch', {
                                        content: 'Réinitialiser',
                                        duration: 0,
                                        allowHTML:true,                                    
            });
    }



});