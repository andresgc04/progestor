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
                         UCASE(unidadesMedidas.UNIDAD_MEDIDA) AS UNIDAD_MEDIDA,
                         UCASE(estados.ESTADO) ESTADOS
                    FROM RECURSOS_MATERIALES recursosMateriales
              INNER JOIN TIPOS_RECURSOS_MATERIALES tiposRecursosMateriales
                      ON recursosMateriales.TIPO_RECURSO_MATERIAL_ID = 
                         tiposRecursosMateriales.TIPO_RECURSO_MATERIAL_ID
              INNER JOIN UNIDADES_MEDIDAS unidadesMedidas
		              ON recursosMateriales.UNIDAD_MEDIDA_ID = unidadesMedidas.UNIDAD_MEDIDA_ID
              INNER JOIN ESTADOS estados 
                      ON recursosMateriales.ESTADO_ID = estados.ESTADO_ID
                   WHERE recursosMateriales.ESTADO_ID = 1
                ORDER BY recursosMateriales.RECURSO_MATERIAL_ID DESC,
                         recursosMateriales.FECHA_CREACION DESC;';

        $query = $conectar->prepare($query);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function obtener_detalles_recursos_materiales_por_tipo_recurso_material_ID_recurso_material_ID($tipoRecursoMaterialID, $recursoMaterialID)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT RECURSO_MATERIAL_ID,
	                     TIPO_RECURSO_MATERIAL_ID,
                         UCASE(RECURSO_MATERIAL) AS RECURSO_MATERIAL
                    FROM RECURSOS_MATERIALES 
                   WHERE TIPO_RECURSO_MATERIAL_ID = ? 
                     AND RECURSO_MATERIAL_ID = ?';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $tipoRecursoMaterialID);
        $query->bindValue(2, $recursoMaterialID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function modificar_recursos_materiales(
        $modificarTipoRecursoMaterialID,
        $recursoMaterial,
        $modificadoPor,
        $tipoRecursoMaterialID,
        $recursoMaterialID
    ) {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'UPDATE RECURSOS_MATERIALES SET TIPO_RECURSO_MATERIAL_ID = ?,
							                     RECURSO_MATERIAL = ?,
                                                 MODIFICADO_POR = ?,
                                                 FECHA_MODIFICACION = NOW()
                                           WHERE TIPO_RECURSO_MATERIAL_ID = ?
                                             AND RECURSO_MATERIAL_ID = ?;';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $modificarTipoRecursoMaterialID);
        $query->bindValue(2, $recursoMaterial);
        $query->bindValue(3, $modificadoPor);
        $query->bindValue(4, $tipoRecursoMaterialID);
        $query->bindValue(5, $recursoMaterialID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function eliminar_recursos_materiales(
        $modificadoPor,
        $tipoRecursoMaterialID,
        $recursoMaterialID
    ) {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'UPDATE RECURSOS_MATERIALES SET ESTADO_ID = 4,
							                     MODIFICADO_POR = ?,
                                                 FECHA_MODIFICACION = NOW()
                                           WHERE TIPO_RECURSO_MATERIAL_ID = ?
                                             AND RECURSO_MATERIAL_ID = ?;';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $modificadoPor);
        $query->bindValue(2, $tipoRecursoMaterialID);
        $query->bindValue(3, $recursoMaterialID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function obtener_listado_opciones_recursos_materiales()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT RECURSO_MATERIAL_ID,
   		                 UCASE(RECURSO_MATERIAL) AS RECURSO_MATERIAL
                    FROM RECURSOS_MATERIALES 
                   WHERE ESTADO_ID = 1
                ORDER BY RECURSO_MATERIAL ASC;';

        $query = $conectar->prepare($query);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function obtener_listado_opciones_recursos_materiales_por_tipo_recurso_material_ID($tipoRecursoMaterialID)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT RECURSO_MATERIAL_ID,
   		                 UCASE(RECURSO_MATERIAL) AS RECURSO_MATERIAL
                    FROM RECURSOS_MATERIALES 
                   WHERE TIPO_RECURSO_MATERIAL_ID = ? AND ESTADO_ID = 1
                ORDER BY RECURSO_MATERIAL ASC;';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $tipoRecursoMaterialID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function obtener_listado_opciones_recursos_materiales_por_recurso_material_ID($recursoMaterialID)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT RECURSO_MATERIAL_ID, 
                         UCASE(RECURSO_MATERIAL) AS RECURSO_MATERIAL
                    FROM RECURSOS_MATERIALES 
                   WHERE RECURSO_MATERIAL_ID = ?
                     AND ESTADO_ID = 1;';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $recursoMaterialID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function obtener_listado_opciones_recursos_materiales_diferente_recurso_material_ID($recursoMaterialID)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT RECURSO_MATERIAL_ID, 
                         UCASE(RECURSO_MATERIAL) AS RECURSO_MATERIAL
                    FROM RECURSOS_MATERIALES 
                   WHERE RECURSO_MATERIAL_ID != ?
                     AND ESTADO_ID = 1;';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $recursoMaterialID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }
}
