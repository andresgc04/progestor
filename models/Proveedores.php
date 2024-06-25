<?php
class Proveedores extends Connection
{
   public function registrar_proveedores(
      $nombreProveedor,
      $paisID,
      $provinciaID,
      $ciudadID,
      $direccion,
      $telefono,
      $correoElectronico,
      $condicionPagoID,
      $tipoProveedorID,
      $representanteVentas,
      $contactoRepresentanteVentas,
      $creadoPor
   ) {
      $conectar = parent::Connection();
      parent::set_names();

      $query = 'INSERT INTO PROVEEDORES (nombre_proveedor, pais_id, provincia_id, ciudad_id, direccion,
                                         telefono, correo_electronico, condicion_pago_id, tipo_proveedor_id,
                                         representante_ventas, contacto_representante_ventas, estado_id, creado_por, 
                                         fecha_creacion
                                        )
                                  VALUES(?, ?, ?, ?, ?,
                                         ?, ?, ?, ?, ?,
                                         ?, 1, ?, NOW()
                                        );';

      $query = $conectar->prepare($query);
      $query->bindValue(1, $nombreProveedor);
      $query->bindValue(2, $paisID);
      $query->bindValue(3, $provinciaID);
      $query->bindValue(4, $ciudadID);
      $query->bindValue(5, $direccion);
      $query->bindValue(6, $telefono);
      $query->bindValue(7, $correoElectronico);
      $query->bindValue(8, $condicionPagoID);
      $query->bindValue(9, $tipoProveedorID);
      $query->bindValue(10, $representanteVentas);
      $query->bindValue(11, $contactoRepresentanteVentas);
      $query->bindValue(12, $creadoPor);
      $query->execute();

      return $resultado = $query->fetchAll();
   }

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
