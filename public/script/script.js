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