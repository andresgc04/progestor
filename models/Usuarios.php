<?php
class Usuarios extends Connection
{
    public function login()
    {
        session_start();

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
                                 usuarios.NOMBRE_USUARIO, usuarios.PASSWORD, usuarios.ESTADO_ID
                            FROM USUARIOS usuarios
                           WHERE usuarios.NOMBRE_USUARIO = ?
                             AND usuarios.ESTADO_ID = 1
                         ';

                $stmt = $connection->prepare($query);
                $stmt->bindValue(1, $nombreUsuario);
                $stmt->execute();
                $resultado = $stmt->fetch();

                if (is_array($resultado) and count($resultado) > 0) {
                    //Verificar la contraseña hasheada usando el password_verify:
                    if (password_verify($password, $resultado['PASSWORD'])) {
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
                } else {
                    header("Location:" . Connection::path() . "index.php?m=1");
                    exit();
                }
            }
        }
    }

    public function registrar_usuarios_empleados(
        $empleadoID,
        $nombreUsuario,
        $password,

        $rol,

        $creadoPor
    ) {
        $conectar = parent::Connection();
        parent::set_names();

        $queryInsertUsuariosEmpleados = 'INSERT INTO USUARIOS (empleado_id,
                                                               nombre_usuario,
                                                               password,
                                                               estado_id,
                                                               creado_por,
                                                               fecha_creacion)
                                                        VALUES(?, ?, ?, 1, ?, NOW());';

        $queryInsertUsuariosEmpleados = $conectar->prepare($queryInsertUsuariosEmpleados);
        $queryInsertUsuariosEmpleados->bindValue(1, $empleadoID);
        $queryInsertUsuariosEmpleados->bindValue(2, $nombreUsuario);
        $queryInsertUsuariosEmpleados->bindValue(3, $password);
        $queryInsertUsuariosEmpleados->bindValue(4, $creadoPor);
        $queryInsertUsuariosEmpleados->execute();

        //Obtener el usuario_id del registro insertado de un nuevo usuario:
        $usuarioID = $conectar->lastInsertId();

        $queryInsertUsersRoles = 'INSERT INTO USUARIOS_ROLES (USUARIO_ID, ROL_ID, ESTADO_ID, CREADO_POR, FECHA_CREACION)
                                                       VALUES(?, ?, 1, ?, NOW());';

        $queryInsertUsersRoles = $conectar->prepare($queryInsertUsersRoles);
        $queryInsertUsersRoles->bindValue(1, $usuarioID);
        $queryInsertUsersRoles->bindValue(2, $rol);
        $queryInsertUsersRoles->bindValue(3, $creadoPor);
        $queryInsertUsersRoles->execute();

        return $resultado = $queryInsertUsersRoles->fetchAll();
    }

    public function registrar_usuarios_clientes(
        $tipoClienteID,
        $nombreCliente,
        $sexoID,
        $tipoDocumentoID,
        $documentoIdentidad,
        $nacionalidadID,
        $telefono,
        $correoElectronico,
        $paisID,
        $provinciaID,
        $ciudadID,
        $direccion,

        $nombreUsuario,
        $password,

        $creadoPor
    ) {
        $conectar = parent::Connection();
        parent::set_names();

        $queryInsertCliente = 'INSERT INTO CLIENTES (TIPO_CLIENTE_ID, NOMBRE_CLIENTE, SEXO_ID,
                                                     TIPO_DOCUMENTO_ID, DOCUMENTO_IDENTIDAD, NACIONALIDAD_ID,
                                                     TELEFONO, CORREO_ELECTRONICO, PAIS_ID,
                                                     PROVINCIA_ID, CIUDAD_ID, DIRECCION,
                                                     ESTADO_ID, CREADO_POR, FECHA_CREACION
                                                    )
                                              VALUES(?,?,?,
                                                     ?,?,?,
                                                     ?,?,?,
                                                     ?,?,?,
                                                     1,?,NOW()
                                                    );';

        $queryInsertCliente = $conectar->prepare($queryInsertCliente);
        $queryInsertCliente->bindValue(1, $tipoClienteID);
        $queryInsertCliente->bindValue(2, $nombreCliente);
        $queryInsertCliente->bindValue(3, $sexoID);
        $queryInsertCliente->bindValue(4, $tipoDocumentoID);
        $queryInsertCliente->bindValue(5, $documentoIdentidad);
        $queryInsertCliente->bindValue(6, $nacionalidadID);
        $queryInsertCliente->bindValue(7, $telefono);
        $queryInsertCliente->bindValue(8, $correoElectronico);
        $queryInsertCliente->bindValue(9, $paisID);
        $queryInsertCliente->bindValue(10, $provinciaID);
        $queryInsertCliente->bindValue(11, $ciudadID);
        $queryInsertCliente->bindValue(12, $direccion);
        $queryInsertCliente->bindValue(13, $creadoPor);
        $queryInsertCliente->execute();

        //Obtener el cliente_id del registro insertado de un nuevo cliente:
        $clienteID = $conectar->lastInsertId();

        $queryInsertUser = 'INSERT INTO USUARIOS (CLIENTE_ID, NOMBRE_USUARIO, PASSWORD, ESTADO_ID, CREADO_POR, FECHA_CREACION)
                                           VALUES(?, ?, ?, 1, ?, NOW());
                           ';

        $queryInsertUser = $conectar->prepare($queryInsertUser);
        $queryInsertUser->bindValue(1, $clienteID);
        $queryInsertUser->bindValue(2, $nombreUsuario);
        $queryInsertUser->bindValue(3, $password);
        $queryInsertUser->bindValue(4, $creadoPor);
        $queryInsertUser->execute();

        //Obtener el usuario_id del registro insertado de un nuevo usuario:
        $usuarioID = $conectar->lastInsertId();

        $queryInsertUsersRoles = 'INSERT INTO USUARIOS_ROLES (USUARIO_ID, ROL_ID, ESTADO_ID, CREADO_POR, FECHA_CREACION)
                                                       VALUES(?, 2, 1, ?, NOW());
                                 ';

        $queryInsertUsersRoles = $conectar->prepare($queryInsertUsersRoles);
        $queryInsertUsersRoles->bindValue(1, $usuarioID);
        $queryInsertUsersRoles->bindValue(2, $creadoPor);
        $queryInsertUsersRoles->execute();

        $resultado = $queryInsertUsersRoles->fetchAll();

        return $resultado;
    }

    public function listado_usuarios_asignados_empleados()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = "SELECT usuarios.usuario_id,
                         UCASE(CONCAT(empleados.primer_nombre, ' ',
                         empleados.segundo_nombre, ' ',
                         empleados.primer_apellido, ' ',
                         empleados.segundo_apellido)
                         ) AS empleados,
                         UCASE(usuarios.nombre_usuario) AS usuarios,
                         UCASE(roles.rol) AS roles,
                         UCASE(estados.estado) AS estados
                    FROM USUARIOS usuarios
              INNER JOIN EMPLEADOS empleados
                      ON usuarios.empleado_id = empleados.empleado_id
                         INNER JOIN USUARIOS_ROLES usuariosRoles
                      ON usuarios.usuario_id = usuariosRoles.usuario_id
       	                 INNER JOIN ROLES roles 
                      ON usuariosRoles.rol_id = roles.rol_id
                         INNER JOIN ESTADOS estados
                      ON usuarios.estado_id = estados.estado_id
                   WHERE usuarios.estado_id = 1
                ORDER BY usuarios.usuario_id DESC, usuarios.fecha_creacion DESC;";

        $query = $conectar->prepare($query);
        $query->execute();

        return $resultado = $query->fetchAll();
    }

    public function obtener_informacion_usuario_logeado($usuarioID)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = "SELECT UCASE(CONCAT(empleados.primer_nombre,' ',
                         empleados.segundo_nombre,' ',
                         empleados.primer_apellido,' ',
                         empleados.segundo_apellido
			             )) empleados,
                         UCASE(clientes.nombre_cliente) nombre_cliente,
                         roles.rol
                    FROM USUARIOS usuarios
                         LEFT JOIN EMPLEADOS empleados
                      ON usuarios.empleado_id = empleados.empleado_id
                         LEFT JOIN CLIENTES clientes
                      ON usuarios.cliente_id = clientes.cliente_id
                         INNER JOIN USUARIOS_ROLES usuariosRoles
                      ON usuarios.usuario_id = usuariosRoles.usuario_id
                         INNER JOIN ROLES roles 
                      ON usuariosRoles.rol_id = roles.rol_id
                   WHERE usuarios.usuario_id = ?";

        $query = $conectar->prepare($query);
        $query->bindValue(1, $usuarioID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }
}
