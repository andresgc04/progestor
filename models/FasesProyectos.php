<?php
class FasesProyectos extends Connection
{
    public function listado_fases_proyectos()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT fasesProyectos.FASE_PROYECTO_ID, 
  		                 UCASE(fasesProyectos.FASE_PROYECTO) AS FASE_PROYECTO,
                         UCASE(estados.ESTADO) AS ESTADOS
                    FROM FASES_PROYECTOS fasesProyectos
              INNER JOIN ESTADOS estados
                      ON fasesProyectos.ESTADO_ID = estados.ESTADO_ID
                   WHERE fasesProyectos.ESTADO_ID = 1
                ORDER BY fasesProyectos.FASE_PROYECTO_ID DESC, fasesProyectos.FECHA_CREACION DESC;';

        $query = $conectar->prepare($query);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }
}
