<?php
class ProyectosObrasCiviles extends Connection
{
    public function registrar_proyectos_obras_civiles(
        $solicitudProyectoID,
        $nombreProyecto,
        $descripcionProyecto,
        $tipoProyectoObraCivilID,
        $categoriaTipoProyectoObraCivilID,
        $responsableID,
        $fechaInicioProyecto,
        $fechaFinalizacionProyecto,
        $creadoPor
    ) {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'INSERT INTO PROYECTOS_OBRAS_CIVILES (SOLICITUD_PROYECTO_ID, NOMBRE_PROYECTO,
                                                       DESCRIPCION_PROYECTO, TIPO_PROYECTO_OBRA_CIVIL_ID,
                                                       CATEGORIA_TIPO_PROYECTO_OBRA_CIVIL_ID,
                                                       RESPONSABLE_ID, FECHA_INICIO_PROYECTO,
                                                       FECHA_FINALIZACION_PROYECTO, ESTADO_ID,
                                                       CREADO_POR, FECHA_CREACION
                                                       )
                                                 VALUES(?, ?,
                                                        ?, ?, 
                                                        ?,
                                                        ?, ?,
                                                        ?, 1,
                                                        ?, NOW());';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $solicitudProyectoID);
        $query->bindValue(2, $nombreProyecto);
        $query->bindValue(3, $descripcionProyecto);
        $query->bindValue(4, $tipoProyectoObraCivilID);
        $query->bindValue(5, $categoriaTipoProyectoObraCivilID);
        $query->bindValue(6, $responsableID);
        $query->bindValue(7, $fechaInicioProyecto);
        $query->bindValue(8, $fechaFinalizacionProyecto);
        $query->bindValue(9, $creadoPor);
        $query->execute();

        return $resultado = $query->fetchAll();
    }

    public function listado_proyectos_obras_civiles()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = "SELECT proyectosObrasCiviles.PROYECTO_OBRA_CIVIL_ID,
                         proyectosObrasCiviles.SOLICITUD_PROYECTO_ID,
                         UCASE(proyectosObrasCiviles.NOMBRE_PROYECTO) NOMBRE_PROYECTO,
                         UCASE(tiposProyectosObrasCiviles.TIPO_PROYECTO_OBRA_CIVIL) 
                         TIPO_PROYECTO_OBRA_CIVIL,
                         UCASE(estados.ESTADO) ESTADO
                    FROM PROYECTOS_OBRAS_CIVILES proyectosObrasCiviles
              INNER JOIN TIPOS_PROYECTOS_OBRAS_CIVILES tiposProyectosObrasCiviles
                      ON proyectosObrasCiviles.TIPO_PROYECTO_OBRA_CIVIL_ID = 
                         tiposProyectosObrasCiviles.TIPO_PROYECTO_OBRA_CIVIL_ID
              INNER JOIN ESTADOS estados
                      ON proyectosObrasCiviles.ESTADO_ID = estados.ESTADO_ID
                   WHERE proyectosObrasCiviles.ESTADO_ID = 1
                ORDER BY proyectosObrasCiviles.PROYECTO_OBRA_CIVIL_ID DESC,
                         proyectosObrasCiviles.FECHA_CREACION DESC;";

        $query = $conectar->prepare($query);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function obtener_datos_proyectos_obras_civiles_por_proyecto_obra_civil_ID_solicitud_proyecto_ID($proyectoObraCivilID, $solicitudProyectoID)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT proyectosObrasCiviles.PROYECTO_OBRA_CIVIL_ID, proyectosObrasCiviles.SOLICITUD_PROYECTO_ID,
                         UCASE(proyectosObrasCiviles.NOMBRE_PROYECTO) NOMBRE_PROYECTO, UCASE(proyectosObrasCiviles.DESCRIPCION_PROYECTO) DESCRIPCION_PROYECTO,
                         proyectosObrasCiviles.TIPO_PROYECTO_OBRA_CIVIL_ID, proyectosObrasCiviles.CATEGORIA_TIPO_PROYECTO_OBRA_CIVIL_ID,
                         proyectosObrasCiviles.RESPONSABLE_ID, proyectosObrasCiviles.FECHA_INICIO_PROYECTO,
                         proyectosObrasCiviles.FECHA_FINALIZACION_PROYECTO, UCASE(estados.ESTADO) ESTADO
                    FROM PROYECTOS_OBRAS_CIVILES proyectosObrasCiviles
                         INNER JOIN ESTADOS estados
                      ON proyectosObrasCiviles.ESTADO_ID = estados.ESTADO_ID
                   WHERE proyectosObrasCiviles.PROYECTO_OBRA_CIVIL_ID = ? 
                     AND proyectosObrasCiviles.SOLICITUD_PROYECTO_ID = ?;';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $proyectoObraCivilID);
        $query->bindValue(2, $solicitudProyectoID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }
}
