document.addEventListener("DOMContentLoaded", function () {

    $('._selectAll').on('click', function (event) {

        var selector = $('input[type="checkbox"][name="studentId"]');

        if(selector.prop('checked'))
            selector.prop('checked', false);
        else
            selector.prop('checked', true);
    });

    $('#_exportStudents').on('click', function (event) {

        var checkedIds = [];

        $('input[type="checkbox"][name="studentId"]').each(function () {
                this.checked ? checkedIds.push($(this).val()) : '';
        });

        var form = $(this).parent();
        $(this).parent().find('input[type="hidden"][name="checkedIds"]').val(checkedIds);
        form.submit();

    });

    $('#_exportAttendence').on('click', function (event) {
        var form = $(this).parent();
        form.submit();
    });

});