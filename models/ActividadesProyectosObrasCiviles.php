<?php
class ActividadesProyectosObrasCiviles extends Connection
{
    public function registrar_actividades_proyectos_obras_civiles(
        $proyectoObraCivilID,
        $tipoActividadID,
        $nombreActividad,
        $descripcionActividad,
        $costoActividad,
        $creadoPor
    ) {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'INSERT INTO ACTIVIDADES_PROYECTOS_OBRAS_CIVILES (PROYECTO_OBRA_CIVIL_ID, TIPO_ACTIVIDAD_ID,
                                                                   NOMBRE_ACTIVIDAD, DESCRIPCION_ACTIVIDAD,
                                                                   COSTO_ACTIVIDAD, ESTADO_ID,
                                                                   CREADO_POR, FECHA_CREACION
                                                                  )
                                                            VALUES(?, ?,
                                                                   ?, ?,
                                                                   ?, 1,
                                                                   ?, NOW()
                                                                  );';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $proyectoObraCivilID);
        $query->bindValue(2, $tipoActividadID);
        $query->bindValue(3, $nombreActividad);
        $query->bindValue(4, $descripcionActividad);
        $query->bindValue(5, $costoActividad);
        $query->bindValue(6, $creadoPor);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function listado_actividades_proyectos_obras_civiles_por_proyecto_obra_civil_ID($proyectoObraCivilID)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT actividadesProyectosObrasCiviles.ACTIVIDAD_PROYECTO_OBRA_CIVIL_ID,
    	                 UCASE(fasesProyectos.FASE_PROYECTO) AS FASE_PROYECTO,
                         UCASE(tiposActividades.TIPO_ACTIVIDAD) AS TIPO_ACTIVIDAD,
                         UCASE(actividadesProyectos.ACTIVIDAD_PROYECTO) AS ACTIVIDAD_PROYECTO,
                         actividadesProyectosObrasCiviles.COSTO_ACTIVIDAD_PROYECTO,
                         UCASE(estados.ESTADO) AS ESTADOS
                    FROM ACTIVIDADES_PROYECTOS_OBRAS_CIVILES actividadesProyectosObrasCiviles
              INNER JOIN FASES_PROYECTOS fasesProyectos
                      ON actividadesProyectosObrasCiviles.FASE_PROYECTO_ID = fasesProyectos.FASE_PROYECTO_ID
              INNER JOIN TIPOS_ACTIVIDADES tiposActividades
                      ON actividadesProyectosObrasCiviles.TIPO_ACTIVIDAD_ID = tiposActividades.TIPO_ACTIVIDAD_ID 
              INNER JOIN ACTIVIDADES_PROYECTOS actividadesProyectos
                      ON actividadesProyectosObrasCiviles.ACTIVIDAD_PROYECTO_ID = actividadesProyectos.ACTIVIDAD_PROYECTO_ID
              INNER JOIN ESTADOS estados
                      ON actividadesProyectosObrasCiviles.ESTADO_ID = estados.ESTADO_ID
                   WHERE actividadesProyectosObrasCiviles.PROYECTO_OBRA_CIVIL_ID = ?
                     AND actividadesProyectosObrasCiviles.ESTADO_ID = 1;';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $proyectoObraCivilID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function obtener_detalles_actividades_proyectos_obras_civiles_por_actividad_proyecto_obra_civil_ID_proyecto_obra_civil_ID(
        $actividadProyectoObraCivilID,
        $proyectoObraCivilID
    ) {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT ACTIVIDAD_ID,
	                     PROYECTO_OBRA_CIVIL_ID,
                         TIPO_ACTIVIDAD_ID,
                         UCASE(NOMBRE_ACTIVIDAD) AS NOMBRE_ACTIVIDAD,
                         UCASE(DESCRIPCION_ACTIVIDAD) AS DESCRIPCION_ACTIVIDAD,
                         COSTO_ACTIVIDAD
                    FROM ACTIVIDADES_PROYECTOS_OBRAS_CIVILES
                   WHERE ACTIVIDAD_ID = ? AND PROYECTO_OBRA_CIVIL_ID = ?;';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $actividadProyectoObraCivilID);
        $query->bindValue(2, $proyectoObraCivilID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function modificar_actividades_proyectos_obras_civiles_por_actividad_proyecto_obra_civil_ID_proyecto_obra_civil_ID(
        $tipoActividadID,
        $nombreActividad,
        $descripcionActividad,
        $costoActividad,
        $modificadoPor,
        $actividadID,
        $proyectoObraCivilID
    ) {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'UPDATE ACTIVIDADES_PROYECTOS_OBRAS_CIVILES SET TIPO_ACTIVIDAD_ID = ?, NOMBRE_ACTIVIDAD = ?,
											                     DESCRIPCION_ACTIVIDAD = ?, COSTO_ACTIVIDAD = ?,
                                                                 MODIFICADO_POR = ?, FECHA_MODIFICACION = NOW()
                                                           WHERE ACTIVIDAD_ID = ? AND PROYECTO_OBRA_CIVIL_ID = ?;';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $tipoActividadID);
        $query->bindValue(2, $nombreActividad);
        $query->bindValue(3, $descripcionActividad);
        $query->bindValue(4, $costoActividad);
        $query->bindValue(5, $modificadoPor);
        $query->bindValue(6, $actividadID);
        $query->bindValue(7, $proyectoObraCivilID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }
}
