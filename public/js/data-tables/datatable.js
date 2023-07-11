
(function ($) {
    "use strict";

$(document).ready(function () {
    var table = $('#peds_finalizados, #peds_cancelados').DataTable({
        // scrollX: true,
        paging: true,

        "lengthMenu": [ [5, 10, 25, 50, 100, 500, -1], [5, 10, 25, 50, 100, 500, "All"] ],
                    "pageLength":5,
                    "language": {
                        "lengthMenu": "Exibir _MENU_ Por Página",
                        "zeroRecords": "Nothing found - sorry",
                        "info": " Página _PAGE_ de _PAGES_",
                        "infoEmpty": "No records available",
                        "infoFiltered": "(filtered from _MAX_ total records)",
                        "sSearchPlaceholder": "Buscar...",
                    },

    });
});


})(jQuery);
