$(document).ready(function() {
    setTimeout(function() {

        // [ Basic Initialisation ]
        $('#basic-key-table').DataTable({
            keys: true
        });

        // [ Scrolling Table ]
        var skeytable = $('#scrool-key').DataTable({
            scrollY: 300,
            paging: false,
            keys: true
        });

        // [ Focus Cell Custom Styling ]
        $('#focus-key').DataTable({
            keys: true
        });

    }, 350);
});
