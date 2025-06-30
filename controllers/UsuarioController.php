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
                $data['documentoLadoA'] = $this->cloudinary->subirArchivo(
                    $_FILES['documentoLadoA'],
                    'doc_lado_a_' . uniqid()
                );
            } else {
                $data['documentoLadoA'] = '';
            }

            // Subir Documento Lado B
            if (isset($_FILES['documentoLadoB']) && $_FILES['documentoLadoB']['error'] === 0) {
                $data['documentoLadoB'] = $this->cloudinary->subirArchivo(
                    $_FILES['documentoLadoB'],
                    'doc_lado_b_' . uniqid()
                );
            } else {
                $data['documentoLadoB'] = '';
            }

            // Subir Acta de Bachiller y Pruebas ICFES si corresponde
            if (
                isset($_POST['nivelEstudios']) &&
                $_POST['nivelEstudios'] === 'bachiller' &&
                !empty($_POST['colegio']) &&
                isset($_FILES['actaBachiller']) && $_FILES['actaBachiller']['error'] === 0 &&
                isset($_FILES['pruebasIcfes']) && $_FILES['pruebasIcfes']['error'] === 0
            ) {
                $data['actaBachillerUrl'] = $this->cloudinary->subirArchivo(
                    $_FILES['actaBachiller'],
                    'acta_bachiller_' . uniqid()
                );

                $data['pruebasIcfes'] = $this->cloudinary->subirArchivo(
                    $_FILES['pruebasIcfes'],
                    'pruebas_icfes_' . uniqid()
                );
            } else {
                $data['actaBachillerUrl'] = '';
                $data['pruebasIcfes'] = '';
            }

            // Subir archivo del SISBEN si el usuario seleccionó "sí"
            if (
                isset($_POST['sisben']) &&
                strtolower($_POST['sisben']) === 'si' &&
                isset($_FILES['archivoSisben']) && $_FILES['archivoSisben']['error'] === 0
            ) {
                $data['archivoSisben'] = $this->cloudinary->subirArchivo(
                    $_FILES['archivoSisben'],
                    'sisben_' . uniqid()
                );
            } else {
                $data['archivoSisben'] = '';
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