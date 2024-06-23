<?php
class TiposProveedores extends Connection
{
    public function listado_tipos_proveedores()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT tiposProveedores.TIPO_PROVEEDOR_ID,
                         tiposProveedores.TIPO_PROVEEDOR,
                         UCASE(estados.ESTADO) ESTADO
                    FROM TIPOS_PROVEEDORES tiposProveedores
                         INNER JOIN ESTADOS estados
                      ON tiposProveedores.estado_id = estados.estado_id
                   WHERE tiposProveedores.ESTADO_ID = 1;';

        $query = $conectar->prepare($query);
        $query->execute();

        return $resultado = $query->fetchAll();
    }
}
