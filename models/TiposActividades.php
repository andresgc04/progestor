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

    public function obtener_listado_opciones_tipos_actividades_por_tipo_actividad_ID($tipoActividadID)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT TIPO_ACTIVIDAD_ID,
	                  UCASE(TIPO_ACTIVIDAD) AS TIPO_ACTIVIDAD
                 FROM TIPOS_ACTIVIDADES
                WHERE TIPO_ACTIVIDAD_ID = ?;';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $tipoActividadID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function obtener_listado_opciones_tipos_actividades_diferente_tipo_actividad_ID($tipoActividadID)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT TIPO_ACTIVIDAD_ID,
	                     UCASE(TIPO_ACTIVIDAD) AS TIPO_ACTIVIDAD
                    FROM TIPOS_ACTIVIDADES
                   WHERE TIPO_ACTIVIDAD_ID != ?
                ORDER BY TIPO_ACTIVIDAD;';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $tipoActividadID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }
}
