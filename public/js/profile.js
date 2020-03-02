let cambiarbiografia = document.getElementById('boton_cambio');
let formubiografia = document.getElementById('formu_cambio');
let cancelarcambio = document.getElementById('cancelar_cambio');

document.getElementById('divFavoritos').style.display = 'none';
document.getElementById('divRespuestas').style.display = 'none';

cambiarbiografia.addEventListener("click", function(){
    cambiarbiografia.style.display = 'none';
    formubiografia.style.display = 'inline-block';
});

cancelarcambio.addEventListener("click", function(){
    cambiarbiografia.style.display = 'inline-block';
    formubiografia.style.display = 'none';
});

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



