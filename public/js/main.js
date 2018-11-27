function show_message(message, lvl) {
    noty({
        // layout: 'bottomRight',
        layout: 'topCenter',
        type: lvl, // success, error, warning, information, notification, alert
        text: message,
        timeout: 8000,
        template: '<div class="noty_message"><span class="noty_text"></span><div class="noty_close"></div></div>',
        closeWith: ['button'],
    });
}
function uploadFileAjax(){
    $('.fileupload').fileupload({
        dataType: 'json',
        add: function (e, data) {
            var fileType = data.files[0].name.split('.').pop(), allowdtypes = ['pdf', 'jpg', 'png'];
            if (allowdtypes.indexOf(fileType) < 0) {
                show_message('Not a valid file. Please Use PDF, JPG, or PNG formats only', 'error');
                return false;
            }
            data.submit();
        },
        done: function (e, data) {
            var response = JSON.parse(data.jqXHR.responseText);
            show_message(response.message, 'success');
            var offer_id = response.offer_id;
            $('#signedPdf_' + offer_id).html("<a class='btn btn-success btn-sm js-view-pdf' href='/offers/signed/" + offer_id + "'>View Signed Form</a>");
            $('#btn_upload_sf_' + offer_id ).text("Replace Signed Form");
        },
        fail: function (ev, data) {
            var message = "";
            var myerr = JSON.parse(data.jqXHR.responseText);
            $.each(myerr, function (key, data) {
                $.each(data, function (index, data) {
                    message += data + "<br/>";
                })
            })
            show_message(message, 'error');
        }
    });
}


$(function() {

    $(document).ajaxSend(function(event, jqxhr, settings){
        $.LoadingOverlay("show");
    });
    $(document).ajaxComplete(function(event, jqxhr, settings){
        $.LoadingOverlay("hide");
    });

    // hide flash message
    $('div.alert').delay(4000).fadeOut(350);

    $('.datepicker').datepicker({
        dateFormat: 'mm/dd/yyyy',
    });

    $.ajaxSetup({
        headers: {'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')}
    });

    $('#studentTabs a').click(function (e) {
      e.preventDefault()
      $(this).tab('show')
    })

    $('#studentTabs a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = $(e.target).attr("href") // activated tab
        switch(target){
            case '#offer-cart':
                $.ajax({
                    type: "GET",
                    url: "/offers/get",
                    success: function(data) {
                        $('#offer-cart').html(data);
                        uploadFileAjax();
                    }
                });
            break;

            case '#students-tab':
                $.ajax({
                    type: "GET",
                    url: "/offers/students",
                    success: function(data) {
                        $('#students-tab').html(data);
                    }
                });
            break;

        }
    });

    $(document).on('click', '.js-print-job-offer', function () {
        var btn = $(this);
        var offer_form = btn.data('offer_form');
        var studentId = btn.data('student-id');
        btn.attr('disabled', true);
        // set status for student- unvailable
        $.post('/offers/set_student_unvailable', { student_id : studentId }, function (result) {
            printJS('/student/get/' + offer_form);
            btn.removeAttr("disabled");
            $('#student_completed_lbl_' + studentId).removeClass('hide');
            $('#print_offer_'+ studentId).hide();
            $('.remove-from-offers').hide();
            $('#reprint_offer_'+ studentId).removeClass('hide');
            $('#btn_upload_sf_'+ studentId).removeClass('hide');

        }, 'json');

        return false;
    });

    $(document).on('click', 'a.remove-from-offers', function (e) {
        e.preventDefault();
        var studentId = $(this).data('student-id');
        $.post('/offers/remove', { studentId : studentId }, function (data) {
            show_message(data.message, data.title);
        }, 'json');
        var total = parseInt($('#students_total').text());
        $('#students_total').text(total + 1);

        var totalOffers = parseInt($('#active_offers_count').text());
        $('#active_offers_count').text(totalOffers - 1);

        $(this).closest('.list-group-item').animate({opacity: 0, left: '-1000px' }, 600, 'linear', function() { $(this).remove(); });
    });

    $(document).on('click', '.add_to_completed', function () {
        var btn = $(this);
        add_to_completed(btn, false);
        return false;
    });



    $(document).on('click', '.js-reprint-job-offer', function () {
        var btn = $(this);
        var offer_form = btn.data('offer_form');
        printJS('/student/get/' + offer_form);
        return false;
    });

    // when click view pdf - show pdf in iframe
    $(document).on('click', '.js-view-pdf', function () {
        var link = $(this).attr('href');

        $('#frame_pdf').attr('src', link).attr('height', $(window).height() - 100);
        $('#pdfModal').modal();

        $('#pdfModal').on('hidden.bs.modal', function () {
            $('#frame_pdf').attr('src', 'about:blank');
        });
        return false;
    });

    /**
     * add student to offers
     */
    $(document).on('click','#students a.add-to-offers', function (e) {
        e.preventDefault();
        var studentId = $(this).data('student-id');
        $.ajax({
            type: "POST",
            url: "/offers/add",
            dataType: 'json',
            data: { student_id: studentId },
            success: function(data) {
                show_message(data.message, data.title);
                // decrease number of participants
                var total = parseInt($('#students_total').text());
                $('#students_total').text(total - 1);

                var totalOffers = parseInt($('#active_offers_count').text());
                $('#active_offers_count').text(totalOffers + 1);
            }
        });
        $(this).closest('.list-group-item').animate({opacity: 0, right: '-1000px' }, 600, 'linear', function() { $(this).remove(); });
    });

    $(document).on('click', '.print-pdf', function () {
        printJS($('#frame_pdf').attr('src'));
        return false;
    });

    new Clipboard('.js_copy_link');


    if(window.location.hash == "#offers-tab")
        $('#studentTabs a#tab_completed').click();

    $(document).on('click', '.js_move_to_completed', function () {
        $('#studentTabs a#tab_completed').click();
        return false;
    });

    $('.js_approve_offer').click(function () {
        var offer_id = $(this).data('offer_id');
        $.get('/offers/make_approve/' + offer_id, function (response) {
            show_message(response.message, response.status);
            $('#ad_of_' + offer_id).animate({opacity: 0, right: '-1000px' }, 600, 'linear', function() { $(this).remove(); });
        }, 'json')
        return false;
    });

    $('.js_select_all').click(function () {
        var checkboxes = $(this).closest('form').find(':checkbox');
        checkboxes.prop('checked', true);
    });
    $('.js_unselect_all').click(function () {
        var checkboxes = $(this).closest('form').find(':checkbox');
        checkboxes.prop('checked', false);
    });

});