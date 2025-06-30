// Inicializar Select2 con lógica personalizada
$(document).ready(function () {
    $('#programa').select2({
        placeholder: "Selecciona un programa",
        minimumResultsForSearch: 0, // siempre mostrar la barra de búsqueda
        matcher: function (params, data) {
            if ($.trim(params.term) === '') {
                return data; // mostrar los primeros 5 si no hay término
            }
            if (data.text.toLowerCase().indexOf(params.term.toLowerCase()) > -1) {
                return data;
            }
            return null;
        }
    });

   // Inicializar Select2 con búsqueda habilitada
$(document).ready(function () {
    $('#programa').select2({
        placeholder: "Selecciona un programa",
        minimumResultsForSearch: 0, // muestra barra de búsqueda siempre
        width: '100%'
    });
});
});

// Calcular edad automáticamente
document.getElementById('fechaDeNacimiento').addEventListener('change', function () {
    const fechaNacimiento = new Date(this.value);
    const hoy = new Date();
    let edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
    const mes = hoy.getMonth() - fechaNacimiento.getMonth();

    if (mes < 0 || (mes === 0 && hoy.getDate() < fechaNacimiento.getDate())) {
        edad--;
    }

    document.getElementById('edad').value = isNaN(edad) ? '' : edad + ' años';
});

// Lógica para mostrar campo "Colegio" y archivo solo si es bachiller y se ingresó colegio
document.addEventListener("DOMContentLoaded", function () {
    const nivelSelect = document.getElementById("nivelEstudios");
    const colegioInput = document.getElementById("colegio_bachiller");
    const rowActa = document.getElementById("row-acta");

    function actualizarVisibilidadActa() {
        const esBachiller = nivelSelect.value === "bachiller";
        const colegioLleno = colegioInput.value.trim().length > 0;

        colegioInput.disabled = !esBachiller;
        colegioInput.required = esBachiller;

        rowActa.style.display = (esBachiller && colegioLleno) ? "flex" : "none";
    }

    nivelSelect.addEventListener("change", actualizarVisibilidadActa);
    colegioInput.addEventListener("input", actualizarVisibilidadActa);

    actualizarVisibilidadActa(); // ejecutar al cargar
});

// Validación de archivo (opcional)
function validarArchivo(input) {
    const file = input.files[0];
    if (!file) return;

    const maxSizeMB = 10;
    const extensionesPermitidas = ['pdf', 'jpg', 'jpeg', 'png'];
    const extension = file.name.split('.').pop().toLowerCase();

    if (!extensionesPermitidas.includes(extension)) {
        alert('Formato no permitido. Solo se permiten PDF, JPG, JPEG, PNG.');
        input.value = '';
        return;
    }

    if (file.size > maxSizeMB * 1024 * 1024) {
        alert('El archivo supera los 10MB permitidos.');
        input.value = '';
        return;
    }
}

// Mostrar campo archivo SISBEN si selecciona "sí"
document.addEventListener("DOMContentLoaded", function () {
    const sisbenSelect = document.getElementById("sisben");
    const archivoSisben = document.getElementById("archivo-sisben");

    sisbenSelect.addEventListener("change", function () {
        if (sisbenSelect.value === "si") {
            archivoSisben.style.display = "flex";
        } else {
            archivoSisben.style.display = "none";
            const inputFile = archivoSisben.querySelector('input[type="file"]');
            inputFile.value = '';
        }
    });
});

