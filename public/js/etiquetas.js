$( document ).ready(function() {
    let div = document.getElementById('vacioContainer').style.display = 'none';
    let input = document.getElementById('etiquetas').style.display = 'none';
});

function buscarEtiquetas() {
    let etiqueta = document.getElementById('tag').value;
    $.ajax({
        url: 'create/buscarEtiquetas',
        method: 'POST',
        data: {etiqueta: etiqueta},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            console.log("Succes");
            console.log(data);
            console.log(data.etiqueta)
            if (jQuery.isEmptyObject(data)) {
                mostrarVacio();
            } else
                mostrarEtiquetas(data);
        },
        error: function (data) {
            console.log("Error");
            console.log(data);
        }
    });
}

function mostrarEtiquetas(data) {
    let div = document.getElementById('vacioContainer').style.display = 'none';
    let divEtiquetas = document.getElementById('tag_container');

    divEtiquetas.style.display = 'block';

    console.log('holaaa');
    divEtiquetas.innerHTML= "";
    for (let x = 0; x < data.length; x++) {
        let span = document.createElement('mark');
        span.style.padding = '5px';
        span.style.marginRight = '15px';
        span.addEventListener('click', function () {
            meterEtiqueta(data[x].etiquetas, x)
        });

        let texto = document.createTextNode(data[x].etiquetas);

        span.appendChild(texto);
        divEtiquetas.appendChild(span)
    }

}

function mostrarVacio() {
    let div = document.getElementById('vacioContainer').style.display = 'block';
    let divEtiquetas = document.getElementById('tag_container').style.display = 'none';
    console.log('entro')
}

function meterEtiqueta(etiqueta, id) {
    let divEtiquetas = document.getElementById('tag_container');
    divEtiquetas.innerHTML= "";

    let div = document.getElementById('etiquetas');
    div.style.display = 'block';

    let a = document.createElement('a');
    let textoA = document.createTextNode('X');

    a.style.marginLeft = '5px';
    a.addEventListener('click', function () {
        borrarSpan(id)
    });
    a.appendChild(textoA);

    let span = document.createElement('span');
    span.id = id;

    span.style.backgroundColor = '#1DEEDC';
    span.style.padding = '5px';
    span.style.marginRight = '10px'
    let texto = document.createTextNode(etiqueta);

    span.appendChild(texto);
    span.appendChild(a)

    div.appendChild(span);

    let etiquetas = document.getElementsByTagName("span");
    let input = document.getElementById('tag_block');
    let etiquetasIntroducir = [];
    for (let i = 1; i < etiquetas.length; i++) {
        etiquetasIntroducir.push(etiquetas.item(i).textContent.slice(0,-1))
    }
    input.value = etiquetasIntroducir.join();

    console.log(etiquetasIntroducir.join());
}


function borrarSpan(id) {
    let span = document.getElementById(id);
    span.remove();

    let etiquetas = document.getElementsByTagName("span");
    let input = document.getElementById('tag_block');
    let etiquetasIntroducir = [];
    for (let i = 1; i < etiquetas.length; i++) {
        etiquetasIntroducir.push(etiquetas.item(i).textContent.slice(0,-1))
    }
    input.value = etiquetasIntroducir.join();

    console.log(etiquetasIntroducir.join());
}