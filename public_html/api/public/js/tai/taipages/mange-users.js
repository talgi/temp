$(document).ready(function() {
    $('#users-table').dataTable( {
        "processing": true,
        "serverSide": true,
        ordering:  true,
        "ajax": g_url+CMS_NAME+"/mange-users/records",
        "columns": [
            { "data": "id" },
            { "data": "name" },
            { "data": "email" },
            { "data": "score" },
            { "data": "phone" },
            { "data": "city" },
            { "data": "address" },
            { "data": "country" },
            { "data": "postal" },
            { "data": "total_booklets" },
            { "data": "facebook" },
            { "data": "banned" }
        ],
        "drawCallback": function( settings ) {
           $(".banned").change(function(){
               $this = $(this);
               $.ajax({
                   url:g_url+CMS_NAME+"/mange-users/ban",
                   data:{ban:$this.val(),userId:$this.data("userid")},
                   type:"post"
               })
           });
        },
        "initComplete": function(settings, json) {

        }
    } );

    $("select").addClass("noSelect");
} );