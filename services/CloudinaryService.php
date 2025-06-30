<?php
namespace Services;

require_once __DIR__ . '/../vendor/autoload.php';

use Cloudinary\Cloudinary;

class CloudinaryService {
    private Cloudinary $cloudinary;

    public function __construct() {
        $this->cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => 'djiozcypa',
                'api_key'    => '142785573696928',
                'api_secret' => 'u66OM3wQPJX54z494IpfIgVIKAo'
            ],
            'url' => [
                'secure' => true
            ]
        ]);
    }

    public function subirArchivo(array $archivo, string $nombrePublico): ?string {
        if (!isset($archivo['tmp_name']) || $archivo['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        // Obtener la extensión original
        $extension = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));

        // Determinar el tipo de recurso según la extensión
        $tipoRecurso = match ($extension) {
            'jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp' => 'image',
            'pdf', 'doc', 'docx', 'xls', 'xlsx', 'txt', 'zip' => 'raw',
            default => 'auto'
        };

        // Crear el nombre público sin duplicar la extensión final en Cloudinary
        $publicIdSinExtension = 'documentos/' . $nombrePublico;

        try {
            $resultado = $this->cloudinary->uploadApi()->upload($archivo['tmp_name'], [
                'resource_type'     => $tipoRecurso,
                'public_id'         => $publicIdSinExtension,
                'format'            => $extension, // Forzar la extensión correcta
                'use_filename'      => false,
                'unique_filename'   => false,
                'overwrite'         => true
            ]);

            return $resultado['secure_url'] ?? null;

        } catch (\Exception $e) {
            error_log("❌ Error al subir archivo a Cloudinary: " . $e->getMessage());
            return null;
        }
    }
}