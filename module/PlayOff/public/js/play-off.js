$(function () {
    $(".datepicker").datepicker({
        showButtonPanel: false,
        dateFormat: "dd-mm-yy",
    });
    $( "input.inputChecked" ).checkboxradio({
        icon: false
    });
});