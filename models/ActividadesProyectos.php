<?php
class ActividadesProyectos extends Connection
{
    public function registrar_actividades_proyectos(
        $tipoActividadID,
        $actividadProyecto,
        $unidadMedidaID,
        $costoActividadProyecto,
        $creadoPor
    ) {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'INSERT INTO ACTIVIDADES_PROYECTOS (TIPO_ACTIVIDAD_ID, ACTIVIDAD_PROYECTO,
                                                     UNIDAD_MEDIDA_ID, COSTO_ACTIVIDAD_PROYECTO,
                                                     ESTADO_ID, CREADO_POR,
                                                     FECHA_CREACION
                                                    )
                                              VALUES(?, UCASE(?),
                                                     ?, ?,
                                                     1, ?,
                                                     NOW()
                                                    );';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $tipoActividadID);
        $query->bindValue(2, $actividadProyecto);
        $query->bindValue(3, $unidadMedidaID);
        $query->bindValue(4, $costoActividadProyecto);
        $query->bindValue(5, $creadoPor);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function listado_actividades_proyectos()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT actividadesProyectos.ACTIVIDAD_PROYECTO_ID,
                         UCASE(tiposActividades.TIPO_ACTIVIDAD) AS TIPO_ACTIVIDAD,
                         UCASE(actividadesProyectos.ACTIVIDAD_PROYECTO) AS ACTIVIDAD_PROYECTO,
                         UCASE(unidadesMedidas.UNIDAD_MEDIDA) AS UNIDAD_MEDIDA,
                         actividadesProyectos.COSTO_ACTIVIDAD_PROYECTO,
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
