<?php
class RecursosManosObrasProyectosObrasCiviles extends Connection
{
    public function registrar_recursos_manos_obras_proyectos_obras_civiles(
        $proyectoObraCivilID,
        $faseProyectoID,
        $recursoManoObraID,
        $tipoPago,
        $cantidadRecursoManoObra,
        $costoPagoRecursoManoObra,
        $costoTotal,
        $creadoPor
    ) {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'INSERT INTO RECURSOS_MANOS_OBRAS_PROYECTOS_OBRAS_CIVILES (
                              PROYECTO_OBRA_CIVIL_ID, FASE_PROYECTO_ID,
                              RECURSO_MANO_OBRA_ID, TIPO_PAGO,
                              CANTIDAD_RECURSO_MANO_OBRA, COSTO_PAGO_RECURSO_MANO_OBRA,
                              COSTO_TOTAL, ESTADO_ID,
                              CREADO_POR, FECHA_CREACION
                             )
                       VALUES(?, ?,
                              ?, ?,
                              ?, ?,
                              ?, 1,
                              ?, NOW()
                             );';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $proyectoObraCivilID);
        $query->bindValue(2, $faseProyectoID);
        $query->bindValue(3, $recursoManoObraID);
        $query->bindValue(4, $tipoPago);
        $query->bindValue(5, $cantidadRecursoManoObra);
        $query->bindValue(6, $costoPagoRecursoManoObra);
        $query->bindValue(7, $costoTotal);
        $query->bindValue(8, $creadoPor);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function listado_recursos_manos_obras_proyectos_obras_civiles($proyectoObraCivilID)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT recursosManosObrasProyectosObrasCiviles.RECURSO_MANO_OBRA_PROYECTO_OBRA_CIVIL_ID,
                         recursosManosObrasProyectosObrasCiviles.PROYECTO_OBRA_CIVIL_ID,
                         UCASE(fasesProyectos.FASE_PROYECTO) AS FASE_PROYECTO,
                         UCASE(recursosManosObras.RECURSO_MANO_OBRA) AS RECURSO_MANO_OBRA,
                         UCASE(recursosManosObrasProyectosObrasCiviles.TIPO_PAGO) AS TIPO_PAGO,
                         recursosManosObrasProyectosObrasCiviles.COSTO_TOTAL,
                         UCASE(estados.ESTADO) AS ESTADO
                    FROM RECURSOS_MANOS_OBRAS_PROYECTOS_OBRAS_CIVILES recursosManosObrasProyectosObrasCiviles
              INNER JOIN FASES_PROYECTOS fasesProyectos
                      ON recursosManosObrasProyectosObrasCiviles.FASE_PROYECTO_ID = fasesProyectos.FASE_PROYECTO_ID
              INNER JOIN RECURSOS_MANOS_OBRAS recursosManosObras
		              ON recursosManosObrasProyectosObrasCiviles.RECURSO_MANO_OBRA_ID =
                         recursosManosObras.RECURSO_MANO_OBRA_ID
              INNER JOIN ESTADOS estados
                      ON recursosManosObrasProyectosObrasCiviles.ESTADO_ID = estados.ESTADO_ID
	               WHERE recursosManosObrasProyectosObrasCiviles.PROYECTO_OBRA_CIVIL_ID = ?
                     AND recursosManosObrasProyectosObrasCiviles.ESTADO_ID = 1
                ORDER BY recursosManosObrasProyectosObrasCiviles.RECURSO_MANO_OBRA_PROYECTO_OBRA_CIVIL_ID DESC,
		                 recursosManosObrasProyectosObrasCiviles.FECHA_CREACION DESC;';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $proyectoObraCivilID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function obtener_costos_totales_recursos_manos_obras_proyectos_obras_civiles_por_proyecto_obra_civil_ID($proyectoObraCivilID)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT SUM(COSTO_TOTAL) AS COSTO_TOTAL
                    FROM RECURSOS_MANOS_OBRAS_PROYECTOS_OBRAS_CIVILES 
                   WHERE PROYECTO_OBRA_CIVIL_ID = ?; ';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $proyectoObraCivilID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }
}
