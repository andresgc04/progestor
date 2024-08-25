<?php
class ActividadesProyectos extends Connection
{
    public function listado_actividades_proyectos()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT actividadesProyectos.ACTIVIDAD_PROYECTO_ID,
                         UCASE(tiposActividades.TIPO_ACTIVIDAD) AS TIPO_ACTIVIDAD,
                         UCASE(actividadesProyectos.ACTIVIDAD_PROYECTO) AS ACTIVIDAD_PROYECTO,
                         UCASE(unidadesMedidas.UNIDAD_MEDIDA) AS UNIDAD_MEDIDA,
                         UCASE(estados.ESTADO) AS ESTADOS
                    FROM ACTIVIDADES_PROYECTOS actividadesProyectos
              INNER JOIN TIPOS_ACTIVIDADES tiposActividades
                      ON actividadesProyectos.TIPO_ACTIVIDAD_ID = tiposActividades.TIPO_ACTIVIDAD_ID
              INNER JOIN UNIDADES_MEDIDAS unidadesMedidas 
                      ON actividadesProyectos.UNIDAD_MEDIDA_ID = unidadesMedidas.UNIDAD_MEDIDA_ID
              INNER JOIN ESTADOS estados
                      ON actividadesProyectos.ESTADO_ID = estados.ESTADO_ID
                   WHERE actividadesProyectos.ESTADO_ID = 1
                ORDER BY actividadesProyectos.ACTIVIDAD_PROYECTO_ID DESC, actividadesProyectos.FECHA_CREACION DESC;';

        $query = $conectar->prepare($query);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }
}
