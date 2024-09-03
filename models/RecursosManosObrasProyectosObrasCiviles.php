<?php
class RecursosManosObrasProyectosObrasCiviles extends Connection
{
    public function listado_recursos_manos_obras_proyectos_obras_civiles()
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
	               WHERE recursosManosObrasProyectosObrasCiviles.ESTADO_ID = 1
                ORDER BY recursosManosObrasProyectosObrasCiviles.RECURSO_MANO_OBRA_PROYECTO_OBRA_CIVIL_ID DESC,
		                 recursosManosObrasProyectosObrasCiviles.FECHA_CREACION DESC;';

        $query = $conectar->prepare($query);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }
}
