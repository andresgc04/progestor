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
}
