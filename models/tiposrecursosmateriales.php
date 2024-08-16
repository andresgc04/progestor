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

        $resultado = $query->fetchAll();

        return $resultado;
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

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function obtener_detalles_tipos_recursos_materiales_por_tipo_recurso_material_ID($tipoRecursoMaterialID)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT TIPO_RECURSO_MATERIAL_ID,
                         UCASE(TIPO_RECURSO_MATERIAL) AS TIPO_RECURSO_MATERIAL
                    FROM TIPOS_RECURSOS_MATERIALES
                   WHERE TIPO_RECURSO_MATERIAL_ID = ?;';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $tipoRecursoMaterialID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function modificar_tipos_recursos_materiales($tipoRecursoMaterial, $modificadoPor, $tipoRecursoMaterialID)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'UPDATE TIPOS_RECURSOS_MATERIALES SET TIPO_RECURSO_MATERIAL = UCASE(?), MODIFICADO_POR = ?,
									                   FECHA_MODIFICACION = NOW()
                                                 WHERE TIPO_RECURSO_MATERIAL_ID = ?;';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $tipoRecursoMaterial);
        $query->bindValue(2, $modificadoPor);
        $query->bindValue(3, $tipoRecursoMaterialID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function eliminar_tipos_recursos_materiales($modificadoPor, $tipoRecursoMaterialID)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'UPDATE TIPOS_RECURSOS_MATERIALES SET ESTADO_ID = 4, 
									                   MODIFICADO_POR = ?,
                                                       FECHA_MODIFICACION = NOW()
                                                 WHERE TIPO_RECURSO_MATERIAL_ID = ?;';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $modificadoPor);
        $query->bindValue(2, $tipoRecursoMaterialID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function obtener_listado_opciones_tipos_recursos_materiales()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT TIPO_RECURSO_MATERIAL_ID, TIPO_RECURSO_MATERIAL 
                    FROM TIPOS_RECURSOS_MATERIALES
                   WHERE ESTADO_ID = 1
                ORDER BY TIPO_RECURSO_MATERIAL ASC;';

        $query = $conectar->prepare($query);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function obtener_listado_opciones_tipos_recursos_materiales_por_tipo_recurso_material_ID($tipoRecursoMaterialID)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT TIPO_RECURSO_MATERIAL_ID,
	                     UCASE(TIPO_RECURSO_MATERIAL) AS TIPO_RECURSO_MATERIAL
                    FROM TIPOS_RECURSOS_MATERIALES
                   WHERE TIPO_RECURSO_MATERIAL_ID = ?
                     AND ESTADO_ID = 1;';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $tipoRecursoMaterialID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }
}
