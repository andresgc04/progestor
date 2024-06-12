<?php
class RecursosMateriales extends Connection
{
    public function registrar_recursos_materiales($tipoRecursoMaterialID, $recursoMaterial, $creadoPor)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'INSERT INTO RECURSOS_MATERIALES (TIPO_RECURSO_MATERIAL_ID, RECURSO_MATERIAL,
                                                   ESTADO_ID, CREADO_POR, FECHA_CREACION)
                       VALUES (?, ?, 1, ?, NOW());';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $tipoRecursoMaterialID);
        $query->bindValue(2, $recursoMaterial);
        $query->bindValue(3, $creadoPor);
        $query->execute();

        return $resultado = $query->fetchAll();
    }

    public function listado_recursos_materiales()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT recursosMateriales.TIPO_RECURSO_MATERIAL_ID, 
                         recursosMateriales.RECURSO_MATERIAL_ID,
                         UCASE(tiposRecursosMateriales.TIPO_RECURSO_MATERIAL) TIPOS_RECURSOS_MATERIALES,
                         UCASE(recursosMateriales.RECURSO_MATERIAL) RECURSOS_MATERIALES,
                         UCASE(estados.ESTADO) ESTADOS
                    FROM RECURSOS_MATERIALES recursosMateriales
              INNER JOIN TIPOS_RECURSOS_MATERIALES tiposRecursosMateriales
                      ON recursosMateriales.TIPO_RECURSO_MATERIAL_ID = 
                         tiposRecursosMateriales.TIPO_RECURSO_MATERIAL_ID
              INNER JOIN ESTADOS estados 
                      ON recursosMateriales.ESTADO_ID = estados.ESTADO_ID
                   WHERE recursosMateriales.ESTADO_ID = 1
                ORDER BY recursosMateriales.RECURSO_MATERIAL_ID DESC,
                         recursosMateriales.FECHA_CREACION DESC;
                 ';

        $query = $conectar->prepare($query);
        $query->execute();

        return $resultado = $query->fetchAll();
    }
}
