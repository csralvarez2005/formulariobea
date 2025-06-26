<?php
require_once __DIR__ . '/../services/UsuarioService.php';

class UsuarioController {
    private UsuarioService $service;

    public function __construct() {
        $this->service = new UsuarioService();
    }

    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $data['eresBachiller'] = isset($data['eresBachiller']) ? 1 : 0;

            $ok = $this->service->crearUsuario($data);

            if ($ok) {
                header("Location: index.php?mensaje=creado");
            } else {
                header("Location: index.php?mensaje=error");
            }
            exit;
        }
    }

    public function listar() {
        $usuarios = $this->service->listarUsuarios();
        include __DIR__ . '/../public/listar_usuarios.php';
    }
}