document.addEventListener("DOMContentLoaded", function() {
    // Elementos del DOM
    const registrarBtn = document.getElementById('RegistrarItem');
    const registerForm = document.getElementById('Register');
    const inicioForm = document.getElementById('Listar');
    const modificarForm = document.getElementById('Modificar');
    const inicioBtn = document.getElementById('inicioButton');

    // Evento para volver al inventario
    if (inicioBtn) {
        inicioBtn.addEventListener('click', function() {
            registerForm.style.display = "none";
            inicioForm.style.display = "block";
            modificarForm.style.display = "none";
        });
    }

    // Evento para mostrar el formulario de registro
    if (registrarBtn) {
        registrarBtn.addEventListener('click', function() {
            inicioForm.style.display = "none";
            registerForm.style.display = "block";
            modificarForm.style.display = "none";
        });
    }

    // Evento para mostrar el formulario de edición al hacer clic en "Editar"
    document.addEventListener("click", function(event) {
        if (event.target.name === "Editar") {
            event.preventDefault(); // Evita que el formulario recargue la página

            // Asegurar que los formularios se oculten correctamente
            inicioForm.style.display = "none";
            registerForm.style.display = "none";
            modificarForm.style.display = "block";
        }
    });

    // Mostrar automáticamente el formulario de edición si ya hay datos cargados
    if (modificarForm && modificarForm.innerHTML.trim() !== "") {
        modificarForm.style.display = "block";
    }
});





