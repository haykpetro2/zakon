$(document).ready(function () {

    $(document).on('click' , '.for_notrans', function () {
        $('.nav_bg').toggleClass('no_transparent');
    });

    $('.lawyers div.card').on('mouseover', function () {
        $(this).find('div.card-body').removeClass('invisible');
        $(this).find('div.card-footer').removeClass('invisible');
    });
    $('.lawyers div.card').on('mouseout', function () {
        $(this).find('div.card-body').addClass('invisible');
        $(this).find('div.card-footer').addClass('invisible')
    });

    $(".chat_messages").animate({ scrollTop: $('.chat_messages').prop("scrollHeight")}, 1000);

    $(document).on('click', '.choose_chat_image' , function () {
        $('.chat_image').click();
    });

    // $('#datepicker').datepicker({
    //     format: "dd.mm.yyyy",
    //     language: "ru",
    //     multidate: 5,
    //     multidateSeparator: ", ",
    //     // todayHighlight: true,
    //     templates: {
    //         leftArrow: '<i class="fas fa-chevron-left"></i>',
    //         rightArrow: '<i class="fas fa-chevron-right"></i>'
    //     },
    //     startDate: new Date(),
    // });
    // $('#datepicker').on('changeDate', function() {
    //     $('#my_hidden_input').val(
    //         $('#datepicker').datepicker('getFormattedDate')
    //     );
    // });
});