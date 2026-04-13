<?php
class UsuarioController {

    private $gestor;

    public function __construct($gestor) {
        $this->gestor = $gestor;
    }

    public function alta() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $usuario = new Usuario($email, $passwordHash);

            $resultado = $this->gestor->registrarUsuario($usuario);

            if ($resultado) {
                header("Location: index.php?accion=login");
                exit;
            } else {
                $error = "No se pudo registrar el usuario.";
            }
        }

        include "views/alta.php";
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $usuario = $this->gestor->obtenerUsuarioPorEmail($email);

            if ($usuario && password_verify($password, $usuario->getPassword())) {
                $_SESSION['usuario_id'] = $usuario->getId();
                $_SESSION['usuarioEmail'] = $usuario->getEmail();

                header("Location: index.php");
                exit;
            } else {
                $error = "Credenciales inválidas";
            }
        }

        include "views/login.php";
    }

    public function logout() {
        session_unset();
        session_destroy();

        header("Location: index.php");
        exit;
    }
}