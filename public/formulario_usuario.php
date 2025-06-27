<?php if (isset($_GET['mensaje']) && $_GET['mensaje'] === 'duplicado'): ?>
    <div class="mensaje-error">¡El documento ya está registrado!</div>
<?php endif; ?>
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
                    <input 
                        type="file" 
                        name="documentoLadoA" 
                        id="documentoLadoA" 
                        accept=".jpg,.jpeg,.png,.pdf"
                        onchange="validarArchivo(this)"
                        required>
                    <small>Formatos permitidos: PDF, JPG, PNG. Tamaño máximo: 10MB.</small>
                </div>
                <div class="input-group archivo-input">
                    <label for="documentoLadoB">Documento Lado B:</label>
                    <input 
                        type="file" 
                        name="documentoLadoB" 
                        id="documentoLadoB" 
                        accept=".jpg,.jpeg,.png,.pdf"
                        onchange="validarArchivo(this)"
                        required>
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
                    <input 
                        type="file" 
                        name="actaBachiller" 
                        id="actaBachiller" 
                        accept=".jpg,.jpeg,.png,.pdf"
                        onchange="validarArchivo(this)">
                    <small>Formatos permitidos: PDF, JPG, PNG. Tamaño máximo: 10MB.</small>
                </div>
                    <div class="input-group archivo-input">
        <label for="pruebasIcfes">Adjunta Resultado ICFES:</label>
        <input 
            type="file" 
            name="pruebasIcfes" 
            id="pruebasIcfes" 
            accept=".jpg,.jpeg,.png,.pdf"
            onchange="validarArchivo(this)">
        <small>Formatos permitidos: PDF, JPG, PNG. Tamaño máximo: 10MB.</small>
    </div>
            </div>

            <div class="input-row">
                <div class="input-group">
                    <label for="sisben">SISBEN:</label>
                    <input type="text" name="sisben">
                </div>
                <div class="input-group">
                    <label for="programa">Programa:</label>
                    <input type="text" name="programa">
                </div>
            </div>

            <button type="submit">Guardar</button>
        </form>
    </div>
</body>
<script src="script/script.js"></script>
</html>