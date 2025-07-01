<?php
class Database {
    public static function getConnection(): PDO {
        return new PDO(
            'mysql:host=localhost;dbname=becas_EBA;charset=utf8mb4',
            'root',
            'Csr73203440**', // ← Cambia si tienes otra contraseña
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]
        );
    }
}