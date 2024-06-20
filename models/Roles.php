<?php
class Roles extends Connection
{
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
