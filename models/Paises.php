<?php
class Paises extends Connection
{
    public function registrar_pais($pais, $creadoPor)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'INSERT INTO PAISES (PAIS, ESTADO_ID, CREADO_POR, FECHA_CREACION)
                               VALUES(?, 1, ?, NOW());';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $pais);
        $query->bindValue(2, $creadoPor);
        $query->execute();

        return $resultado = $query->fetchAll();
    }

    public function listado_paises()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT paises.PAIS_ID, 
                         UCASE(paises.PAIS) PAISES, UCASE(estados.ESTADO) ESTADOS
                    FROM PAISES paises 
              INNER JOIN ESTADOS estados
                      ON paises.ESTADO_ID = estados.ESTADO_ID
                   WHERE paises.ESTADO_ID = 1;';

        $query = $conectar->prepare($query);
        $query->execute();

        return $resultado = $query->fetchAll();
    }

    public function obtener_listado_opciones_paises()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT PAIS_ID, PAIS 
                    FROM PAISES
                   WHERE ESTADO_ID = 1
                 ';

        $query = $conectar->prepare($query);
        $query->execute();

        return $resultado = $query->fetchAll();
    }

    public function obtener_detalle_pais_por_paisID($paisID)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT PAIS_ID, UCASE(PAIS) PAIS
                    FROM PAISES 
                   WHERE PAIS_ID = ?;';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $paisID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }
}
