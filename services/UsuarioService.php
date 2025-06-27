<?php
require_once __DIR__ . '/../repositories/UsuarioRepository.php';

class UsuarioService {
    private UsuarioRepository $repo;

    public function __construct() {
        $this->repo = new UsuarioRepository();
    }

 public function crearUsuario(array $data): bool {
    $repo = new UsuarioRepository();

    // Verificar si el documento ya existe
    if ($repo->existeDocumento($data['documento'])) {
        return false; // Ya existe, evita el guardado
    }

    $usuario = new Usuario($data);
    return $repo->guardar($usuario);
}

    public function listarUsuarios(): array {
        return $this->repo->listar();
    }
}
