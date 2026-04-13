<?php
class Vehiculo{
    protected $id;
    protected $marca;
    protected $modelo;
    protected $precioDia;

    function __construct($marca, $modelo, $precioDia, $id=0){
        $this->id = $id;
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->precioDia = $precioDia;
    }

    public function getId(){ return $this->id; }
    public function getMarca(){ return $this->marca; }
    public function getModelo(){ return $this->modelo; }
    public function getPrecioDia(){ return $this->precioDia; }
}
