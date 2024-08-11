<?php
class AccesosModulosSistemas extends Connection
{
        public function obtener_listado_accesos_modulos_sistemas()
        {
                $conectar = parent::Connection();
                parent::set_names();

                $query = 'SELECT accesosModulosSistemas.ACCESO_MODULO_SISTEMA_ID,
    	                         accesosModulosSistemas.MODULO_SISTEMA_ID,
                                 accesosModulosSistemas.ROL_ID,
                                 UCASE(roles.ROL) AS ROL,
                                 UCASE(modulosSistemas.MODULO) AS MODULO,
                                 UCASE(estados.ESTADO) AS ESTADO
                            FROM ACCESOS_MODULOS_SISTEMAS accesosModulosSistemas
                      INNER JOIN ROLES roles
                              ON accesosModulosSistemas.ROL_ID = roles.ROL_ID 
                      INNER JOIN MODULOS_SISTEMAS modulosSistemas
 		              ON accesosModulosSistemas.MODULO_SISTEMA_ID = modulosSistemas.MODULO_SISTEMA_ID
                      INNER JOIN ESTADOS estados
                              ON accesosModulosSistemas.ESTADO_ID = estados.ESTADO_ID 
	                   WHERE accesosModulosSistemas.ESTADO_ID = 1 
                        ORDER BY accesosModulosSistemas.ROL_ID ASC, accesosModulosSistemas.MODULO_SISTEMA_ID ASC;';

                $query = $conectar->prepare($query);
                $query->execute();

                $resultado = $query->fetchAll();

                return $resultado;
        }

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
