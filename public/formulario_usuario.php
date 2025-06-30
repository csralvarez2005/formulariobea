<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario Usuario</title>
    <link rel="stylesheet" href="css/estilos.css"> 

</head>
<body>
    <div class="form-container">
        <h2>Crear Usuario</h2>
        <?php if (isset($_GET['mensaje']) && $_GET['mensaje'] === 'creado'): ?>
            <div class="mensaje-exito">¡Guardado con éxito!</div>
        <?php endif; ?>

       <form action="index.php?action=guardar" method="POST" enctype="multipart/form-data">
            <div class="input-row">
                <div class="input-group">
                    <label for="tipoDocumento">Tipo de Documento:</label>
                    <select name="tipoDocumento" required>
                        <option value="">Seleccione...</option>
                        <option value="CC">Cédula de Ciudadanía</option>
                        <option value="TI">Tarjeta de Identidad</option>
                        <option value="CE">Cédula de Extranjería</option>
                        <option value="PP">Pasaporte</option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="documento">Documento:</label>
                    <input type="text" name="documento" required>
                </div>
            </div>

            <div class="input-row">
                <div class="input-group archivo-input">
                    <label for="documentoLadoA">Documento Lado A:</label>
                    <input type="file" name="documentoLadoA" id="documentoLadoA" accept=".jpg,.jpeg,.png,.pdf" onchange="validarArchivo(this)" required>
                    <small>Formatos permitidos: PDF, JPG, PNG. Tamaño máximo: 10MB.</small>
                </div>
                <div class="input-group archivo-input">
                    <label for="documentoLadoB">Documento Lado B:</label>
                    <input type="file" name="documentoLadoB" id="documentoLadoB" accept=".jpg,.jpeg,.png,.pdf" onchange="validarArchivo(this)" required>
                    <small>Formatos permitidos: PDF, JPG, PNG. Tamaño máximo: 10MB.</small>
                </div>
            </div>

            <div class="input-row">
                <div class="input-group">
                    <label for="nombres">Nombres:</label>
                    <input type="text" name="nombres" required>
                </div>
                <div class="input-group">
                    <label for="celular">Celular:</label>
                    <input type="text" name="celular" required>
                </div>
            </div>

            <div class="input-row">
                <div class="input-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email">
                </div>
                <div class="input-group">
                    <label for="etnia">Etnia:</label>
                    <input type="text" name="etnia" id="etnia">
                </div>
            </div>

            <div class="input-row">
                <div class="input-group">
                    <label for="fechaDeNacimiento">Fecha de Nacimiento:</label>
                    <input type="date" name="fechaDeNacimiento" id="fechaDeNacimiento" required>
                </div>
                <div class="input-group">
                    <label for="edad">Edad:</label>
                    <input type="text" id="edad" readonly>
                </div>
            </div>

            <div class="input-row">
                <div class="input-group">
                    <label for="barrio">Barrio:</label>
                    <input type="text" name="barrio">
                </div>
                <div class="input-group">
                    <label for="direccion">Dirección:</label>
                    <input type="text" name="direccion">
                </div>
            </div>

            <div class="input-row">
                <div class="input-group">
                    <label for="nivelEstudios">¿Hasta qué grado llegó?</label>
                    <select name="nivelEstudios" id="nivelEstudios" required>
                        <option value="">Seleccione...</option>
                        <option value="5_primaria">5° de Primaria</option>
                        <option value="6_bachillerato">6° de Bachillerato</option>
                        <option value="7_bachillerato">7° de Bachillerato</option>
                        <option value="8_bachillerato">8° de Bachillerato</option>
                        <option value="9_bachillerato">9° de Bachillerato</option>
                        <option value="10_bachillerato">10° de Bachillerato</option>
                        <option value="11_bachillerato">11° de Bachillerato</option>
                        <option value="bachiller">Bachiller</option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="colegio_bachiller">Colegio (si es Bachiller):</label>
                    <input type="text" name="colegio" id="colegio_bachiller" disabled>
                </div>
            </div>

            <div class="input-row" id="row-acta" style="display: none;">
                <div class="input-group archivo-input">
                    <label for="actaBachiller">Adjunta Acta de Bachiller o Diploma:</label>
                    <input type="file" name="actaBachiller" id="actaBachiller" accept=".jpg,.jpeg,.png,.pdf" onchange="validarArchivo(this)">
                    <small>Formatos permitidos: PDF, JPG, PNG. Tamaño máximo: 10MB.</small>
                </div>
                <div class="input-group archivo-input">
                    <label for="pruebasIcfes">Adjunta Resultado ICFES:</label>
                    <input type="file" name="pruebasIcfes" id="pruebasIcfes" accept=".jpg,.jpeg,.png,.pdf" onchange="validarArchivo(this)">
                    <small>Formatos permitidos: PDF, JPG, PNG. Tamaño máximo: 10MB.</small>
                </div>
            </div>

            <div class="input-row">
                <div class="input-group">
                    <label for="sisben">¿Tiene SISBEN?</label>
                    <select name="sisben" id="sisben" required>
                        <option value="">Seleccione...</option>
                        <option value="si">Sí</option>
                        <option value="no">No</option>
                    </select>
                </div>
                <div class="input-group archivo-input" id="archivo-sisben" style="display: none;">
                    <label for="archivoSisben">Adjunte archivo del SISBEN:</label>
                    <input type="file" name="archivoSisben" id="archivoSisben" accept=".jpg,.jpeg,.png,.pdf" onchange="validarArchivo(this)">
                    <small>Formatos permitidos: PDF, JPG, PNG. Tamaño máximo: 10MB.</small>
                </div>
                <div class="input-group">
                    <label for="programa">Programa:</label>
                 <select id="programa" name="programa" class="form-control" required>
                 <option value="">Seleccione un programa</option>
                <option value="T.L en Auxiliar de Enfermería.">T.L en Auxiliar de Enfermería.</option>
    <option value="T.L en Auxiliar de Servicios Farmacéuticos.">T.L en Auxiliar de Servicios Farmacéuticos.</option>
    <option value="T.L en administración en salud.">T.L en administración en salud.</option>
    <option value="T.L en Auxiliar de Clínica Veterinaria.">T.L en Auxiliar de Clínica Veterinaria.</option>
    <option value="T.L en Auxiliar de Salud Oral.">T.L en Auxiliar de Salud Oral.</option>
    <option value="T.L en Mecánica Dental.">T.L en Mecánica Dental.</option>
    <option value="T.L en Servicios Deportivos y de Recreación.">T.L en Servicios Deportivos y de Recreación.</option>
    <option value="T.L en Cosmetología y Estética Integral.">T.L en Cosmetología y Estética Integral.</option>
    <option value="T.L en Estética y Peluquería.">T.L en Estética y Peluquería.</option>
    <option value="T.L en Diseño de Modas">T.L Diseño de modas</option>
    <option value="T.L en Agente de Viajes y Turismo.">T.L en Agente de Viajes y Turismo.</option>
    <option value="T.L en Recepción Hotelera.">T.L en Recepción Hotelera.</option>
    <option value="T.L en Mesa y Bar.">T.L en Mesa y Bar.</option>
    <option value="T.L en Repostería y Panadería">T.L en Repostería y Panadería</option>
    <option value="T.L en Cocina Nacional e Internacional.">T.L en Cocina Nacional e Internacional.</option>
    <option value="T.L en Auxiliar de Vuelo y Sobrecargo.">T.L en Auxiliar de Vuelo y Sobrecargo.</option>
    <option value="T.L en Almacén y Bodega">T.L en Almacén y Bodega</option>
    <option value="T.L en Operador de Montacargas.">T.L en Operador de Montacargas.</option>
    <option value="T.L en Auxiliar Administrativo de Operaciones Portuarias.">T.L en Auxiliar Administrativo de Operaciones Portuarias.</option>
    <option value="T.L en Auxiliar de Logística y Transporte.">T.L en Auxiliar de Logística y Transporte.</option>
    <option value="T.L en Auxiliar de Comercio Internacional.">T.L en Auxiliar de Comercio Internacional.</option>
    <option value="T.L en Auxiliar Contable y Financiero.">T.L en Auxiliar Contable y Financiero.</option>
    <option value="T.L en Auxiliar Administrativo.">T.L en Auxiliar Administrativo.</option>
    <option value="T.L en Auxiliar de Talento Humano.">T.L en Auxiliar de Talento Humano.</option>
    <option value="T.L en Mecánica Diesel.">T.L en Mecánica Diesel.</option>
    <option value="T.L en Mercadeo y Ventas con Énfasis en Marketing Digital.">T.L en Mercadeo y Ventas con Énfasis en Marketing Digital.</option>
    <option value="T.L en Construcción y Obras Civiles.">T.L en Construcción y Obras Civiles.</option>
    <option value="T.L en Mecánica Industrial.">T.L en Mecánica Industrial.</option>
    <option value="T.L en Electricidad Industrial.">T.L en Electricidad Industrial.</option>
    <option value="T.L en Soldadura.">T.L en Soldadura.</option>
    <option value="T.L en Refrigeración de Aires Acondicionados.">T.L en Refrigeración de Aires Acondicionados.</option>
    <option value="T.L en Seguridad Industrial.">T.L en Seguridad Industrial.</option>
    <option value="T.L en Seguridad Ocupacional.">T.L en Seguridad Ocupacional.</option>
    <option value="T.L en Asistencia a la Primera Infancia.">T.L en Asistencia a la Primera Infancia.</option>
    <option value="T.L en Asistencia en servicios Sociales y Comunitario.">T.L en Asistencia en servicios Sociales y Comunitario.</option>
    <option value="T.L en Sistemas.">T.L en Sistemas.</option>
    <option value="T.L en Electrónica y Mantenimiento de Computadoras.">T.L en Electrónica y Mantenimiento de Computadoras.</option>
    <option value="T.L en Auxiliar Judicial y Criminalística.">T.L en Auxiliar Judicial y Criminalística.</option>
    <option value="T.L en Auxiliar Jurídico y de Tribunales.">T.L en Auxiliar Jurídico y de Tribunales.</option>
    <option value="T.L en Locución para Radio y Tv.">T.L en Locución para Radio y Tv.</option>
    <option value="T.L en Diseño Grafico y Artes graficas.">T.L en Diseño Grafico y Artes graficas.</option>
    <option value="T.L en Lengua Inglesa.">T.L en Lengua Inglesa.</option>
    <option value="T.L en Producción de Audio Digital.">T.L en Producción de Audio Digital.</option>
    <option value="T.L en Maquinaria Pesada.">T.L en Maquinaria Pesada.</option>
    <option value="T.L en Saneamiento Ambiental.">T.L en Saneamiento Ambiental.</option>
                   </select>
                </div>
            </div>

            <button type="submit">Guardar</button>
        </form>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script src="script/script.js"></script>
</html>