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


