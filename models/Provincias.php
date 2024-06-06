<?php
class Provincias extends Connection
{
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
}
