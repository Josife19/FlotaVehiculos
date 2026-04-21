<?php
class Controller
{
    protected $gestor;

    public function __construct($gestor)
    {
        $this->gestor = $gestor;
    }

    public function index()
    {
        $vehiculos = $this->gestor->listar();
        include "views/listar.php";
    }

    public function agregar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $marca = trim($_POST['marca'] ?? '');
            $modelo = trim($_POST['modelo'] ?? '');
            $precioDia = trim($_POST['precioDia'] ?? '');

            if ($marca === '' || $modelo === '' || $precioDia === '') {
                $error = "Todos los campos son obligatorios.";
            } else {
                $vehiculo = new Vehiculo($marca, $modelo, $precioDia);
                $this->gestor->agregar($vehiculo);

                header("Location: index.php");
                exit;
            }
        }

        include "views/agregar.php";
    }

    public function eliminar()
    {
        if (isset($_GET['id'])) {
            $id = (int) $_GET['id'];
            $this->gestor->eliminar($id);
        }

        header("Location: index.php");
        exit;
    }

    public function editar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int) ($_POST['id'] ?? 0);
            $marca = trim($_POST['marca'] ?? '');

            if ($id > 0 && $marca !== '') {
                $this->gestor->editar($id, $marca);
            }

            header("Location: index.php");
            exit;
        }
    }
}