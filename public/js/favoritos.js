$(document).ready(function () {

    let idUsuario = $('#idUsuario').val();
    let idPregunta = $('#idPregunta').val();
    let favContainer = $('#fav-container');

    let fav = null;

    $.ajax({
        url: '/getFavorito/' + idUsuario + '/' + idPregunta,
        method: 'GET',
        async: false,
        success: function (data) {
            console.log(data);
            fav = data;
        }
    });

    if (fav == "") {
        // boton dar fav
        ponerBoton(1);
    } else {
        // boton quitar fav
        ponerBoton(0)
    }

    /**
     * LLamada a url de dar quitar fav
     * @param url
     */
    function setUnsetFav(url) {
        $.ajax({
            url: url,
            method: 'GET',
            success: function (data) {
                console.log(data);
            }
        });
    }

    /**
     * Poner el boton de quitar o dar fav
     * @param option
     */
    function ponerBoton(option) {
        if (option === 1) {
            favContainer.append('<button class="btn btn-link rounded-circle" id="dar-fav">' +
                ' <i class="far fa-star fa-2x dar-fav"></i>' +
                ' </button>');

            $('#dar-fav').on('click', function () {
                console.log('click');
                setUnsetFav('/setFavorito/' + idUsuario + '/' + idPregunta);
                favContainer.empty();
                ponerBoton(0);
            })
        } else {
            favContainer.append('<button class="btn btn-link rounded-circle" id="quitar-fav">' +
                ' <i class="fas fa-star fa-2x quitar-fav"></i>' +
                ' </button>');
            $('#quitar-fav').on('click', function () {
                console.log('click');
                setUnsetFav('/unsetFavorito/' + idUsuario + '/' + idPregunta);
                favContainer.empty();
                ponerBoton(1);
            })
        }
    }


});
