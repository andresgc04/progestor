<?php
class Puestos extends Connection
{
    public function listado_puestos()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT PUESTO_ID,
                         PUESTO
                    FROM PUESTOS
                   WHERE ESTADO_ID = 1
                ORDER BY PUESTO_ID DESC, FECHA_CREACION DESC;';

        $query = $conectar->prepare($query);
        $query->execute();

        return $resultado = $query->fetchAll();
    }

    public function obtener_listado_opciones_puestos()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT PUESTO_ID, PUESTO 
                    FROM PUESTOS
                   WHERE ESTADO_ID = 1;';

        $query = $conectar->prepare($query);
        $query->execute();

        return $resultado = $query->fetchAll();
    }
}
