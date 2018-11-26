$(function () {
    $(".datepicker").datepicker({
        showButtonPanel: false,
        dateFormat: "dd-mm-yy",
    });
    $( "input[type=checkbox]" ).checkboxradio({
        icon: false
    });
});