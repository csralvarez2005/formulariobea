<?php
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../config/Database.php';

class UsuarioRepository {
    private PDO $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    public function existeDocumento(string $documento): bool {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM usuarios WHERE documento = ?");
        $stmt->execute([$documento]);
        return $stmt->fetchColumn() > 0;
    }

    public function guardar(Usuario $usuario): bool {
        $sql = "INSERT INTO usuarios (
                    nombres, tipo_documento, documento, email, celular,
                    barrio, direccion, fecha_nacimiento, nivel_estudios,
                    colegio, etnia, sisben, programa,
                    documento_lado_a, documento_lado_b,
                    acta_bachiller_url, pruebas_icfes, archivo_sisben
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $usuario->nombres,
            $usuario->tipoDocumento,
            $usuario->documento,
            $usuario->email,
            $usuario->celular,
            $usuario->barrio,
            $usuario->direccion,
            $usuario->fechaDeNacimiento,
            $usuario->nivelEstudios,
            $usuario->colegio,
            $usuario->etnia,
            $usuario->sisben,
            $usuario->programa,
            $usuario->documentoLadoA,
            $usuario->documentoLadoB,
            $usuario->actaBachillerUrl,
            $usuario->pruebasIcfes,
            $usuario->archivoSisben 
        ]);
    }

    public function listar(): array {
        $stmt = $this->conn->query("SELECT * FROM usuarios ORDER BY creado_en DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function contarUsuarios(): int {
        $stmt = $this->conn->query("SELECT COUNT(*) as total FROM usuarios");
        return (int) $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

public function listarPaginado(int $limite, int $offset): array {
    $stmt = $this->conn->prepare("
        SELECT id, nombres, documento, celular, email, programa, creado_en,
               documento_lado_a, documento_lado_b, acta_bachiller_url,
               pruebas_icfes, archivo_sisben
        FROM usuarios
        ORDER BY creado_en DESC
        LIMIT ? OFFSET ?
    ");
    $stmt->bindValue(1, $limite, PDO::PARAM_INT);
    $stmt->bindValue(2, $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
    public function obtenerPorId($id) {
    $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
}