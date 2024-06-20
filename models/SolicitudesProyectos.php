<?php
class SolicitudesProyectos extends Connection
{
    public function listado_solicitudes_proyectos_por_usuarioID($usuarioID)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = "SELECT UCASE(solicitudesProyectos.descripcion_proyecto) AS descripcion_proyecto,
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
