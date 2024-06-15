<?php
class Sexos extends Connection
{
    public function obtener_listado_opciones_sexos()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT SEXO_ID, SEXO 
                    FROM SEXOS
                   WHERE ESTADO_ID = 1
                 ';

        $query = $conectar->prepare($query);
        $query->execute();

        return $resultado = $query->fetchAll();
    }
}
