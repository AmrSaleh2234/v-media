$(document).ready(function () {

    $('#branch').change(function () {
        var id = $(this).val();
        $.get("/admin/get_managements/" + id, function (response) {
            $('#managements').find('option')
                .remove()
                .end();
            $.each(response, function (i, item) {
                $('#managements').append('<option value="' + item['id'] + '">' + item['name'] + '</option>');
            })
        });
    });


    // $('#project_title,#date,#client_id,#second_party,#assigned_works,#definitions,#commitments').change(function() {
    //     var value = $(this).val();
    //     var precent =  $('#changeable_precent').html();
    //     if(value == null || value == '' || value == undefined) {
    //        if(parseInt(precent) != 0) {
    //         $('#changeable_precent').html(parseInt(precent) - parseInt(5));
    //        }
    //     } else {
    //         $('#changeable_precent').html(parseInt(precent) + parseInt(5));
    //     }
    // });

    $('#type').keyup(function () {
        var value = $(this).val();
        var list = [];
        var data = {
            'q': value,
        };
        if (value != '' || value != null || value == undefined) {
            $.get('/admin/get_contract_types/', data, function (response) {
                if (response) {
                    list = response;
                    $("#type").autocomplete({
                        source: list,
                        onSelect: function (suggestion) {
                            //var thehtml = '<strong>Currency Name:</strong> ' + suggestion.value + ' <br> <strong>Symbol:</strong> ' + suggestion.data;
                            //$('#outputcontent').html(thehtml);

                        }
                    });
                }
            });
        }

    });


    $('#add-new-project-item-popup-button').click(function () {
        $('#add-new-project-item-popup').addClass("opened");
    });

    $('.close-all-popups').click(function () {
        $('#add-new-project-item-popup').removeClass("opened");
    });

    $('#add_new_sub_item').click(function () {

        var number = $(this).attr('data-count');
        var sub_item = '<div class="section sub">' +
            '<div class="inputs-container">' +
            '<label for="mian-item-title">' +
            ' عنوان البند الفرعي ' +
            '(  ' + number + '  ) ' +
            '</label>' +
            '<input type="text" name="sub_item_title[]" required class="main-input" placeholder="عنوان البند الفرعي">' +
            '</div>' +
            '<div class="inputs-container">' +
            '<label for="mian-item-title">القيمة</label>' +
            '<input type="text" name="sub_item_amount[]" required class="main-input" placeholder="القيمة">' +
            '</div>' +
            '<div class="inputs-container">' +
            '<label for="mian-item-title">المدة</label>' +
            '<input type="text" name="sub_item_period[]" required class="main-input" placeholder="المدة">' +
            '</div>' +
            '</div>';


        $('#add-project-item-container').append(sub_item);
        $(this).attr('data-count', parseInt(number) + parseInt(1));

        $(".popup-items-content").animate({
            scrollTop: $('.popup-items-content').prop("scrollHeight")
        }, 2500);
    });

    $('#add_items_form').submit(function (event) {

        event.preventDefault();
        $(".btn-save-contract-items").html("جاري التحميل");
        $(".btn-save-contract-items").attr('disabled', true);
        var formData = $(this).serialize();
        $.ajax({
            url: $(this).attr("action"),
            method: $(this).attr("method"),
            data: formData,
            success: function (response) {
                $('#add_items_form')[0].reset();
                $('.main-popup-container').removeClass('opened');
                $('.sub').remove();
                $(".btn-save-contract-items").attr('disabled', false);
                $('#moreItems').append(response);
            },
            error: function (xhr, status, error) {
                alert('something went wrong');
            },
        });
    });




});
