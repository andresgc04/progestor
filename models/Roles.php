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

        $query = 'SELECT rol_id, rol 
                    FROM ROLES
                   WHERE rol_id != 2;';

        $query = $conectar->prepare($query);
        $query->execute();

        return $resultado = $query->fetchAll();
    }
}
