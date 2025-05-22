const iniciarBtn=document.getElementById('IniciarSesionButton');
const registrarBtn =document.getElementById('RegistrarseButton');
const loginForm=document.getElementById('Login');
const registerForm=document.getElementById('Register');

registrarBtn.addEventListener('click', function(){
    loginForm.style.display="none";
    registerForm.style.display="block";
})
iniciarBtn.addEventListener('click',function(){
    registerForm.style.display="none";
    loginForm.style.display="block";
})