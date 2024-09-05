<?php
class ProyectosObrasCivilesClientes extends Connection
{
    public function listado_proyectos_obras_civiles_clientes($creadoPor)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = "SELECT proyectosObrasCiviles.PROYECTO_OBRA_CIVIL_ID,
    	                 proyectosObrasCiviles.SOLICITUD_PROYECTO_ID,
                         UCASE(solicitudesProyectos.NOMBRE_PROYECTO) AS NOMBRE_PROYECTO,
                         UCASE(tiposProyectosObrasCiviles.TIPO_PROYECTO_OBRA_CIVIL) AS TIPO_PROYECTO_OBRA_CIVIL,
                         UCASE(estados.ESTADO) AS ESTADO
  	                FROM PROYECTOS_OBRAS_CIVILES proyectosObrasCiviles
              INNER JOIN SOLICITUDES_PROYECTOS solicitudesProyectos
                      ON proyectosObrasCiviles.SOLICITUD_PROYECTO_ID = solicitudesProyectos.SOLICITUD_PROYECTO_ID
              INNER JOIN TIPOS_PROYECTOS_OBRAS_CIVILES tiposProyectosObrasCiviles
                      ON proyectosObrasCiviles.TIPO_PROYECTO_OBRA_CIVIL_ID = 
                         tiposProyectosObrasCiviles.TIPO_PROYECTO_OBRA_CIVIL_ID
              INNER JOIN ESTADOS estados
                      ON proyectosObrasCiviles.ESTADO_ID = estados.ESTADO_ID
                   WHERE solicitudesProyectos.CREADO_POR = ?
                ORDER BY proyectosObrasCiviles.PROYECTO_OBRA_CIVIL_ID DESC,
                         proyectosObrasCiviles.FECHA_CREACION DESC;";

        $query = $conectar->prepare($query);
        $query->bindValue(1, $creadoPor);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }
}
