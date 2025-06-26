<?php
class Usuario {
    public string $nombres;
    public string $tipoDocumento;
    public string $documento;
    public string $email;
    public string $celular;
    public string $barrio;
    public string $direccion;
    public string $fechaDeNacimiento;
    public string $nivelEstudios; 
    public string $colegio;
    public string $etnia;
    public string $sisben;
    public string $programa;

    public function __construct(array $data = []) {
        $this->nombres = $data['nombres'] ?? '';
        $this->tipoDocumento = $data['tipoDocumento'] ?? '';
        $this->documento = $data['documento'] ?? '';
        $this->email = $data['email'] ?? '';
        $this->celular = $data['celular'] ?? '';
        $this->barrio = $data['barrio'] ?? '';
        $this->direccion = $data['direccion'] ?? '';
        $this->fechaDeNacimiento = $data['fechaDeNacimiento'] ?? '';
        $this->nivelEstudios = $data['nivelEstudios'] ?? '';
        $this->colegio = $data['colegio'] ?? '';
        $this->etnia = $data['etnia'] ?? '';
        $this->sisben = $data['sisben'] ?? '';
        $this->programa = $data['programa'] ?? '';
    }
}