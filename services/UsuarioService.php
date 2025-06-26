<?php
require_once __DIR__ . '/../repositories/UsuarioRepository.php';

class UsuarioService {
    private UsuarioRepository $repo;

    public function __construct() {
        $this->repo = new UsuarioRepository();
    }

    public function crearUsuario(array $data): bool {
        $usuario = new Usuario($data);
        return $this->repo->guardar($usuario);
    }

    public function listarUsuarios(): array {
        return $this->repo->listar();
    }
}
