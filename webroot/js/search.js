function search() {
  var input, filter, table, tr;
  input = $("#searchBox");
  filter = input.val().toUpperCase();
  table = $("#searchTable");
  tr = table.find("tr");

  tr.each(function (index) {
    if (index === 0) { // Skip the header row
      return true; // Equivalent to "continue" in a jQuery loop
    }

    var displayRow = false;
    var row = $(this);

    row.find("td:not(:last-child)").each(function () {
      var td = $(this);
      var txtValue = td.text();

      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        displayRow = true;
        return false; // Exit the inner loop if a match is found
      }
    });

    if (displayRow) {
      row.show();
    } else {
      row.hide();
    }
  });
}
