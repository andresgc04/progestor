<?php
class RecursosMaterialesProyectosObrasCiviles extends Connection
{
    public function registrar_recursos_materiales_proyectos_obras_civiles(
        $proyectoObraCivilID,
        $faseProyectoID,
        $proveedorID,
        $tipoRecursoMaterialID,
        $recursoMaterialID,
        $unidadMedida,
        $cantidadRecursoMaterial,
        $costoRecursoMaterial,
        $subTotal,
        $itbis,
        $costoTotal,
        $creadoPor
    ) {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'INSERT INTO RECURSOS_MATERIALES_PROYECTOS_OBRAS_CIVILES (PROYECTO_OBRA_CIVIL_ID, FASE_PROYECTO_ID,
                                                                           PROVEEDOR_ID, TIPO_RECURSO_MATERIAL_ID,
                                                                           RECURSO_MATERIAL_ID, UNIDAD_MEDIDA,
                                                                           CANTIDAD_RECURSO_MATERIAL, COSTO_RECURSO_MATERIAL,
                                                                           SUB_TOTAL, ITBIS, 
                                                                           COSTO_TOTAL, ESTADO_ID,
                                                                           CREADO_POR, FECHA_CREACION
                                                                          )
                                                                    VALUES(?, ?,
                                                                           ?, ?,
                                                                           ?, ?,
                                                                           ?, ?,
                                                                           ?, ?,
                                                                           ?, 1, 
                                                                           ?, NOW()
                                                                          );';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $proyectoObraCivilID);
        $query->bindValue(2, $faseProyectoID);
        $query->bindValue(3, $proveedorID);
        $query->bindValue(4, $tipoRecursoMaterialID);
        $query->bindValue(5, $recursoMaterialID);
        $query->bindValue(6, $unidadMedida);
        $query->bindValue(7, $cantidadRecursoMaterial);
        $query->bindValue(8, $costoRecursoMaterial);
        $query->bindValue(9, $subTotal);
        $query->bindValue(10, $itbis);
        $query->bindValue(11, $costoTotal);
        $query->bindValue(12, $creadoPor);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function listado_recursos_materiales_proyectos_obras_civiles_por_proyecto_obra_civil_ID($proyectoObraCivilID)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT recursosMaterialesProyectosObrasCiviles.RECURSO_MATERIAL_PROYECTO_OBRA_CIVIL_ID,
    	                 recursosMaterialesProyectosObrasCiviles.PROYECTO_OBRA_CIVIL_ID,
                         UCASE(fasesProyectos.FASE_PROYECTO) AS FASE_PROYECTO,
                         UCASE(tiposRecursosMateriales.TIPO_RECURSO_MATERIAL) AS TIPO_RECURSO_MATERIAL,
                         UCASE(recursosMateriales.RECURSO_MATERIAL) AS RECURSO_MATERIAL,
                         recursosMaterialesProyectosObrasCiviles.COSTO_TOTAL,
                         UCASE(estados.ESTADO) AS ESTADO
                    FROM RECURSOS_MATERIALES_PROYECTOS_OBRAS_CIVILES recursosMaterialesProyectosObrasCiviles
              INNER JOIN FASES_PROYECTOS fasesProyectos
                      ON recursosMaterialesProyectosObrasCiviles.FASE_PROYECTO_ID = fasesProyectos.FASE_PROYECTO_ID
              INNER JOIN TIPOS_RECURSOS_MATERIALES tiposRecursosMateriales
                      ON recursosMaterialesProyectosObrasCiviles.TIPO_RECURSO_MATERIAL_ID = 
                         tiposRecursosMateriales.TIPO_RECURSO_MATERIAL_ID
              INNER JOIN RECURSOS_MATERIALES recursosMateriales
	                  ON recursosMaterialesProyectosObrasCiviles.RECURSO_MATERIAL_ID = 
                         recursosMateriales.RECURSO_MATERIAL_ID
              INNER JOIN ESTADOS estados
                      ON recursosMaterialesProyectosObrasCiviles.ESTADO_ID = estados.ESTADO_ID
                   WHERE recursosMaterialesProyectosObrasCiviles.PROYECTO_OBRA_CIVIL_ID = ?
                     AND recursosMaterialesProyectosObrasCiviles.ESTADO_ID = 1;';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $proyectoObraCivilID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }
}
