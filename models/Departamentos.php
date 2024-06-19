<?php
class Departamentos extends Connection
{
    public function obtener_listado_opciones_departamentos()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT DEPARTAMENTO_ID, DEPARTAMENTO 
                    FROM DEPARTAMENTOS
                   WHERE ESTADO_ID = 1;';

        $query = $conectar->prepare($query);
        $query->execute();

        return $resultado = $query->fetchAll();
    }
}
