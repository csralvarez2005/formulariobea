document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const fechaNacimientoInput = document.getElementById('fechaDeNacimiento');
    const edadInput = document.getElementById('edad');
    const nivelSelect = document.getElementById('nivelEstudios');
    const colegioInput = document.getElementById('colegio_bachiller');
    const rowActa = document.getElementById('row-acta');
    const sisbenSelect = document.getElementById("sisben");
    const archivoSisben = document.getElementById("archivo-sisben");

    // Envío del formulario con spinner
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        Swal.fire({
            title: 'Guardando información...',
            html: `
                <div style="display: flex; justify-content: center; align-items: center; flex-direction: column;">
                    <div class="spinner" style="margin-bottom: 10px;"></div>
                    <p>Por favor espera</p>
                </div>
            `,
            allowOutsideClick: false,
            showConfirmButton: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        const formData = new FormData(form);

        fetch(form.action, {
            method: form.method,
            body: formData
        })
        .then(response => response.text())
        .then(() => {
            Swal.close();
            Swal.fire({
                icon: 'success',
                title: 'Guardado correctamente',
                text: 'La información ha sido registrada con éxito.',
                confirmButtonText: 'Aceptar'
            }).then(() => {
                window.location.href = 'index.php?mensaje=creado';
            });
        })
        .catch(() => {
            Swal.close();
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Ocurrió un problema al guardar. Intenta nuevamente.',
                confirmButtonText: 'Aceptar'
            });
        });
    });

    // Calcular edad automáticamente
    fechaNacimientoInput.addEventListener('change', function () {
        const fechaNacimiento = new Date(this.value);
        const hoy = new Date();
        let edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
        const mes = hoy.getMonth() - fechaNacimiento.getMonth();

        if (mes < 0 || (mes === 0 && hoy.getDate() < fechaNacimiento.getDate())) {
            edad--;
        }

        edadInput.value = isNaN(edad) ? '' : edad + ' años';
    });

    // Mostrar campo "Colegio" y archivos si es bachiller
    function actualizarVisibilidadActa() {
        const esBachiller = nivelSelect.value === "bachiller";
        const colegioLleno = colegioInput.value.trim().length > 0;

        colegioInput.disabled = !esBachiller;
        colegioInput.required = esBachiller;
        rowActa.style.display = (esBachiller && colegioLleno) ? "flex" : "none";
    }

    nivelSelect.addEventListener("change", actualizarVisibilidadActa);
    colegioInput.addEventListener("input", actualizarVisibilidadActa);
    actualizarVisibilidadActa(); // Al cargar

    // Mostrar campo archivo SISBEN si selecciona "sí"
    sisbenSelect.addEventListener("change", function () {
        if (this.value === "si") {
            archivoSisben.style.display = "flex";
        } else {
            archivoSisben.style.display = "none";
            const inputFile = archivoSisben.querySelector('input[type="file"]');
            if (inputFile) inputFile.value = '';
        }
    });

    // Inicializar Select2
    $('#programa').select2({
        placeholder: "Selecciona un programa",
        minimumResultsForSearch: 0,
        width: '100%',
        matcher: function (params, data) {
            if ($.trim(params.term) === '') {
                return data;
            }
            if (data.text.toLowerCase().includes(params.term.toLowerCase())) {
                return data;
            }
            return null;
        }
    });
});

// Validación de archivo
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


