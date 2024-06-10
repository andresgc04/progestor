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
}
