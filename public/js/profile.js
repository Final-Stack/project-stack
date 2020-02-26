let cambiarbiografia = document.getElementById('boton_cambio');
let formubiografia = document.getElementById('formu_cambio');
let cancelarcambio = document.getElementById('cancelar_cambio');

cambiarbiografia.addEventListener("click", function(){
    cambiarbiografia.style.display = 'none';
    formubiografia.style.display = 'inline-block';
});

cancelarcambio.addEventListener("click", function(){
    cambiarbiografia.style.display = 'inline-block';
    formubiografia.style.display = 'none';
});
