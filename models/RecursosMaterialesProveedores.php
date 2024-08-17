<?php
class RecursosMaterialesProveedores extends Connection
{
    public function registrar_recursos_materiales_proveedores($recursoMaterialID, $proveedorID, $costoRecursoMaterial, $creadoPor)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'INSERT INTO RECURSOS_MATERIALES_PROVEEDORES (RECURSO_MATERIAL_ID, PROVEEDOR_ID, COSTO_RECURSO_MATERIAL,
                                                               ESTADO_ID, CREADO_POR, FECHA_CREACION
                                                              )
                                                        VALUES(?, ?, ?,
                                                               1, ?, NOW()
                                                              );';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $recursoMaterialID);
        $query->bindValue(2, $proveedorID);
        $query->bindValue(3, $costoRecursoMaterial);
        $query->bindValue(4, $creadoPor);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function listado_recursos_materiales_proveedores()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT recursosMaterialesProveedores.RECURSO_MATERIAL_ID,
                         recursosMaterialesProveedores.PROVEEDOR_ID,
                         UCASE(tiposRecursosMateriales.TIPO_RECURSO_MATERIAL) AS TIPO_RECURSO_MATERIAL,
                         UCASE(recursosMateriales.RECURSO_MATERIAL) AS RECURSO_MATERIAL,
                         UCASE(proveedores.NOMBRE_PROVEEDOR) AS NOMBRE_PROVEEDOR,
                         recursosMaterialesProveedores.COSTO_RECURSO_MATERIAL,
                         UCASE(estados.ESTADO) AS ESTADOS
                    FROM RECURSOS_MATERIALES_PROVEEDORES recursosMaterialesProveedores
              INNER JOIN RECURSOS_MATERIALES recursosMateriales
                      ON recursosMaterialesProveedores.RECURSO_MATERIAL_ID = recursosMateriales.RECURSO_MATERIAL_ID
              INNER JOIN TIPOS_RECURSOS_MATERIALES tiposRecursosMateriales
                      ON recursosMateriales.TIPO_RECURSO_MATERIAL_ID = tiposRecursosMateriales.TIPO_RECURSO_MATERIAL_ID
              INNER JOIN PROVEEDORES proveedores
                      ON recursosMaterialesProveedores.PROVEEDOR_ID = proveedores.PROVEEDOR_ID
              INNER JOIN ESTADOS estados
                      ON recursosMaterialesProveedores.ESTADO_ID = estados.ESTADO_ID
                   WHERE recursosMaterialesProveedores.ESTADO_ID = 1
                ORDER BY recursosMaterialesProveedores.FECHA_CREACION DESC;';

        $query = $conectar->prepare($query);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }
}
