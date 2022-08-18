$(document).ready(function() {
    setTimeout(function() {
        // [ Ajax Data Source (Arrays) ]
        $('#dt-ajax-array').DataTable({
            "ajax": "assets/plugins/data-tables/json/dt-json-data/arrays.txt"
        });
        // [ Ajax Data Source (Objects) ]
        $('#dt-ajax-object').DataTable({
            "ajax": "assets/plugins/data-tables/json/dt-json-data/objects.txt",
            "columns": [{
                    "data": "name"
                },
                {
                    "data": "position"
                },
                {
                    "data": "office"
                },
                {
                    "data": "extn"
                },
                {
                    "data": "start_date"
                },
                {
                    "data": "salary"
                }
            ]
        });
        // [ Nested Object Data (objects) ]
        $('#dt-nested-object').DataTable({
            "processing": true,
            "ajax": "assets/plugins/data-tables/json/dt-json-data/objects_deep.txt",
            "columns": [{
                    "data": "name"
                },
                {
                    "data": "hr.position"
                },
                {
                    "data": "contact.0"
                },
                {
                    "data": "contact.1"
                },
                {
                    "data": "hr.start_date"
                },
                {
                    "data": "hr.salary"
                }
            ]
        });
        // [ Orthogonal Data ]
        $('#dt-orthogonal').DataTable({
            ajax: "assets/plugins/data-tables/json/dt-json-data/orthogonal.txt",
            columns: [{
                    data: "name"
                },
                {
                    data: "position"
                },
                {
                    data: "Office"
                },
                {
                    data: "extn"
                }, {
                    data: {
                        _: "start_date.display",
                        sort: "start_date.timestamp"
                    }
                },
                {
                    data: "salary"
                }
            ]
        });
        // [ Generated Content For A Column ]
        var generatetable = $('#dt-generate-content').DataTable({
            "ajax": "assets/plugins/data-tables/json/dt-json-data/arrays.txt",
            "columnDefs": [{
                "targets": -1,
                "data": null,
                "defaultContent": "<button>Click!</button>"
            }]
        });

        $('#dt-generate-content tbody').on('click', 'button', function() {
            var data = generatetable.row($(this).parents('tr')).data();
            alert(data[0] + "'s salary is: " + data[5]);
        });

        // [ Deferred Rendering For Speed ]
        $('#dt-render').DataTable({
            "ajax": "assets/plugins/data-tables/json/dt-json-data/arrays.txt",
            "deferRender": true
        });

    }, 350);
});
