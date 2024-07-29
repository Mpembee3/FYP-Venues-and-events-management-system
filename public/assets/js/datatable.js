
    // document.addEventListener("DOMContentLoaded", function() {
    //     // Select your table element
    //     const dataTable = new simpleDatatables.DataTable("#table")
    // });

    // let table = new DataTable('#table');

    //import DataTable from 'datatables.net-dt';
    // import 'datatables.net-responsive-dt';
    // import "datatables.net-autofill-dt";
    // import "datatables.net-buttons-dt";
    // import "datatables.net-colreorder-dt";
    // import "datatables.net-fixedcolumns-dt";
    // import "datatables.net-fixedheader-dt";
    // import "datatables.net-keytable-dt";
    // import "datatables.net-responsive-dt";
    // import "datatables.net-rowgroup-dt";
    // import "datatables.net-rowreorder-dt";
    // import "datatables.net-scroller-dt";
    // import "datatables.net-searchbuilder-dt";
    // import "datatables.net-searchpanes-dt";
    // import "datatables.net-select-dt";
    // import "datatables.net-staterestore-dt";
    
    let table = new DataTable('#table', {
        // responsive: true
        paging:true,
        scrollY:false,
        info:true,
        pageLength: 5,
        layout: {
            topEnd: {
                pageLength:{
                menu: [ 5, 10, 25, 50, 100 ]
            }
        },
            topStart: 'search',
            bottom: 'info',
            bottomEnd:null,
            bottomStart:null,
            bottom1: 'paging'
        },

    });