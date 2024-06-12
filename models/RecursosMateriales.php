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

        $query = '';

        $query = $conectar->prepare($query);
        $query->execute();

        return $resultado = $query->fetchAll();
    }
}
