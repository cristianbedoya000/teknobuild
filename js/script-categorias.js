document.addEventListener("DOMContentLoaded", () => {
    const enlacesCategorias = document.querySelectorAll(".categorias_menu a");
    const secciones = document.querySelectorAll(".categoria-section");

    function mostrarCategoria(idCategoria) {
        secciones.forEach(seccion => {
            if (seccion.id === idCategoria) {
                seccion.classList.add("activa");
            } else {
                seccion.classList.remove("activa");
            }
        });
    }

    enlacesCategorias.forEach(enlace => {
        enlace.addEventListener("click", function (e) {
            e.preventDefault();
            const idCategoria = this.getAttribute("href").substring(1); // quita el #
            mostrarCategoria(idCategoria);

            // Opcional: desplazarse a la sección
            const seccionActiva = document.getElementById(idCategoria);
            if (seccionActiva) {
                seccionActiva.scrollIntoView({ behavior: "smooth" });
            }
        });
    });

    // Mostrar la primera categoría por defecto al cargar (opcional)
    if (secciones.length > 0) {
        secciones[0].classList.add("activa");
    }
});
