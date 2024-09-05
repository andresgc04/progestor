<?php
class Roles extends Connection
{
    public function registrar_roles($rol, $creadoPor)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'INSERT INTO ROLES (ROL, ESTADO_ID, CREADO_POR, FECHA_CREACION)
      		                  VALUES(UCASE(?), 1, ?, NOW());';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $rol);
        $query->bindValue(2, $creadoPor);
        $query->execute();

        return $resultado = $query->fetchAll();
    }

    public function listado_roles()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT roles.ROL_ID,
                         UCASE(roles.ROL) ROL,
                         UCASE(estados.ESTADO) ESTADO
                    FROM ROLES roles
                         INNER JOIN ESTADOS estados
                      ON roles.ESTADO_ID = estados.ESTADO_ID
                   WHERE roles.ESTADO_ID = 1
                ORDER BY roles.ROL_ID DESC, roles.FECHA_CREACION DESC;';

        $query = $conectar->prepare($query);
        $query->execute();

        return $resultado = $query->fetchAll();
    }

    public function obtener_listado_opciones_roles()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT rol_id, UCASE(rol) AS rol 
                    FROM ROLES
                   WHERE rol_id != 2;';

        $query = $conectar->prepare($query);
        $query->execute();

        return $resultado = $query->fetchAll();
    }

    public function obtener_listado_opciones_todos_roles()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT rol_id, UCASE(rol) AS rol
                    FROM ROLES
                   WHERE estado_id = 1;
                ORDER BY rol ASC';

        $query = $conectar->prepare($query);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function obtener_detalles_roles_por_rol_ID($rolID)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT ROL_ID, 
	                     UCASE(ROL) AS ROLES
                    FROM ROLES
                   WHERE ROL_ID = ?;';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $rolID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function modificar_roles_por_rol_ID($rol, $rolID, $modificadoPor)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'UPDATE ROLES SET ROL = ?, MODIFICADO_POR = ?, FECHA_MODIFICACION = NOW()
                             WHERE ROL_ID = ?;';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $rol);
        $query->bindValue(2, $modificadoPor);
        $query->bindValue(3, $rolID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function eliminar_roles_por_rol_ID($rolID, $modificadoPor)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'UPDATE ROLES SET ESTADO_ID = 4,
				                   MODIFICADO_POR = ?,
                                   FECHA_MODIFICACION = NOW()
		                     WHERE ROL_ID = ?;';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $modificadoPor);
        $query->bindValue(2, $rolID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }
}
