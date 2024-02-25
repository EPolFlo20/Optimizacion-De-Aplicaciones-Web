// Función para mostrar el formulario de confirmación
function mostrarForms() {
    document.getElementById("agregarFeed").style.display = "block";
}

// Función para ocultar el formulario de confirmación
function ocultarConfirmacion() {
    document.getElementById("agregarFeed").style.display = "none";
}

window.onload = () => {
    // Función para realizar la acción después de confirmar
    document.getElementById("FormFeed").addEventListener("submit", function (event) {
        // Prevenir el comportamiento predeterminado del formulario (enviar los datos y recargar la página)
        event.preventDefault();

        // Obtener los datos del formulario
        const formData = new FormData(this);

        // Enviar los datos del formulario al script PHP utilizando AJAX
        fetch('../php/registrarFeed.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.text())
            .then(data => {
                console.log(data); // Muestra la respuesta del servidor en la consola
            })
            .catch(error => {
                console.error('Error:', error);
            });


        alert("Acción realizada");
        // Oculta el formulario después de realizar la acción
        ocultarConfirmacion();
    });
}