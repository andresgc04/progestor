<?php
class TiposRecursosMateriales extends Connection
{
    public function registrar_tipos_recursos_materiales($tipoRecursoMaterial, $creadoPor)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'INSERT INTO TIPOS_RECURSOS_MATERIALES (TIPO_RECURSO_MATERIAL, ESTADO_ID, CREADO_POR, FECHA_CREACION)
                                VALUES(?, 1, ?, NOW());
                 ';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $tipoRecursoMaterial);
        $query->bindValue(2, $creadoPor);
        $query->execute();

        return $resultado = $query->fetchAll();
    }

    public function listado_tipos_recursos_materiales()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT tiposRecursosMateriales.TIPO_RECURSO_MATERIAL_ID,
                              tiposRecursosMateriales.TIPO_RECURSO_MATERIAL,
                              estados.ESTADO ESTADOS
                         FROM TIPOS_RECURSOS_MATERIALES tiposRecursosMateriales
                   INNER JOIN ESTADOS estados
                           ON tiposRecursosMateriales.ESTADO_ID = estados.ESTADO_ID
                        WHERE tiposRecursosMateriales.ESTADO_ID = 1
                      ORDER BY tiposRecursosMateriales.TIPO_RECURSO_MATERIAL_ID DESC, tiposRecursosMateriales.FECHA_CREACION DESC;';

        $query = $conectar->prepare($query);
        $query->execute();

        return $resultado = $query->fetchAll();
    }
}
