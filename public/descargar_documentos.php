<?php
require_once __DIR__ . '/../repositories/UsuarioRepository.php';

$usuarioRepo = new UsuarioRepository();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuarioId = $_POST['usuario_id'] ?? null;
    $usuarioNombre = $_POST['usuario_nombre'] ?? 'usuario';

    if (!$usuarioId) {
        die("ID de usuario no proporcionado.");
    }

    $usuario = $usuarioRepo->obtenerPorId($usuarioId);

    if (!$usuario) {
        die("Usuario no encontrado.");
    }

    // Documentos posibles
    $documentos = [
        'documento_lado_a'     => $usuario['documento_lado_a'],
        'documento_lado_b'     => $usuario['documento_lado_b'],
        'acta_bachiller_url'   => $usuario['acta_bachiller_url'],
        'pruebas_icfes'        => $usuario['pruebas_icfes'],
        'archivo_sisben'       => $usuario['archivo_sisben']
    ];

    $archivosValidos = [];

    // Descargar documentos (remotos o locales)
    foreach ($documentos as $clave => $url) {
        if (!empty($url)) {
            $nombreArchivo = basename(parse_url($url, PHP_URL_PATH));

            // Intentar descargar el archivo remoto o local
            $contenido = @file_get_contents($url);

            if ($contenido !== false) {
                $rutaTemporal = sys_get_temp_dir() . '/' . uniqid('doc_', true) . '_' . $nombreArchivo;
                file_put_contents($rutaTemporal, $contenido);
                $archivosValidos[$nombreArchivo] = $rutaTemporal;
            }
        }
    }

    if (empty($archivosValidos)) {
        die("No se encontraron documentos para este usuario.");
    }

    // Crear ZIP
    $usuarioCarpeta = preg_replace('/[^a-zA-Z0-9_-]/', '_', $usuarioNombre);
    $zipNombre = "documentos_" . $usuarioCarpeta . ".zip";
    $zipRuta = sys_get_temp_dir() . '/' . uniqid('zip_', true) . '_' . $zipNombre;

    $zip = new ZipArchive();
    if ($zip->open($zipRuta, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
        die("No se pudo crear el archivo ZIP.");
    }

    foreach ($archivosValidos as $nombre => $rutaArchivo) {
        $zip->addFile($rutaArchivo, $usuarioCarpeta . '/' . $nombre);
    }

    $zip->close();

    // Enviar ZIP al navegador
    header('Content-Type: application/zip');
    header('Content-Disposition: attachment; filename="' . $zipNombre . '"');
    header('Content-Length: ' . filesize($zipRuta));
    readfile($zipRuta);

    // Limpiar archivos temporales
    foreach ($archivosValidos as $ruta) {
        @unlink($ruta);
    }
    @unlink($zipRuta);

    exit;
} else {
    die("Acceso no permitido.");
}