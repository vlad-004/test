$(document).ready(function () {

});

$('.show-eat-apple-modal_link').on('click', function (e) {
    e.preventDefault;
    $.ajax({
        url: $(this).data('url'),
        type: 'post',
        success: function (response) {
            $('#eatAppleModal').modal('show').find('.modal-content').html(response);
        },
        error: function (response) {
            alert(response);
        },
    })
})
$('#eatAppleModal').on('hide.bs.modal', function () {
    $(this).find('.modal-content').html('');
});

// $('#eat-apple-form').submit(function (e) {
//     e.preventDefault();
//     alert();
//     $.ajax({
//         url: $(this).attr('action'),
//         type: 'post',
//         data: $(this).serialize(),
//         dataType: 'json',
//         success: function () {
//             $.pjax.reload({
//                 container: '#appleGridview',
//             });
//         },
//         error: function (response) {
//             alert(response);
//         },
//     })
// })
