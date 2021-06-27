$(document).ready(function() {
    setTimeout(function() {
        // [ Server side processing Data-table ]
        $('#dt-server-processing').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "assets/plugins/data-tables/json/dt-json-data/scripts/server-processing.php",
            "columns": [{
                    "data": "first_name"
                },
                {
                    "data": "last_name"
                },
                {
                    "data": "position"
                },
                {
                    "data": "office"
                },
                {
                    "data": "start_date"
                },
                {
                    "data": "salary"
                }
            ]
        });

        // [ Custom HTTP Variables ]
        $('#dt-http').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "assets/plugins/data-tables/json/dt-json-data/scripts/server-processing.php",
                data: function(d) {
                    d.myKey = "myValue";
                    // d.custom = $('#myInput').val();
                    // etc
                }
            },
            "columns": [{
                    "data": "first_name"
                },
                {
                    "data": "last_name"
                },
                {
                    "data": "position"
                },
                {
                    "data": "office"
                },
                {
                    "data": "start_date"
                },
                {
                    "data": "salary"
                }
            ]
        });

        // [ POST Data ] 
        $('#dt-post').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "assets/plugins/data-tables/json/dt-json-data/scripts/post.php",
                type: "post"
            },
            "columns": [{
                    "data": "first_name"
                },
                {
                    "data": "last_name"
                },
                {
                    "data": "position"
                },
                {
                    "data": "office"
                },
                {
                    "data": "start_date"
                },
                {
                    "data": "salary"
                }
            ]
        });
    }, 350);
});
