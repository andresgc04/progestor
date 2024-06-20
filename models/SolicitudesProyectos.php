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

      $queryInsertarSolicitudesProyectos = 'INSERT INTO SOLICITUDES_PROYECTOS (descripcion_proyecto,
                                                                               objetivo_proyecto,
                                                                               presupuesto_proyecto,
                                                                               estado_id,
                                                                               creado_por,
                                                                               fecha_creacion
                                                                              )
                                                                        VALUES(?, ?, ?, 1, ?, NOW());';

      $queryInsertarSolicitudesProyectos = $conectar->prepare($queryInsertarSolicitudesProyectos);
      $queryInsertarSolicitudesProyectos->bindValue(1, $descripcionProyecto);
      $queryInsertarSolicitudesProyectos->bindValue(2, $objetivoProyecto);
      $queryInsertarSolicitudesProyectos->bindValue(3, $presupuestoProyecto);
      $queryInsertarSolicitudesProyectos->bindValue(4, $creadoPor);
      $queryInsertarSolicitudesProyectos->execute();

      $solicitudProyectoID = $conectar->lastInsertId();

      $countDescripcionRequerimiento = count($descripcionRequerimiento);

      for ($requerimientoSolicitudProyectoIndex = 0; $requerimientoSolicitudProyectoIndex <= $countDescripcionRequerimiento; $requerimientoSolicitudProyectoIndex++) {
         $queryInsertarRequerimientosSolicitudesProyectos = 'INSERT INTO REQUERIMIENTOS_SOLICITUDES_PROYECTOS (solicitud_proyecto_id,
                                                                                                               descripcion_requerimiento,
                                                                                                               estado_id,
                                                                                                               creado_por,
                                                                                                               fecha_creacion
                                                                                                               )
                                                                                                         VALUES(?, ?, 1, ?, NOW());';

         $queryInsertarRequerimientosSolicitudesProyectos = $conectar->prepare($queryInsertarRequerimientosSolicitudesProyectos);
         $queryInsertarRequerimientosSolicitudesProyectos->bindValue(1, $solicitudProyectoID);
         $queryInsertarRequerimientosSolicitudesProyectos->bindValue(2, $descripcionRequerimiento[$requerimientoSolicitudProyectoIndex]);
         $queryInsertarRequerimientosSolicitudesProyectos->bindValue(3, $creadoPor);
         $queryInsertarRequerimientosSolicitudesProyectos->execute();
      }

      return $resultado = $queryInsertarRequerimientosSolicitudesProyectos->fetchAll();
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
