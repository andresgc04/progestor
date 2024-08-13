<?php
class TiposActividades extends Connection
{
    public function obtener_listado_opciones_tipos_actividades()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT TIPO_ACTIVIDAD_ID,
                         UCASE(TIPO_ACTIVIDAD) AS TIPO_ACTIVIDAD
                    FROM TIPOS_ACTIVIDADES
                   WHERE ESTADO_ID = 1
                ORDER BY TIPO_ACTIVIDAD ASC;';

        $query = $conectar->prepare($query);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }
}