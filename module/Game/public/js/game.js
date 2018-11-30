$(function () {
    $(".datepicker").datepicker({
        showButtonPanel: false,
        dateFormat: "dd-mm-yy",
    });

    $("input#goals_h,input#goals_a").keyup(function () {
        var goalsH = $('input#goals_h').val();
        var goalsA = $('input#goals_a').val();
        $('input#goals_against_a').val(goalsH);
        $('input#goals_against_h').val(goalsA);

        if (goalsH == goalsA) {
            $('input#points_h').val(1);
            $('input#points_a').val(1);
        } else if (goalsH > goalsA) {
            $('input#points_h').val(3);
            $('input#points_a').val(0);
        } else if (goalsH < goalsA) {
            $('input#points_h').val(0);
            $('input#points_a').val(3);
        }
    });

    $("#slider").slider({
        range: "min",
        value: $("input[name='homeForm[possession]']").val(),
        min: 1,
        max: 100,
        slide: function (event, ui) {
            var possesionHome = ui.value;
            var possesionAway = 100 - ui.value;
            $("input[name='homeForm[possession]']").val(possesionHome);
            $("input[name='awayForm[possession]']").val(possesionAway);
        }
    });

    //Get game data for result modal
    $("#resultsTable tbody tr.clickableRowResult").on("click", function () {
        var gameId = $(this).data('game-id');
        $.ajax({
            type: 'POST',
            data: {
                gameId: gameId
            },
            url: "/game-ajax/getGame",
            async: true,
            success: function (data) {
                if (data.success === true) {
                    //Extract game data
                    $.each(data.result, function (mainIndex, value) {
                        $.each(data.result[mainIndex], function (index, value) {
                            var gameType = '';
                            if (mainIndex == 'homeGameResult') {
                                gameType = 'H';
                            }
                            if (mainIndex == 'awayGameResult') {
                                gameType = 'A';
                            }
                            if (index + gameType == 'possessionH' || index + gameType == 'possessionA') {
                                $('#' + index + gameType).attr('style', 'width:' + value + '%;');
                                $('#' + index + gameType).attr('aria-valuenow', value);
                                $('#' + index + gameType).html(value + '%');
                            } else {
                                $('#' + index + gameType).html(value);
                            }
                        });
                    });
                    $('#statsModal').modal('toggle')

                } else {
                    alert(data.errorMessage);
                }

            }
        });
    });

});