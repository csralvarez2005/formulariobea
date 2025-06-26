<?php
class Database {
    public static function getConnection(): PDO {
        return new PDO('mysql:host=localhost;dbname=becas_EBA', 'root', 'Csr73203440**');
    }
}