<?php
require_once "autoload.php";
session_start();

$gestor = new GestorPDO();
$controller = new Controller($gestor);
$usuarioController = new UsuarioController($gestor);

$accion = $_GET['accion'] ?? 'index';

if (!isset($_SESSION['usuario_id']) && isset($_COOKIE['usuario_login'])) {
    $emailRecuperado = base64_decode($_COOKIE['usuario_login'], true);

    if ($emailRecuperado !== false) {
        $usuario = $gestor->buscarUsuarioPorEmail($emailRecuperado);

        if ($usuario) {
            $_SESSION['usuario_id'] = $usuario->getId();
            $_SESSION['usuarioEmail'] = $usuario->getEmail();
        } else {
            setcookie('usuario_login', '', time() - 3600, '/');
        }
    } else {
        setcookie('usuario_login', '', time() - 3600, '/');
    }
}

switch ($accion) {
    case 'alta':
        $usuarioController->alta();
        break;

    case 'login':
        $usuarioController->login();
        break;

    case 'logout':
        $usuarioController->logout();
        break;

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