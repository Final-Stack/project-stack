let fotoperfil = document.getElementById('profile_img');
let idusuario = document.getElementById('user_id').value;

fotoperfil.addEventListener("click", function(){
    window.location.href = "/user/" + idusuario;
});
