<?php
class SolicitudesProyectos extends Connection
{
   public function registrar_solicitudes_proyectos(
      $descripcionProyecto,
      $objetivoProyecto,
      $presupuestoProyecto,
      $descripcionRequerimiento,
      $creadoPor
   ) {
      $conectar = parent::Connection();
      parent::set_names();

      try {
         // Iniciar la transacción
         $conectar->beginTransaction();

         // Insertar la solicitud del proyecto
         $queryInsertarSolicitudesProyectos = 'INSERT INTO SOLICITUDES_PROYECTOS (
              descripcion_proyecto,
              objetivo_proyecto,
              presupuesto_proyecto,
              estado_id,
              creado_por,
              fecha_creacion
          ) VALUES (?, ?, ?, 1, ?, NOW())';

         $stmtSolicitud = $conectar->prepare($queryInsertarSolicitudesProyectos);
         $stmtSolicitud->execute([
            $descripcionProyecto,
            $objetivoProyecto,
            $presupuestoProyecto,
            $creadoPor
         ]);

         // Obtener el ID de la última inserción
         $solicitudProyectoID = $conectar->lastInsertId();

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
                         UCASE(solicitudesProyectos.creado_por) AS solicitado_por,
                         DATE_FORMAT(solicitudesProyectos.fecha_creacion, '%d/%m/%Y') AS fecha_solicitud,
                         UCASE(estados.estado) AS estado
                    FROM SOLICITUDES_PROYECTOS solicitudesProyectos
              INNER JOIN USUARIOS usuarios
                      ON solicitudesProyectos.creado_por = usuarios.usuario_id
                         INNER JOIN CLIENTES clientes
                      ON usuarios.cliente_id = clientes.cliente_id
                         INNER JOIN ESTADOS estados
                      ON solicitudesProyectos.estado_id = estados.estado_id
                   WHERE solicitudesProyectos.creado_por = ?
                ORDER BY solicitudesProyectos.solicitud_proyecto_id DESC, 
                         solicitudesProyectos.fecha_creacion DESC;";

      $query = $conectar->prepare($query);
      $query->bindValue(1, $usuarioID);
      $query->execute();

      return $resultado = $query->fetchAll();
   }
}
