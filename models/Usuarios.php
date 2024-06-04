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
                $query = "SELECT * FROM USUARIOS WHERE NOMBRE_USUARIO = ? AND PASSWORD = ? AND ESTADO_ID = 1";
                $stmt = $connection->prepare($query);
                $stmt->bindValue(1, $nombreUsuario);
                $stmt->bindValue(2, $password);
                $stmt->execute();
                $resultado = $stmt->fetch();

                if (is_array($resultado) and count($resultado) > 0) {
                    $_SESSION["usuario_id"] = $resultado["usuario_id"];
                    $_SESSION["nombre_usuario"] = $resultado["nombre_usuario"];

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
