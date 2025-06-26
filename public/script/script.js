 // Calcular edad
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

    // Habilitar o deshabilitar colegio según el nivel de estudios
    document.getElementById('nivelEstudios').addEventListener('change', function () {
        const colegioInput = document.getElementById('colegio');
        if (this.value === 'bachiller') {
            colegioInput.disabled = false;
            colegioInput.required = true;
        } else {
            colegioInput.disabled = true;
            colegioInput.required = false;
            colegioInput.value = '';
        }
    });