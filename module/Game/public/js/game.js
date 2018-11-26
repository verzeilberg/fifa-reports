$(function () {
    $(".datepicker").datepicker({
        showButtonPanel: false,
        dateFormat: "dd-mm-yy",
    });
    
    $( "#slider" ).slider({
        range: "min",
      value: $( "input[name=possessionH]" ).val(),
      min: 1,
      max: 100,
      slide: function( event, ui ) {
          var possesionHome = ui.value;
          var possesionAway = 100 - ui.value;
        $( "input[name=possessionH]" ).val( possesionHome );
        $( "input[name=possessionA]" ).val( possesionAway );
      }
    });
});