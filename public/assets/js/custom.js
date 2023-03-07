/**
 * Custom
 */

'use strict';
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function updateStatus(url, id, data) {


    $.post(url,
        {
            id: id,
            is_status: data,
        },
        function (data, status) {
            if (data == 1) {
                $.MessageBox("Güncellendi");
            } else {
                $.MessageBox("Sorun Var");
            }

        });
}

function updateDanger(url, id, data) {


    $.post(url,
        {
            id: id,
            is_danger: data,
        },
        function (data, status) {
            if (data == 1) {
                $.MessageBox("Güncellendi");
            } else {
                $.MessageBox("Sorun Var");
            }

        });
}

function saveStockMovement(url) {
    $.ajax({
        type: "POST",
        url: url,
        data: $("#stockmovementform").serialize(),
        success: function (response) {
            $("#result").empty().append(response);
        }
    });

}
