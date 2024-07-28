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
                   WHERE paises.ESTADO_ID = 1
                ORDER BY paises.PAIS_ID DESC, paises.FECHA_CREACION DESC;';

        $query = $conectar->prepare($query);
        $query->execute();

        return $resultado = $query->fetchAll();
    }

    public function obtener_listado_opciones_paises()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT PAIS_ID, UCASE(PAIS) AS PAIS 
                    FROM PAISES
                   WHERE ESTADO_ID = 1
                ORDER BY PAIS;';

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

    public function modificar_paises_por_paisID($modificarPais, $paisID, $modificadoPor)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'UPDATE PAISES SET PAIS = ?, MODIFICADO_POR = ?, FECHA_MODIFICACION = NOW()
                              WHERE PAIS_ID = ?;';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $modificarPais);
        $query->bindValue(2, $modificadoPor);
        $query->bindValue(3, $paisID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function eliminar_paises_por_paisID($paisID, $modificadoPor)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'UPDATE PAISES SET ESTADO_ID = 4, MODIFICADO_POR = ?, FECHA_MODIFICACION = NOW()
                              WHERE PAIS_ID = ?;';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $modificadoPor);
        $query->bindValue(2, $paisID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function obtener_listado_opciones_paises_por_pais_ID($paisID)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = "SELECT PAIS_ID,
                         UCASE(PAIS) AS PAIS
                    FROM PAISES 
                   WHERE PAIS_ID = ?;";

        $query = $conectar->prepare($query);
        $query->bindValue(1, $paisID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function obtener_listado_opciones_paises_diferente_pais_ID($paisID)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = "SELECT PAIS_ID,
                         UCASE(PAIS) AS PAIS
                    FROM PAISES 
                   WHERE PAIS_ID != ?
                ORDER BY PAIS;";

        $query = $conectar->prepare($query);
        $query->bindValue(1, $paisID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }
}
