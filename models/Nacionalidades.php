<?php
class Nacionalidades extends Connection
{
    public function obtener_listado_opciones_nacionalidades()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT NACIONALIDAD_ID, NACIONALIDAD 
                    FROM NACIONALIDADES
                   WHERE ESTADO_ID = 1;
                 ';

        $query = $conectar->prepare($query);
        $query->execute();

        return $resultado = $query->fetchAll();
    }
}
