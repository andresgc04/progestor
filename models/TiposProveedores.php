<?php
class TiposProveedores extends Connection
{
    public function registrar_tipos_proveedores($tipoProveedor, $creadoPor)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'INSERT INTO TIPOS_PROVEEDORES (tipo_proveedor, estado_id, creado_por, fecha_creacion)
                                          VALUES(?, 1, ?, NOW());';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $tipoProveedor);
        $query->bindValue(2, $creadoPor);
        $query->execute();

        return $resultado = $query->fetchAll();
    }

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
                   WHERE tiposProveedores.ESTADO_ID = 1
                ORDER BY tiposProveedores.TIPO_PROVEEDOR_ID DESC, tiposProveedores.FECHA_CREACION DESC;';

        $query = $conectar->prepare($query);
        $query->execute();

        return $resultado = $query->fetchAll();
    }

    public function obtener_listado_opciones_tipos_proveedores()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT TIPO_PROVEEDOR_ID, TIPO_PROVEEDOR 
                    FROM TIPOS_PROVEEDORES
                   WHERE ESTADO_ID = 1;';

        $query = $conectar->prepare($query);
        $query->execute();

        return $resultado = $query->fetchAll();
    }
}
