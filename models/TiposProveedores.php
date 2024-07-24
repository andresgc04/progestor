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

    public function obtener_detalles_tipos_proveedores_por_tipo_proveedor_ID($tipoProveedorID)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT TIPO_PROVEEDOR_ID,
                         UCASE(TIPO_PROVEEDOR) AS TIPO_PROVEEDOR
                    FROM TIPOS_PROVEEDORES 
                   WHERE TIPO_PROVEEDOR_ID = ?;';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $tipoProveedorID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function modificar_tipos_proveedores_por_tipo_proveedor_ID($tipoProveedor, $tipoProveedorID, $modificadoPor)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'UPDATE TIPOS_PROVEEDORES SET TIPO_PROVEEDOR = ?,
							                   MODIFICADO_POR = ?,
                                               FECHA_MODIFICACION = NOW()
                                         WHERE TIPO_PROVEEDOR_ID = ?;';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $tipoProveedor);
        $query->bindValue(2, $modificadoPor);
        $query->bindValue(3, $tipoProveedorID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function eliminar_tipos_proveedores_por_tipo_proveedor_ID($tipoProveedorID, $modificadoPor)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'UPDATE TIPOS_PROVEEDORES SET ESTADO_ID = 4,
						                       MODIFICADO_POR = ?,
                                               FECHA_MODIFICACION = NOW()
                                         WHERE TIPO_PROVEEDOR_ID = ?;';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $modificadoPor);
        $query->bindValue(2, $tipoProveedorID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }
}
