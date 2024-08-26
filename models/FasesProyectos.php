<?php
class FasesProyectos extends Connection
{
    public function registrar_fases_proyectos($faseProyecto, $creadoPor)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'INSERT INTO FASES_PROYECTOS (FASE_PROYECTO, ESTADO_ID,
                                               CREADO_POR, FECHA_CREACION
                                              )
                                        VALUES(?, 1,
                                               ?, NOW()
                                               );';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $faseProyecto);
        $query->bindValue(2, $creadoPor);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

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

    public function obtener_listado_opciones_fases_proyectos()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT FASE_PROYECTO_ID,
                         UCASE(FASE_PROYECTO) AS FASE_PROYECTO
                    FROM FASES_PROYECTOS
                   WHERE ESTADO_ID = 1
                ORDER BY FASE_PROYECTO ASC;';

        $query = $conectar->prepare($query);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }
}
