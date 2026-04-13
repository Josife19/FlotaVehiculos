<?php
require_once "autoload.php";
session_start();

$gestor = new GestorPDO();
$controller = new Controller($gestor);
$usuarioController = new UsuarioController($gestor);

$accion = $_GET['accion'] ?? 'index';

switch ($accion) {

    // Gestión de usuarios
    case 'alta':
        $usuarioController->alta();
        break;

    case 'login':
        $usuarioController->login();
        break;

    case 'logout':
        $usuarioController->logout();
        break;

    // Gestión de vehículos
    case 'agregar':
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: index.php?accion=login");
            exit;
        }
        $controller->agregar();
        break;

    case 'editar':
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: index.php?accion=login");
            exit;
        }
        $controller->editar();
        break;

    case 'eliminar':
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: index.php?accion=login");
            exit;
        }
        $controller->eliminar();
        break;

    default:
        $controller->index();
        break;
}
?>