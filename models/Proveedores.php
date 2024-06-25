<?php
class Proveedores extends Connection
{
    public function listado_proveedores()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT proveedores.proveedor_id,
                         UCASE(proveedores.nombre_proveedor) proveedor,
                         UCASE(tiposProveedores.tipo_proveedor) tipo_proveedor,
                         UCASE(estados.estado) estado
                    FROM PROVEEDORES proveedores
                         INNER JOIN TIPOS_PROVEEDORES tiposProveedores
                      ON proveedores.tipo_proveedor_id = tiposProveedores.tipo_proveedor_id
                         INNER JOIN ESTADOS estados
                      ON proveedores.estado_id = estados.estado_id
                   WHERE proveedores.estado_id = 1
                ORDER BY proveedores.proveedor_id DESC, proveedores.fecha_creacion DESC;';

        $query = $conectar->prepare($query);
        $query->execute();

        return $resultado = $query->fetchAll();
    }
}
