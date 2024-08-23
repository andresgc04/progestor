<?php
class SolicitudesProyectos extends Connection
{
   public function registrar_solicitudes_proyectos(
      $nombreProyecto,
      $descripcionProyecto,
      $objetivoProyecto,
      $areaTotalTerreno,
      $dimensionMetroLargoTerreno,
      $dimensionMetroAnchoTerreno,
      $ubicacion,
      $presupuestoEstimadoProyecto,
      $fechaEstimadaDeseada,
      $verificacionTituloPropiedad,
      $documento,
      $descripcionRequerimiento,
      $creadoPor
   ) {
      $conectar = parent::Connection();
      parent::set_names();

      try {
         // Iniciar la transacción
         $conectar->beginTransaction();

         // Insertar la solicitud del proyecto
         $queryInsertarSolicitudesProyectos = 'INSERT INTO SOLICITUDES_PROYECTOS (NOMBRE_PROYECTO, DESCRIPCION_PROYECTO, OBJETIVO_PROYECTO,
                                                                                  AREA_TOTAL_TERRENO, DIMENSION_METRO_LARGO_TERRENO,
                                                                                  DIMENSION_METRO_ANCHO_TERRENO, UBICACION, 
                                                                                  PRESUPUESTO_ESTIMADO_PROYECTO, FECHA_ESTIMADA_DESEADA, VERIFICACION_TITULO_PROPIEDAD,
                                                                                  ESTADO_ID, CREADO_POR, FECHA_CREACION
                                                                                 )
                                                                           VALUES(?, ?, ?,
                                                                                  ?, ?,
                                                                                  ?, ?,
                                                                                  ?, ?, ?,
                                                                                  1, ?, NOW() 
                                                                                 );';

         $stmtSolicitud = $conectar->prepare($queryInsertarSolicitudesProyectos);
         $stmtSolicitud->execute([
            $nombreProyecto,
            $descripcionProyecto,
            $objetivoProyecto,
            $areaTotalTerreno,
            $dimensionMetroLargoTerreno,
            $dimensionMetroAnchoTerreno,
            $ubicacion,
            $presupuestoEstimadoProyecto,
            $fechaEstimadaDeseada,
            $verificacionTituloPropiedad,
            $creadoPor
         ]);

         // Obtener el ID de la última inserción
         $solicitudProyectoID = $conectar->lastInsertId();

         //Insertar Documento:
         if (isset($_FILES[$documento]) && $_FILES[$documento]['error'] == 0) {
            $fileTmpPath = $_FILES['file']['tmp_name'];
            $fileName = $_FILES['file']['name'];
            $fileSize = $_FILES['file']['size'];
            $fileType = $_FILES['file']['type'];
            $uploadDirectory = '../documents/';

            // Definir la ruta completa del archivo
            $dest_path = $uploadDirectory . $fileName;

            // Mover el archivo al directorio de destino
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
               // Guardar la información del archivo en la base de datos
               $queryInsertarDocumentoSolicitudProyecto = 'INSERT INTO DOCUMENTOS (SOLICITUD_PROYECTO_ID, NOMBRE_DOCUMENTO, TIPO_DOCUMENTO, SIZE_DOCUMENTO,
                                                                                   RUTA_DOCUMENTO, ESTADO_ID, CREADO_POR, FECHA_CREACION
                                                                                  )
                                                                            VALUES(?, ?, ?, ?,
                                                                                   ?, 1, ?, NOW()
                                                                                  );';

               $stmtDocumentoSolicitudProyecto = $conectar->prepare($queryInsertarDocumentoSolicitudProyecto);
               $stmtDocumentoSolicitudProyecto->execute([
                  $solicitudProyectoID,
                  $fileName,
                  $fileType,
                  $fileSize,
                  $dest_path,
                  $creadoPor
               ]);

               echo "El archivo se ha subido y guardado exitosamente.";
            } else {
               echo "Hubo un error al mover el archivo.";
            }
         } else {
            echo "No se seleccionó ningún archivo o hubo un error en la subida.";
         }

         // Preparar la consulta para los requerimientos
         $queryInsertarRequerimientosSolicitudesProyectos = 'INSERT INTO REQUERIMIENTOS_SOLICITUDES_PROYECTOS (
              solicitud_proyecto_id,
              descripcion_requerimiento,
              estado_id,
              creado_por,
              fecha_creacion
          ) VALUES (?, ?, 1, ?, NOW())';

         $stmtRequerimiento = $conectar->prepare($queryInsertarRequerimientosSolicitudesProyectos);

         // Insertar cada requerimiento
         foreach ($descripcionRequerimiento as $requerimiento) {
            $stmtRequerimiento->execute([
               $solicitudProyectoID,
               $requerimiento,
               $creadoPor
            ]);
         }

         // Confirmar la transacción
         $conectar->commit();

         return true;
      } catch (Exception $e) {
         // Revertir la transacción en caso de error
         $conectar->rollBack();
         error_log($e->getMessage());
         return false;
      }
   }


   public function listado_solicitudes_proyectos_por_usuarioID($usuarioID)
   {
      $conectar = parent::Connection();
      parent::set_names();

      $query = "SELECT solicitudesProyectos.solicitud_proyecto_id,
                       UCASE(solicitudesProyectos.descripcion_proyecto) AS descripcion_proyecto,
                       UCASE(solicitudesProyectos.objetivo_proyecto) AS objetivo_proyecto,
                       UCASE(clientes.nombre_cliente) AS solicitado_por,
                       DATE_FORMAT(solicitudesProyectos.fecha_creacion, '%d/%m/%Y') AS fecha_solicitud,
                       UCASE(estados.estado) AS estado
                  FROM SOLICITUDES_PROYECTOS solicitudesProyectos
            INNER JOIN USUARIOS usuarios
                    ON solicitudesProyectos.creado_por = usuarios.usuario_id
            INNER JOIN CLIENTES clientes
                    ON usuarios.cliente_id = clientes.cliente_id
            INNER JOIN ESTADOS estados
                    ON solicitudesProyectos.estado_id = estados.estado_id
                 WHERE solicitudesProyectos.estado_id IN(1, 2, 5, 6, 7) AND solicitudesProyectos.creado_por = ?
              ORDER BY solicitudesProyectos.solicitud_proyecto_id DESC, 
                       solicitudesProyectos.fecha_creacion DESC;";

      $query = $conectar->prepare($query);
      $query->bindValue(1, $usuarioID);
      $query->execute();

      return $resultado = $query->fetchAll();
   }

   public function obtener_encabezado_solicitudes_proyectos_por_solicitud_proyecto_ID($solicitudProyectoID)
   {
      $conectar = parent::Connection();
      parent::set_names();

      $query = 'SELECT solicitudesProyectos.SOLICITUD_PROYECTO_ID,
					        UCASE(solicitudesProyectos.NOMBRE_PROYECTO) AS NOMBRE_PROYECTO,
                       UCASE(solicitudesProyectos.DESCRIPCION_PROYECTO) AS DESCRIPCION_PROYECTO,
                       UCASE(solicitudesProyectos.OBJETIVO_PROYECTO) AS OBJETIVO_PROYECTO,
                       solicitudesProyectos.FECHA_ESTIMADA_DESEADA,
                       UCASE(clientes.NOMBRE_CLIENTE) AS NOMBRE_CLIENTE,
                       UCASE(estados.ESTADO) AS ESTADO
                  FROM SOLICITUDES_PROYECTOS solicitudesProyectos
            INNER JOIN USUARIOS usuarios
                    ON solicitudesProyectos.CREADO_POR = usuarios.USUARIO_ID
            INNER JOIN CLIENTES clientes
                    ON usuarios.CLIENTE_ID = clientes.CLIENTE_ID
            INNER JOIN ESTADOS estados
                    ON solicitudesProyectos.estado_id = estados.estado_id
                 WHERE solicitudesProyectos.ESTADO_ID IN(1, 2, 5, 6, 7)
                   AND solicitudesProyectos.SOLICITUD_PROYECTO_ID = ?;';

      $query = $conectar->prepare($query);
      $query->bindValue(1, $solicitudProyectoID);
      $query->execute();

      $resultado = $query->fetchAll();

      return $resultado;
   }

   public function obtener_requerimientos_solicitudes_proyectos_por_solicitud_proyecto_ID($solicitudProyectoID)
   {
      $conectar = parent::Connection();
      parent::set_names();

      $query = 'SELECT requerimientosSolicitudesProyectos.SOLICITUD_PROYECTO_ID,
                       requerimientosSolicitudesProyectos.REQUERIMIENTO_SOLICITUD_PROYECTO_ID,
                       UCASE(requerimientosSolicitudesProyectos.DESCRIPCION_REQUERIMIENTO) AS DESCRIPCION_REQUERIMIENTO,
                       UCASE(estados.ESTADO) ESTADO
                  FROM REQUERIMIENTOS_SOLICITUDES_PROYECTOS requerimientosSolicitudesProyectos
                       INNER JOIN ESTADOS estados
                    ON requerimientosSolicitudesProyectos.ESTADO_ID = estados.ESTADO_ID
                 WHERE requerimientosSolicitudesProyectos.ESTADO_ID IN(1, 2, 5, 6, 7)
                   AND requerimientosSolicitudesProyectos.SOLICITUD_PROYECTO_ID = ?;';

      $query = $conectar->prepare($query);
      $query->bindValue(1, $solicitudProyectoID);
      $query->execute();

      $resultado = $query->fetchAll();

      return $resultado;
   }

   public function modificar_solicitudes_proyectos_por_solicitud_proyecto_ID(
      $nombreProyecto,
      $descripcionProyecto,
      $objetivoProyecto,
      $fechaEstimadaDeseada,
      $modificadoPor,
      $solicitudProyectoID
   ) {
      $conectar = parent::Connection();
      parent::set_names();

      $queryModificarEncabezadoSolicitudProyecto = 'UPDATE SOLICITUDES_PROYECTOS SET NOMBRE_PROYECTO = ?, DESCRIPCION_PROYECTO = ?,
								                                                             OBJETIVO_PROYECTO = ?, FECHA_ESTIMADA_DESEADA = ?,
                                                                                     ESTADO_ID = 1, MODIFICADO_POR = ?,
                                                                                     FECHA_MODIFICACION = NOW()
                                                                               WHERE SOLICITUD_PROYECTO_ID = ?;';

      $queryModificarEncabezadoSolicitudProyecto = $conectar->prepare($queryModificarEncabezadoSolicitudProyecto);
      $queryModificarEncabezadoSolicitudProyecto->bindValue(1, $nombreProyecto);
      $queryModificarEncabezadoSolicitudProyecto->bindValue(2, $descripcionProyecto);
      $queryModificarEncabezadoSolicitudProyecto->bindValue(3, $objetivoProyecto);
      $queryModificarEncabezadoSolicitudProyecto->bindValue(4, $fechaEstimadaDeseada);
      $queryModificarEncabezadoSolicitudProyecto->bindValue(5, $modificadoPor);
      $queryModificarEncabezadoSolicitudProyecto->bindValue(6, $solicitudProyectoID);
      $queryModificarEncabezadoSolicitudProyecto->execute();

      $resultado = $queryModificarEncabezadoSolicitudProyecto->fetchAll();

      return $resultado;
   }

   public function modificar_solicitudes_proyectos_cambiar_estado_activo_cancelado_por_solicitud_proyecto_ID(
      $nombreProyecto,
      $descripcionProyecto,
      $objetivoProyecto,
      $fechaEstimadaDeseada,
      $modificadoPor,
      $solicitudProyectoID
   ) {
      $conectar = parent::Connection();
      parent::set_names();

      $queryModificarEncabezadoSolicitudProyecto = 'UPDATE SOLICITUDES_PROYECTOS SET NOMBRE_PROYECTO = ?, DESCRIPCION_PROYECTO = ?,
								                                                             OBJETIVO_PROYECTO = ?, FECHA_ESTIMADA_DESEADA = ?,
                                                                                     ESTADO_ID = 5, MODIFICADO_POR = ?,
                                                                                     FECHA_MODIFICACION = NOW()
                                                                               WHERE SOLICITUD_PROYECTO_ID = ?;';

      $queryModificarEncabezadoSolicitudProyecto = $conectar->prepare($queryModificarEncabezadoSolicitudProyecto);
      $queryModificarEncabezadoSolicitudProyecto->bindValue(1, $nombreProyecto);
      $queryModificarEncabezadoSolicitudProyecto->bindValue(2, $descripcionProyecto);
      $queryModificarEncabezadoSolicitudProyecto->bindValue(3, $objetivoProyecto);
      $queryModificarEncabezadoSolicitudProyecto->bindValue(4, $fechaEstimadaDeseada);
      $queryModificarEncabezadoSolicitudProyecto->bindValue(5, $modificadoPor);
      $queryModificarEncabezadoSolicitudProyecto->bindValue(6, $solicitudProyectoID);
      $queryModificarEncabezadoSolicitudProyecto->execute();

      $queryModificarRequerimientosSolicitudProyecto = 'UPDATE REQUERIMIENTOS_SOLICITUDES_PROYECTOS SET ESTADO_ID = 5, MODIFICADO_POR = ?,
												                                                                    FECHA_MODIFICACION = NOW()
                                                                                                  WHERE SOLICITUD_PROYECTO_ID = ?;';

      $queryModificarRequerimientosSolicitudProyecto = $conectar->prepare($queryModificarRequerimientosSolicitudProyecto);
      $queryModificarRequerimientosSolicitudProyecto->bindValue(1, $modificadoPor);
      $queryModificarRequerimientosSolicitudProyecto->bindValue(2, $solicitudProyectoID);
      $queryModificarRequerimientosSolicitudProyecto->execute();

      $resultado = $queryModificarRequerimientosSolicitudProyecto->fetchAll();

      return $resultado;
   }

   public function modificar_solicitudes_proyectos_cambiar_estado_activo_aprobado_por_solicitud_proyecto_ID(
      $nombreProyecto,
      $descripcionProyecto,
      $objetivoProyecto,
      $fechaEstimadaDeseada,
      $modificadoPor,
      $solicitudProyectoID
   ) {
      $conectar = parent::Connection();
      parent::set_names();

      $queryModificarEncabezadoSolicitudProyecto = 'UPDATE SOLICITUDES_PROYECTOS SET NOMBRE_PROYECTO = ?, DESCRIPCION_PROYECTO = ?,
								                                                             OBJETIVO_PROYECTO = ?, FECHA_ESTIMADA_DESEADA = ?,
                                                                                     ESTADO_ID = 2, MODIFICADO_POR = ?,
                                                                                     FECHA_MODIFICACION = NOW()
                                                                               WHERE SOLICITUD_PROYECTO_ID = ?;';

      $queryModificarEncabezadoSolicitudProyecto = $conectar->prepare($queryModificarEncabezadoSolicitudProyecto);
      $queryModificarEncabezadoSolicitudProyecto->bindValue(1, $nombreProyecto);
      $queryModificarEncabezadoSolicitudProyecto->bindValue(2, $descripcionProyecto);
      $queryModificarEncabezadoSolicitudProyecto->bindValue(3, $objetivoProyecto);
      $queryModificarEncabezadoSolicitudProyecto->bindValue(4, $fechaEstimadaDeseada);
      $queryModificarEncabezadoSolicitudProyecto->bindValue(5, $modificadoPor);
      $queryModificarEncabezadoSolicitudProyecto->bindValue(6, $solicitudProyectoID);
      $queryModificarEncabezadoSolicitudProyecto->execute();

      $queryModificarRequerimientosSolicitudProyecto = 'UPDATE REQUERIMIENTOS_SOLICITUDES_PROYECTOS SET ESTADO_ID = 2, MODIFICADO_POR = ?,
												                                                                    FECHA_MODIFICACION = NOW()
                                                                                                  WHERE SOLICITUD_PROYECTO_ID = ?;';

      $queryModificarRequerimientosSolicitudProyecto = $conectar->prepare($queryModificarRequerimientosSolicitudProyecto);
      $queryModificarRequerimientosSolicitudProyecto->bindValue(1, $modificadoPor);
      $queryModificarRequerimientosSolicitudProyecto->bindValue(2, $solicitudProyectoID);
      $queryModificarRequerimientosSolicitudProyecto->execute();

      $resultado = $queryModificarRequerimientosSolicitudProyecto->fetchAll();

      return $resultado;
   }

   public function agregar_nueva_descripcion_requerimiento_solicitud_proyecto($solicitudProyectoID, $descripcionRequerimiento, $creadoPor)
   {
      $conectar = parent::Connection();
      parent::set_names();

      $query = 'INSERT INTO REQUERIMIENTOS_SOLICITUDES_PROYECTOS (SOLICITUD_PROYECTO_ID, DESCRIPCION_REQUERIMIENTO, ESTADO_ID,
                                                                  CREADO_POR, FECHA_CREACION)
                                                           VALUES(?, ?, 1, ?, NOW());';

      $query = $conectar->prepare($query);
      $query->bindValue(1, $solicitudProyectoID);
      $query->bindValue(2, $descripcionRequerimiento);
      $query->bindValue(3, $creadoPor);
      $query->execute();

      $resultado = $query->fetchAll();

      return $resultado;
   }

   public function obtener_requerimiento_solicitud_proyecto_por_solicitud_proyecto_ID_requerimiento_solicitud_proyecto_ID($solicitudProyectoID, $requerimientoSolicitudProyectoID)
   {
      $conectar = parent::Connection();
      parent::set_names();

      $query = 'SELECT SOLICITUD_PROYECTO_ID, REQUERIMIENTO_SOLICITUD_PROYECTO_ID,
                       DESCRIPCION_REQUERIMIENTO
                  FROM REQUERIMIENTOS_SOLICITUDES_PROYECTOS
                 WHERE SOLICITUD_PROYECTO_ID = ? 
                   AND REQUERIMIENTO_SOLICITUD_PROYECTO_ID = ?;';

      $query = $conectar->prepare($query);
      $query->bindValue(1, $solicitudProyectoID);
      $query->bindValue(2, $requerimientoSolicitudProyectoID);
      $query->execute();

      $resultado = $query->fetchAll();

      return $resultado;
   }

   public function modificar_requerimiento_solicitud_proyecto_por_solicitud_proyecto_ID_requerimiento_solicitud_proyecto_ID(
      $descripcionRequerimiento,
      $modificadoPor,
      $solicitudProyectoID,
      $requerimientoSolicitudProyectoID
   ) {
      $conectar = parent::Connection();
      parent::set_names();

      $queryModificarRequerimientoSolicitudProyecto = 'UPDATE REQUERIMIENTOS_SOLICITUDES_PROYECTOS SET DESCRIPCION_REQUERIMIENTO = ?, MODIFICADO_POR = ?,
                                                                                                       FECHA_MODIFICACION = NOW()
                                                                                                 WHERE SOLICITUD_PROYECTO_ID = ? 
                                                                                                   AND REQUERIMIENTO_SOLICITUD_PROYECTO_ID = ?;';

      $queryModificarRequerimientoSolicitudProyecto = $conectar->prepare($queryModificarRequerimientoSolicitudProyecto);
      $queryModificarRequerimientoSolicitudProyecto->bindValue(1, $descripcionRequerimiento);
      $queryModificarRequerimientoSolicitudProyecto->bindValue(2, $modificadoPor);
      $queryModificarRequerimientoSolicitudProyecto->bindValue(3, $solicitudProyectoID);
      $queryModificarRequerimientoSolicitudProyecto->bindValue(4, $requerimientoSolicitudProyectoID);
      $queryModificarRequerimientoSolicitudProyecto->execute();

      $resultado = $queryModificarRequerimientoSolicitudProyecto->fetchAll();

      return $resultado;
   }

   public function modificar_requerimiento_solicitud_proyecto_cambiar_estado_activo_eliminado_por_solicitud_proyecto_ID_requerimiento_solicitud_proyecto_ID(
      $modificadoPor,
      $solicitudProyectoID,
      $requerimientoSolicitudProyectoID
   ) {
      $conectar = parent::Connection();
      parent::set_names();

      $queryModificarRequerimientoSolicitudProyecto = 'UPDATE REQUERIMIENTOS_SOLICITUDES_PROYECTOS SET ESTADO_ID = 4, MODIFICADO_POR = ?, FECHA_MODIFICACION = NOW()
                                                                                                 WHERE SOLICITUD_PROYECTO_ID = ? 
                                                                                                   AND REQUERIMIENTO_SOLICITUD_PROYECTO_ID = ?;';

      $queryModificarRequerimientoSolicitudProyecto = $conectar->prepare($queryModificarRequerimientoSolicitudProyecto);
      $queryModificarRequerimientoSolicitudProyecto->bindValue(1, $modificadoPor);
      $queryModificarRequerimientoSolicitudProyecto->bindValue(2, $solicitudProyectoID);
      $queryModificarRequerimientoSolicitudProyecto->bindValue(3, $requerimientoSolicitudProyectoID);
      $queryModificarRequerimientoSolicitudProyecto->execute();

      $resultado = $queryModificarRequerimientoSolicitudProyecto->fetchAll();

      return $resultado;
   }

   public function modificar_solicitud_proyecto_cambiar_estado_activo_eliminado_por_solicitud_proyecto_ID(
      $modificadoPor,
      $solicitudProyectoID,
   ) {
      $conectar = parent::Connection();
      parent::set_names();

      $queryModificarSolicitudProyecto = 'UPDATE SOLICITUDES_PROYECTOS SET ESTADO_ID = 4, MODIFICADO_POR = ?,
  								                                                   FECHA_MODIFICACION = NOW()
                                                                     WHERE SOLICITUD_PROYECTO_ID = ?;';

      $queryModificarSolicitudProyecto = $conectar->prepare($queryModificarSolicitudProyecto);
      $queryModificarSolicitudProyecto->bindValue(1, $modificadoPor);
      $queryModificarSolicitudProyecto->bindValue(2, $solicitudProyectoID);
      $queryModificarSolicitudProyecto->execute();

      $queryModificarRequerimientoSolicitudProyecto = 'UPDATE REQUERIMIENTOS_SOLICITUDES_PROYECTOS SET ESTADO_ID = 4, MODIFICADO_POR = ?,
  												                                                                   FECHA_MODIFICACION = NOW()
						   				                                                                WHERE SOLICITUD_PROYECTO_ID = ?;';

      $queryModificarRequerimientoSolicitudProyecto = $conectar->prepare($queryModificarRequerimientoSolicitudProyecto);
      $queryModificarRequerimientoSolicitudProyecto->bindValue(1, $modificadoPor);
      $queryModificarRequerimientoSolicitudProyecto->bindValue(2, $solicitudProyectoID);
      $queryModificarRequerimientoSolicitudProyecto->execute();

      $resultado = $queryModificarRequerimientoSolicitudProyecto->fetchAll();

      return $resultado;
   }

   public function ver_listado_solicitudes_proyectos()
   {
      $conectar = parent::Connection();
      parent::set_names();

      $query = "SELECT solicitudesProyectos.solicitud_proyecto_id,
                       UCASE(solicitudesProyectos.descripcion_proyecto) AS descripcion_proyecto,
                       UCASE(solicitudesProyectos.objetivo_proyecto) AS objetivo_proyecto,
                       UCASE(clientes.nombre_cliente) AS solicitado_por,
                       DATE_FORMAT(solicitudesProyectos.fecha_creacion, '%d/%m/%Y') AS fecha_solicitud,
                       UCASE(estados.estado) AS estado
                  FROM SOLICITUDES_PROYECTOS solicitudesProyectos
            INNER JOIN USUARIOS usuarios
                    ON solicitudesProyectos.creado_por = usuarios.usuario_id
            INNER JOIN CLIENTES clientes
                    ON usuarios.cliente_id = clientes.cliente_id
            INNER JOIN ESTADOS estados
                    ON solicitudesProyectos.estado_id = estados.estado_id
                 WHERE solicitudesProyectos.estado_id IN(2, 6, 7)
              ORDER BY solicitudesProyectos.solicitud_proyecto_id DESC, 
                       solicitudesProyectos.fecha_creacion DESC;";

      $query = $conectar->prepare($query);
      $query->execute();

      return $resultado = $query->fetchAll();
   }

   public function modificar_solicitud_proyecto_cambiar_estado_pendiente_rechazado_por_solicitud_proyecto_ID(
      $modificadoPor,
      $solicitudProyectoID,
   ) {
      $conectar = parent::Connection();
      parent::set_names();

      $queryModificarSolicitudProyecto = 'UPDATE SOLICITUDES_PROYECTOS SET ESTADO_ID = 6, MODIFICADO_POR = ?,
  								                                                   FECHA_MODIFICACION = NOW()
                                                                     WHERE SOLICITUD_PROYECTO_ID = ?;';

      $queryModificarSolicitudProyecto = $conectar->prepare($queryModificarSolicitudProyecto);
      $queryModificarSolicitudProyecto->bindValue(1, $modificadoPor);
      $queryModificarSolicitudProyecto->bindValue(2, $solicitudProyectoID);
      $queryModificarSolicitudProyecto->execute();

      $queryModificarRequerimientoSolicitudProyecto = 'UPDATE REQUERIMIENTOS_SOLICITUDES_PROYECTOS SET ESTADO_ID = 6, MODIFICADO_POR = ?,
  												                                                                   FECHA_MODIFICACION = NOW()
						   				                                                                WHERE SOLICITUD_PROYECTO_ID = ?;';

      $queryModificarRequerimientoSolicitudProyecto = $conectar->prepare($queryModificarRequerimientoSolicitudProyecto);
      $queryModificarRequerimientoSolicitudProyecto->bindValue(1, $modificadoPor);
      $queryModificarRequerimientoSolicitudProyecto->bindValue(2, $solicitudProyectoID);
      $queryModificarRequerimientoSolicitudProyecto->execute();

      $resultado = $queryModificarRequerimientoSolicitudProyecto->fetchAll();

      return $resultado;
   }

   public function modificar_solicitud_proyecto_cambiar_estado_pendiente_aprobado_por_solicitud_proyecto_ID(
      $modificadoPor,
      $solicitudProyectoID,
   ) {
      $conectar = parent::Connection();
      parent::set_names();

      $queryModificarSolicitudProyecto = 'UPDATE SOLICITUDES_PROYECTOS SET ESTADO_ID = 7, MODIFICADO_POR = ?,
  								                                                   FECHA_MODIFICACION = NOW()
                                                                     WHERE SOLICITUD_PROYECTO_ID = ?;';

      $queryModificarSolicitudProyecto = $conectar->prepare($queryModificarSolicitudProyecto);
      $queryModificarSolicitudProyecto->bindValue(1, $modificadoPor);
      $queryModificarSolicitudProyecto->bindValue(2, $solicitudProyectoID);
      $queryModificarSolicitudProyecto->execute();

      $queryModificarRequerimientoSolicitudProyecto = 'UPDATE REQUERIMIENTOS_SOLICITUDES_PROYECTOS SET ESTADO_ID = 7, MODIFICADO_POR = ?,
  												                                                                   FECHA_MODIFICACION = NOW()
						   				                                                                WHERE SOLICITUD_PROYECTO_ID = ?;';

      $queryModificarRequerimientoSolicitudProyecto = $conectar->prepare($queryModificarRequerimientoSolicitudProyecto);
      $queryModificarRequerimientoSolicitudProyecto->bindValue(1, $modificadoPor);
      $queryModificarRequerimientoSolicitudProyecto->bindValue(2, $solicitudProyectoID);
      $queryModificarRequerimientoSolicitudProyecto->execute();

      $resultado = $queryModificarRequerimientoSolicitudProyecto->fetchAll();

      return $resultado;
   }
}
