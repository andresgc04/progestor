<?php
class Ciudades extends Connection
{
    public function registrar_ciudad($paisID, $provinciaID, $ciudad, $creadoPor)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'INSERT INTO CIUDADES (PAIS_ID, PROVINCIA_ID, CIUDAD, ESTADO_ID, CREADO_POR, FECHA_CREACION)
                                 VALUES(?, ?, ?, 1, ?, NOW());';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $paisID);
        $query->bindValue(2, $provinciaID);
        $query->bindValue(3, $ciudad);
        $query->bindValue(4, $creadoPor);
        $query->execute();

        return $resultado = $query->fetchAll();
    }

    public function listado_ciudades()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT ciudades.PAIS_ID, ciudades.PROVINCIA_ID, ciudades.CIUDAD_ID,
                         UCASE(paises.PAIS) PAIS, UCASE(provincias.PROVINCIA) PROVINCIA,
                         UCASE(ciudades.CIUDAD) CIUDAD, UCASE(estados.ESTADO) ESTADO
                        FROM CIUDADES ciudades
                  INNER JOIN PAISES paises 
                          ON ciudades.pais_id = paises.pais_id
                  INNER JOIN PROVINCIAS provincias
                          ON ciudades.provincia_id = provincias.provincia_id
                  INNER JOIN ESTADOS estados
                          ON ciudades.estado_id = estados.estado_id
                       WHERE ciudades.estado_id = 1
                    ORDER BY ciudades.CIUDAD_ID DESC, ciudades.FECHA_CREACION DESC;';

        $query = $conectar->prepare($query);
        $query->execute();

        return $resultado = $query->fetchAll();
    }

    public function obtener_listado_opciones_ciudades()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT CIUDAD_ID, CIUDAD 
                    FROM CIUDADES
                   WHERE ESTADO_ID = 1';

        $query = $conectar->prepare($query);
        $query->execute();

        return $resultado = $query->fetchAll();
    }

    public function obtener_listado_opciones_ciudades_por_paisID_provinciaID($paisID, $provinciaID)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT CIUDAD_ID, CIUDAD 
                    FROM CIUDADES
                   WHERE PAIS_ID = ? AND PROVINCIA_ID = ? AND ESTADO_ID = 1;
                 ';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $paisID);
        $query->bindValue(2, $provinciaID);
        $query->execute();

        return $resultado = $query->fetchAll();
    }

    public function obtener_detalles_ciudades_por_pais_ID_provincia_ID_ciudad_ID($paisID, $provinciaID, $ciudadID)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT PAIS_ID, PROVINCIA_ID, CIUDAD_ID,
	                     UCASE(CIUDAD) AS CIUDAD
                    FROM CIUDADES 
                   WHERE PAIS_ID = ? 
                     AND PROVINCIA_ID = ?
                     AND CIUDAD_ID = ?;';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $paisID);
        $query->bindValue(2, $provinciaID);
        $query->bindValue(3, $ciudadID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function modificar_ciudades_por_pais_ID_provincia_ID_ciudad_ID(
        $modificarPaisID,
        $modificarProvinciaID,
        $modificarCiudad,
        $modificadoPor,
        $paisID,
        $provinciaID,
        $ciudadID
    ) {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'UPDATE CIUDADES SET PAIS_ID = ?,
					                  PROVINCIA_ID = ?,
                                      CIUDAD = UCASE(?),
                                      MODIFICADO_POR = ?,
                                      FECHA_MODIFICACION = NOW()
                                WHERE PAIS_ID = ?
                                  AND PROVINCIA_ID = ?
                                  AND CIUDAD_ID = ?;';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $modificarPaisID);
        $query->bindValue(2, $modificarProvinciaID);
        $query->bindValue(3, $modificarCiudad);
        $query->bindValue(4, $modificadoPor);
        $query->bindValue(5, $paisID);
        $query->bindValue(6, $provinciaID);
        $query->bindValue(7, $ciudadID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }
}
