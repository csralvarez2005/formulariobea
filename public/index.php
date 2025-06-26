<?php
require_once __DIR__ . '/../controllers/UsuarioController.php';

$controller = new UsuarioController();

$action = $_GET['action'] ?? 'formulario';
$id = $_GET['id'] ?? null;

switch ($action) {
    case 'guardar':
        $controller->guardar();
        break;
    case 'eliminar':
        $controller->eliminar($id);
        break;
    case 'editar':
        $controller->editar($id);
        break;
    case 'actualizar':
        $controller->actualizar($id);
        break;
    case 'listar':
        $controller->listar();
        break;
    default:
       include __DIR__ . '/formulario_usuario.php';
        break;
}