<?php
class AccesosModulosSistemas extends Connection
{
    public function obtener_accesos_modulos_sistemas_usuarios_por_usuario_ID($usuarioID)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = "SELECT modulosSistemas.MODULO
                    FROM USUARIOS usuarios
              INNER JOIN USUARIOS_ROLES usuariosRoles
                      ON usuarios.USUARIO_ID = usuariosRoles.USUARIO_ID
              INNER JOIN ROLES roles
                      ON usuariosRoles.ROL_ID = roles.ROL_ID
              INNER JOIN ACCESOS_MODULOS_SISTEMAS accesosModulosSistemas
                      ON roles.ROL_ID = accesosModulosSistemas.ROL_ID
              INNER JOIN MODULOS_SISTEMAS modulosSistemas
                      ON accesosModulosSistemas.MODULO_SISTEMA_ID = modulosSistemas.MODULO_SISTEMA_ID
	               WHERE usuarios.USUARIO_ID = ? AND usuarios.ESTADO_ID = 1;";

        $query = $conectar->prepare($query);
        $query->bindValue(1, $usuarioID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }
}
