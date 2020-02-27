let add_comment = $('.add_comment');

for (let i = 0; i < add_comment.length; i++) {
    let enlace = $('#' + add_comment[i].id);
    enlace.on('click', function () {
        $('#formu_comentar_' + enlace.attr('id').split("_")[2]).toggleClass('ocultar');
    });
}
