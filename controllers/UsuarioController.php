<?php
require_once __DIR__ . '/../services/UsuarioService.php';
require_once __DIR__ . '/../services/CloudinaryService.php';

use Services\CloudinaryService;

class UsuarioController {
    private UsuarioService $service;
    private CloudinaryService $cloudinary;

    public function __construct() {
        $this->service = new UsuarioService();
        $this->cloudinary = new CloudinaryService();
    }

    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;

            // Subir Documento Lado A
            if (isset($_FILES['documentoLadoA']) && $_FILES['documentoLadoA']['error'] === 0) {
                $data['documentoLadoA'] = $this->cloudinary->subirImagen(
                    $_FILES['documentoLadoA']['tmp_name'],
                    'doc_lado_a_' . uniqid()
                );
            } else {
                $data['documentoLadoA'] = '';
            }

            // Subir Documento Lado B
            if (isset($_FILES['documentoLadoB']) && $_FILES['documentoLadoB']['error'] === 0) {
                $data['documentoLadoB'] = $this->cloudinary->subirImagen(
                    $_FILES['documentoLadoB']['tmp_name'],
                    'doc_lado_b_' . uniqid()
                );
            } else {
                $data['documentoLadoB'] = '';
            }

            // Subir Acta de Bachiller y Pruebas ICFES SOLO si:
            // 1. Nivel de estudios es 'bachiller'
            // 2. Colegio no está vacío
            // 3. Se subieron ambos archivos correctamente
            if (
                isset($_POST['nivelEstudios']) &&
                $_POST['nivelEstudios'] === 'bachiller' &&
                !empty($_POST['colegio']) &&
                isset($_FILES['actaBachiller']) && $_FILES['actaBachiller']['error'] === 0 &&
                isset($_FILES['pruebasIcfes']) && $_FILES['pruebasIcfes']['error'] === 0
            ) {
                // Subir acta de bachiller
                $data['actaBachillerUrl'] = $this->cloudinary->subirImagen(
                    $_FILES['actaBachiller']['tmp_name'],
                    'acta_bachiller_' . uniqid()
                );

                // Subir pruebas ICFES
                $data['pruebasIcfes'] = $this->cloudinary->subirImagen(
                    $_FILES['pruebasIcfes']['tmp_name'],
                    'pruebas_icfes_' . uniqid()
                );
            } else {
                $data['actaBachillerUrl'] = '';
                $data['pruebasIcfes'] = '';
            }

            // Crear usuario en la base de datos
            $ok = $this->service->crearUsuario($data);

            if ($ok) {
                header("Location: index.php?mensaje=creado");
            } else {
                header("Location: index.php?mensaje=duplicado");
            }
            exit;
        }
    }

    public function listar() {
        $usuarios = $this->service->listarUsuarios();
        include __DIR__ . '/../public/listar_usuarios.php';
    }
}