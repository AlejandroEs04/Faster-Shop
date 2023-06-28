<?php

namespace Controllers;
use Classes\Email;
use Model\Usuarios;
use MVC\Router;

class AuthController {
    public static function login(Router $router) {
        $errores = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuarios($_POST['usuario']);

            $errores = $auth->validarLogin();

            if(empty($errores)) {
                // Comprobar que exista el usuario 
                $usuario = Usuarios::whereArray('email', $auth->email);

                if($usuario) {
                    // Verificar el password
                    if($usuario->comprobarPasswordAndVerificado($auth->password)) {
                        session_start();

                        $_SESSION['idOriginal'] = $usuario->id;

                        $usuario->id = hash('md5', $usuario->id);
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['name'] = $usuario->name;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['admin'] = $usuario->admin;
                        $_SESSION['login'] = True;

                        

                        // Redireccionamiento
                        if($usuario->admin === '1') {
                            header('Location: /admin');
                        } else {
                            header('Location: /usuario?id=' . $usuario->id);
                        }
                    }
                } else {
                    Usuarios::setAlerta('error', 'El usuario no existe');
                }
            }
        }

        $errores = Usuarios::getAlertas();

        $router->render('auth/inicio-sesion', [
            'errores' => $errores
        ]);
    }

    public static function createAccount(Router $router) {

        $usuario = new Usuarios($_POST['usuario']);

        // Alertas vacias
        $errores = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sincronizar
            $usuario->sincronizar($_POST);
            $errores = $usuario->validarNuevaCuenta();

            // Revisar que no haya errores
            if(empty($errores)) {
                // Verificar que el usuario no este registrado
                $resultado = $usuario->existeUsuario();

                if($resultado->num_rows) {
                    $errores = Usuarios::getErrores();
                } else {
                    // Hashear el password
                    $usuario->hashPassword();

                    // Generar un token unico
                    $usuario->crearToken();

                    // Enviar Email
                    $email = new Email($usuario->email, $usuario->name, $usuario->token);
                    $email->enviarConfirmacion();

                    // Crear el usuario
                    $resultado = $usuario->guardar();

                    if($resultado) {
                        header('Location: /');
                    }
                }
            }
        }

        $router->render('auth/crear-cuenta', [
            'usuario' => $usuario,
            'errores' => $errores
        ]);
    }

    

    public static function confirmar(Router $router) {

        $alertas = [];

        $token = $_GET['token'];

        $usuario = Usuarios::whereArray('token', $token);

        if(empty($usuario)) {
            // Mostrar mensaje de error
            Usuarios::setAlerta('error', 'Token no valido');
        } else {
            // Modificar a usuario confirmado
            $usuario->confirmado = "1";
            $usuario->token = null;

            $usuario->guardar();

            Usuarios::setAlerta('exito', "Usuario confirmado correctamente");
        }
        $alertas = Usuarios::getErrores();

        // Renderizar la vista
        $router->render('auth/confirmar-cuenta', [
            'errores' => $alertas
        ]);
    }

    public static function logout() {
        session_start();
        $_SESSION = [];
        header('Location: /');
    }
}