// Función para mostrar el formulario de registro de feeds
function mostrarForms() {
    document.getElementById("agregarFeed").style.display = "block";
}

// Función para ocultar el formulario de registro de feeds
function ocultarConfirmacion() {
    document.getElementById("agregarFeed").style.display = "none";
}

function mostrarLista() {
    document.getElementById('listaDesplegable').classList.toggle('visible');
}

window.onload = () => {
    document.getElementById('btn_ordenar').addEventListener('click', toggleLista);
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


        alert("Feed agregado exitosamente");
        // Oculta el formulario después de realizar la acción
        ocultarConfirmacion();
    });
}