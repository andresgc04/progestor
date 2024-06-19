<?php
class EstadosCiviles extends Connection
{
    public function obtener_listado_opciones_estados_civiles()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT ESTADO_CIVIL_ID, ESTADO_CIVIL 
                    FROM ESTADOS_CIVILES
                   WHERE ESTADO_ID = 1;';

        $query = $conectar->prepare($query);
        $query->execute();

        return $resultado = $query->fetchAll();
    }
}
