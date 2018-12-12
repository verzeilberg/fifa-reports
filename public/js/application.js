$(document).ready(function () {
    $('.resultTable').DataTable({
        searching: false,
        paging: false,
        select: false,
        info: false,
        order: [[3, "desc"], [8, "desc"]],
        columnDefs: [
            { orderable: false, targets: 0 },
            { orderable: false, targets: 1 },
            { orderable: false, targets: 2 },
            { orderable: false, targets: 3, visible: false },
            { orderable: false, targets: 4 },
            { orderable: false, targets: 5 },
            { orderable: false, targets: 6 },
            { orderable: false, targets: 7 },
            { orderable: false, targets: 8, visible: false }
        ]
    });
});
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
})