<?php
class Usuarios extends Connection
{
    public function login()
    {
        $connection = parent::Connection();

        parent::set_names();

        if (isset($_POST["enviar"])) {
            $nombreUsuario = $_POST['nombreUsuario'];
            $password = $_POST['password'];

            if (empty($nombreUsuario) and empty($password)) {
                header("Location:" . Connection::path() . "index.php?m=2");
                exit();
            } else {
                $query = 'SELECT usuarios.USUARIO_ID, usuarios.EMPLEADO_ID, usuarios.CLIENTE_ID, 
                                 usuarios.NOMBRE_USUARIO, usuarios.ESTADO_ID
                            FROM USUARIOS usuarios
                           WHERE usuarios.NOMBRE_USUARIO = ? 
                             AND usuarios.PASSWORD = ?
                             AND usuarios.ESTADO_ID = 1
                         ';

                $stmt = $connection->prepare($query);
                $stmt->bindValue(1, $nombreUsuario);
                $stmt->bindValue(2, $password);
                $stmt->execute();
                $resultado = $stmt->fetch();

                if (is_array($resultado) and count($resultado) > 0) {
                    $_SESSION["USUARIO_ID"] = $resultado["USUARIO_ID"];
                    $_SESSION["EMPLEADO_ID"] = $resultado["EMPLEADO_ID"];
                    $_SESSION["CLIENTE_ID"] = $resultado["CLIENTE_ID"];
                    $_SESSION["NOMBRE_USUARIO"] = $resultado["NOMBRE_USUARIO"];
                    $_SESSION["ESTADO_ID"] = $resultado["ESTADO_ID"];

                    header("Location:" . Connection::path() . "view/dashboard/");
                    exit();
                } else {
                    header("Location:" . Connection::path() . "index.php?m=1");
                    exit();
                }
            }
        }
    }
}
