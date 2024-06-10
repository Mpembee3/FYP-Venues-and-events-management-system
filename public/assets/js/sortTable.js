'use strict';

function sortTable() {
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("reservationsTable");
  switching = true;
  
  // Get sort criteria
  var sortStatus = document.getElementById("sortStatus").value;
  var sortDate = document.getElementById("sortDate").value;
  
  // Loop until no switching is done
  while (switching) {
    switching = false;
    rows = table.rows;
    
    // Loop through all table rows (except the first, which contains table headers)
    for (i = 1; i < (rows.length - 1); i++) {
      shouldSwitch = false;
      
      // Get the two elements you want to compare
      x = rows[i];
      y = rows[i + 1];
      
      // Compare based on status
      if (sortStatus !== "") {
        if (x.getAttribute("data-status") !== sortStatus && y.getAttribute("data-status") === sortStatus) {
          shouldSwitch = true;
          break;
        }
      }
      
      // Compare based on date
      if (sortDate !== "") {
        var dateX = new Date(x.getAttribute("data-date"));
        var dateY = new Date(y.getAttribute("data-date"));
        if (sortDate === "asc" && dateX > dateY) {
          shouldSwitch = true;
          break;
        } else if (sortDate === "desc" && dateX < dateY) {
          shouldSwitch = true;
          break;
        }
      }
    }
    
    if (shouldSwitch) {
      // If a switch has been marked, make the switch and mark that a switch has been done
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
}
