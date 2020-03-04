let cambiarbiografia = document.getElementById('boton_cambio');
let formubiografia = document.getElementById('formu_cambio');
let cancelarcambio = document.getElementById('cancelar_cambio');

document.getElementById('divFavoritos').style.display = 'none';
document.getElementById('divRespuestas').style.display = 'none';

if (cambiarbiografia != null) {
    cambiarbiografia.addEventListener("click", function () {
        let old_biografia = document.getElementById('user_biography').innerText;
        cambiarbiografia.style.display = 'none';
        if (old_biografia != 'Sin biografia'){
            document.getElementById('bio').value = old_biografia;
        }
        formubiografia.style.display = 'inline-block';
    });
}

if (cancelarcambio != null) {
    cancelarcambio.addEventListener("click", function () {
        cambiarbiografia.style.display = 'inline-block';
        formubiografia.style.display = 'none';
    });
}

function mostrarRespuestas() {
    document.getElementById('divRespuestas').style.display = 'block';
    document.getElementById('divFavoritos').style.display = 'none';
    document.getElementById('divPreguntas').style.display = 'none';

}

function mostrarFavoritos() {
    document.getElementById('divRespuestas').style.display = 'none';
    document.getElementById('divFavoritos').style.display = 'block';
    document.getElementById('divPreguntas').style.display = 'none';
}

function mostrarPreguntas() {
    document.getElementById('divRespuestas').style.display = 'none';
    document.getElementById('divFavoritos').style.display = 'none';
    document.getElementById('divPreguntas').style.display = 'block';
}



