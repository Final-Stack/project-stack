$(document).ready(function () {

    let idUsuario = $('#idUsuario').val();
    let idPregunta = $('#idPregunta').val();
    let up = $('.fa-arrow-up');
    let down = $('.fa-arrow-down');
    let contenedorConElNumero = $('#votos-count');


    // poner el total de votos
    countVotos();
    ifVotado();

    // listener de los botones up y down
    up.on('click', function () {
        console.log('up');
        votar('mas', idUsuario, idPregunta);
        $('#up').css('color', 'green');
    });
    down.on('click', function () {
        console.log('down');
        votar('menos', idUsuario, idPregunta);
        $('#up').css('color', 'black');
    });

    /**
     *
     * @param accion
     * @param idUsuario
     * @param idPregunta
     */
    function votar(accion, idUsuario, idPregunta) {
        let url = null;
        if (accion === 'mas') {
            url = '/votacion/mas/'
        } else {
            url = '/votacion/menos/'
        }
        $.ajax({
            url: url + idUsuario + '/' + idPregunta,
            method: 'GET',
            success: function (data) {
                contenedorConElNumero.empty();
                contenedorConElNumero.html(data);
            }
        });
    }

    /**
     * funcion para contar votos
     */
    function countVotos() {
        $.ajax({
            url: '/votosGetAll/' + idPregunta,
            method: 'GET',
            async: false,
            success: function (data) {
                contenedorConElNumero.empty();
                contenedorConElNumero.html(data);
            }
        });
    }

    function ifVotado() {
        $.ajax({
            url: '/getVoto/' + idUsuario + '/' + idPregunta,
            method: 'GET',
            async: true,
            success: function (data) {
                if (data > 0) {
                    $('#up').css('color', 'green');
                }
            }
        });
    }

});
