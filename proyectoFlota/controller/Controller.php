<?php
class Controller{
    protected $gestor;

    public function __construct($gestor){
        $this->gestor=$gestor;
    }

    public function index(){
        $vehiculos=$this->gestor->listar();
        include "views/listar.php";
    }

    public function agregar(){
        if($_SERVER['REQUEST_METHOD'] ==='POST'){
            $vehiculo = new Vehiculo($_POST['marca'], $_POST['modelo'], $_POST['precioDia']);
            $this->gestor->agregar($vehiculo);

            header ("Location: index.php");
            exit;
        }
        include "views/agregar.php";
    }

    public function eliminar(){
        $id = $_GET['id'];
        $this->gestor->eliminar($id);

        header ("Location: index.php");
        exit;
    }

    public function editar(){
        if($_SERVER['REQUEST_METHOD'] ==='POST'){
            $this->gestor->editar($_POST['id'], $_POST['marca']);
            header("Location: index.php");
            exit;
        }
    }
}
