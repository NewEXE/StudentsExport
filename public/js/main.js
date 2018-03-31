document.addEventListener("DOMContentLoaded", function () {

    $('#_selectAll').on('click', function (event) {

        var selector = $('input[type="checkbox"][name="studentId"]');

        if(selector.prop('checked'))
            selector.prop('checked', false);
        else
            selector.prop('checked', true);
    });

    // $('#_export').on('click', function (event) {
    //
    //     checkedIds = [];
    //
    //     $('input[type="checkbox"][name="studentId"]').each(function () {
    //             this.checked ? checkedIds.push($(this).val()) : '';
    //         });
    //
    //     $.ajax({
    //         'url': $(this).data('url'),
    //         'method': 'GET',
    //         'dataType': 'json',
    //         'data': {
    //             'checkedIds': checkedIds
    //         },
    //         'success': function(data) {
    //             console.log(data);
    //         },
    //         'error': function(xhr, status, error) {
    //             // alert("An error occured: " + xqXHR.status + " " + xqXHR.statusText);
    //             if (xhr && status && error) {
    //                 console.log(xhr.responseText);
    //                 alert(error + ' (' + 'see console for responseText)');
    //             }
    //         }
    //     });
    // });

});