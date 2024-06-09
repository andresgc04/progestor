<?php
class Ciudades extends Connection
{
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
}
