$(document).ready(function() {
    $('#dancers-table').dataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "dance/results",
        searching:false,
        lengthChange:false,
        "columns": [
            { "data": "id" },
            { "data": "name" },
            { "data": "email" },
            { "data": "role" },
            { "data": "phone" },
            { "data": "scholl" },
            { "data": "address" },
            { "data": "created_at" }
        ]
    } );
} );