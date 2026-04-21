<?php
class UsuarioController
{
    private $gestor;

    public function __construct($gestor)
    {
        $this->gestor = $gestor;
    }

    public function alta()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                $error = "Debes rellenar todos los campos.";
            } else {
                $usuarioExistente = $this->gestor->buscarUsuarioPorEmail($email);

                if ($usuarioExistente) {
                    $error = "Ya existe un usuario con ese email.";
                } else {
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
            }
        }

        include "views/alta.php";
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $recordar = isset($_POST['recordarme']);

            if (empty($email) || empty($password)) {
                $error = "Debes introducir email y contraseña.";
            } else {
                $usuario = $this->gestor->buscarUsuarioPorEmail($email);

                if ($usuario && password_verify($password, $usuario->getPassword())) {
                    $_SESSION['usuario_id'] = $usuario->getId();
                    $_SESSION['usuarioEmail'] = $usuario->getEmail();

                    if ($recordar) {
                        $token = base64_encode($usuario->getEmail());

                        setcookie(
                            "usuario_login",
                            $token,
                            [
                                'expires' => time() + (86400 * 7),
                                'path' => '/',
                                'httponly' => true,
                                'samesite' => 'Strict'
                            ]
                        );
                    }

                    header("Location: index.php");
                    exit;
                } else {
                    $error = "Email o contraseña incorrectos.";
                }
            }
        }

        include "views/login.php";
    }

    public function logout()
    {
        $_SESSION = [];

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        session_destroy();

        if (isset($_COOKIE['usuario_login'])) {
            setcookie('usuario_login', '', time() - 3600, '/');
        }

        header("Location: index.php?accion=login");
        exit;
    }
}
?>