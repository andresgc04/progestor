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
}
