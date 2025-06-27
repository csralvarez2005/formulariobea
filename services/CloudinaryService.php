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

 public function subirImagen(string $rutaTemporal, string $nombrePublico): ?string {
    try {
        $resultado = $this->cloudinary->uploadApi()->upload($rutaTemporal, [
            'public_id'     => $nombrePublico,
            'folder'        => 'documentos',
            'resource_type' => 'auto' 
        ]);
        return $resultado['secure_url'];
    } catch (\Exception $e) {
        error_log("Error al subir archivo a Cloudinary: " . $e->getMessage());
        return null;
    }
}
}