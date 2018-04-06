document.addEventListener("DOMContentLoaded", function () {

    $('._selectAll').on('click', function (event) {

        var studentIdCheckboxes = $('input[type="checkbox"][name="studentId"]');

        if(studentIdCheckboxes.prop('checked'))
            studentIdCheckboxes.prop('checked', false);
        else
            studentIdCheckboxes.prop('checked', true);
    });

    $('#_exportStudents').on('click', function (event) {

        var checkedIds = [];

        $('input[type="checkbox"][name="studentId"]').each(function () {
                this.checked ? checkedIds.push($(this).val()) : '';
        });

        var form = $(this).parent();
        form.find('input[type="hidden"][name="checkedIds"]').val(checkedIds);
        form.submit();

    });

    $('#_exportAttendence').on('click', function (event) {
        var form = $(this).parent();
        form.submit();
    });

});
