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

        public function obtener_detalles_recursos_materiales_proveedores_por_recurso_material_ID_proveedor_ID($recursoMaterialID, $proveedorID)
        {
                $conectar = parent::Connection();
                parent::set_names();

                $query = 'SELECT recursosMateriales.TIPO_RECURSO_MATERIAL_ID,
    	                         recursosMaterialesProveedores.RECURSO_MATERIAL_ID,
                                 recursosMaterialesProveedores.PROVEEDOR_ID,
                                 recursosMaterialesProveedores.COSTO_RECURSO_MATERIAL
                            FROM RECURSOS_MATERIALES_PROVEEDORES recursosMaterialesProveedores
                      INNER JOIN RECURSOS_MATERIALES recursosMateriales 
                              ON recursosMaterialesProveedores.RECURSO_MATERIAL_ID = recursosMateriales.RECURSO_MATERIAL_ID
	                   WHERE recursosMaterialesProveedores.RECURSO_MATERIAL_ID = ? AND recursosMaterialesProveedores.PROVEEDOR_ID = ?;';

                $query = $conectar->prepare($query);
                $query->bindValue(1, $recursoMaterialID);
                $query->bindValue(2, $proveedorID);
                $query->execute();

                $resultado = $query->fetchAll();

                return $resultado;
        }

        public function modificar_recursos_materiales_proveedores(
                $modificarRecursoMaterialID,
                $modificarProveedorID,
                $modificarCostoRecursoMaterial,
                $modificadoPor,
                $recursoMaterialID,
                $proveedorID
        ) {
                $conectar = parent::Connection();
                parent::set_names();

                $query = 'UPDATE RECURSOS_MATERIALES_PROVEEDORES SET RECURSO_MATERIAL_ID = ?, PROVEEDOR_ID = ?,
								     COSTO_RECURSO_MATERIAL = ?, MODIFICADO_POR = ?,
                                                                     FECHA_MODIFICACION = NOW()
                                                               WHERE RECURSO_MATERIAL_ID = ? 
                                                                 AND PROVEEDOR_ID = ?;';

                $query = $conectar->prepare($query);
                $query->bindValue(1, $modificarRecursoMaterialID);
                $query->bindValue(2, $modificarProveedorID);
                $query->bindValue(3, $modificarCostoRecursoMaterial);
                $query->bindValue(4, $modificadoPor);
                $query->bindValue(5, $recursoMaterialID);
                $query->bindValue(6, $proveedorID);
                $query->execute();

                $resultado = $query->fetchAll();

                return $resultado;
        }

        public function eliminar_recursos_materiales_proveedores(
                $modificadoPor,
                $recursoMaterialID,
                $proveedorID
        ) {
                $conectar = parent::Connection();
                parent::set_names();

                $query = 'UPDATE RECURSOS_MATERIALES_PROVEEDORES SET ESTADO_ID = 4,
 							             MODIFICADO_POR = ?,
                                                                     FECHA_MODIFICACION = NOW()
                                                               WHERE RECURSO_MATERIAL_ID = ? AND PROVEEDOR_ID = ?;';

                $query = $conectar->prepare($query);
                $query->bindValue(1, $modificadoPor);
                $query->bindValue(2, $recursoMaterialID);
                $query->bindValue(3, $proveedorID);
                $query->execute();

                $resultado = $query->fetchAll();

                return $resultado;
        }
}
