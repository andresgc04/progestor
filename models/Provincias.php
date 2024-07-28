<?php
class Provincias extends Connection
{
    public function registrar_provincia($paisID, $provincia, $creadoPor)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'INSERT INTO PROVINCIAS (PAIS_ID, PROVINCIA, ESTADO_ID, CREADO_POR, FECHA_CREACION)
                                   VALUES(?, ?, 1, ?, NOW());';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $paisID);
        $query->bindValue(2, $provincia);
        $query->bindValue(3, $creadoPor);
        $query->execute();

        return $resultado = $query->fetchAll();
    }

    public function listado_provincias()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT provincias.PAIS_ID, provincias.PROVINCIA_ID,
                         UCASE(paises.PAIS) PAIS, UCASE(provincias.PROVINCIA) PROVINCIA,
                         UCASE(estados.ESTADO) ESTADO
                    FROM PROVINCIAS provincias
              INNER JOIN PAISES paises
                      ON provincias.PAIS_ID = paises.PAIS_ID
              INNER JOIN ESTADOS estados
                      ON provincias.ESTADO_ID = estados.ESTADO_ID
                   WHERE provincias.ESTADO_ID = 1
                ORDER BY provincias.PROVINCIA_ID DESC, provincias.FECHA_CREACION DESC
                  ';

        $query = $conectar->prepare($query);
        $query->execute();

        return $resultado = $query->fetchAll();
    }

    public function obtener_listado_opciones_provincias()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT PROVINCIA_ID,
                         UCASE(PROVINCIA) AS PROVINCIA
                    FROM PROVINCIAS
                   WHERE ESTADO_ID = 1
                ORDER BY PROVINCIA;';

        $query = $conectar->prepare($query);
        $query->execute();

        return $resultado = $query->fetchAll();
    }

    public function obtener_listado_opciones_provincias_por_paisID($paisID)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT PROVINCIA_ID,
                         UCASE(PROVINCIA) AS PROVINCIA
                    FROM PROVINCIAS
                   WHERE PAIS_ID = ? AND ESTADO_ID = 1
                ORDER BY PROVINCIA;';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $paisID);
        $query->execute();

        return $resultado = $query->fetchAll();
    }

    public function obtener_detalles_provincias_por_pais_ID_provincia_ID($paisID, $provinciaID)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT PAIS_ID,
                         PROVINCIA_ID,
                         UCASE(PROVINCIA) AS PROVINCIA
                    FROM PROVINCIAS 
                   WHERE PAIS_ID = ? AND PROVINCIA_ID = ?;';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $paisID);
        $query->bindValue(2, $provinciaID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function modificar_provincias_por_pais_ID_provincia_ID($modificarPaisID, $modificarProvincia, $modificadoPor, $paisID, $provinciaID)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'UPDATE PROVINCIAS SET PAIS_ID = ?,
 					                    PROVINCIA = ?,
                                        MODIFICADO_POR = ?,
                                        FECHA_MODIFICACION = NOW()
                                  WHERE PAIS_ID = ?
                                    AND PROVINCIA_ID = ?;';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $modificarPaisID);
        $query->bindValue(2, $modificarProvincia);
        $query->bindValue(3, $modificadoPor);
        $query->bindValue(4, $paisID);
        $query->bindValue(5, $provinciaID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }
}
