<?php
class RecursosMaterialesProveedores extends Connection
{
    public function listado_recursos_materiales_proveedores()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT UCASE(tiposRecursosMateriales.TIPO_RECURSO_MATERIAL) AS TIPO_RECURSO_MATERIAL,
    	                 UCASE(recursosMateriales.RECURSO_MATERIAL) AS RECURSO_MATERIAL,
                         UCASE(proveedores.NOMBRE_PROVEEDOR) AS NOMBRE_PROVEEDOR,
                         UCASE(estados.ESTADO) AS ESTADO
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
