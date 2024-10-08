<?php
class ProyectosObrasCiviles extends Connection
{
        public function registrar_proyectos_obras_civiles(
                $solicitudProyectoID,
                $tipoProyectoObraCivilID,
                $categoriaTipoProyectoObraCivilID,
                $responsableID,
                $fechaInicioProyecto,
                $creadoPor
        ) {
                $conectar = parent::Connection();
                parent::set_names();

                $query = 'INSERT INTO PROYECTOS_OBRAS_CIVILES (SOLICITUD_PROYECTO_ID, TIPO_PROYECTO_OBRA_CIVIL_ID, CATEGORIA_TIPO_PROYECTO_OBRA_CIVIL_ID,
                                                       RESPONSABLE_ID, FECHA_INICIO_PROYECTO, ESTADO_ID,
                                                       CREADO_POR, FECHA_CREACION
                                                      )
                                                VALUES(?,?,?,
                                                       ?,?,1,
                                                       ?,NOW()
                                                      );';

                $query = $conectar->prepare($query);
                $query->bindValue(1, $solicitudProyectoID);
                $query->bindValue(2, $tipoProyectoObraCivilID);
                $query->bindValue(3, $categoriaTipoProyectoObraCivilID);
                $query->bindValue(4, $responsableID);
                $query->bindValue(5, $fechaInicioProyecto);
                $query->bindValue(6, $creadoPor);
                $query->execute();

                $resultado = $query->fetchAll();

                return $resultado;
        }

        public function listado_proyectos_obras_civiles()
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
                   WHERE proyectosObrasCiviles.ESTADO_ID = 1
                ORDER BY proyectosObrasCiviles.PROYECTO_OBRA_CIVIL_ID DESC,
                         proyectosObrasCiviles.FECHA_CREACION DESC;";

                $query = $conectar->prepare($query);
                $query->execute();

                $resultado = $query->fetchAll();

                return $resultado;
        }

        public function obtener_datos_proyectos_obras_civiles_por_proyecto_obra_civil_ID_solicitud_proyecto_ID($proyectoObraCivilID, $solicitudProyectoID)
        {
                $conectar = parent::Connection();
                parent::set_names();

                $query = 'SELECT proyectosObrasCiviles.PROYECTO_OBRA_CIVIL_ID,
    	                         proyectosObrasCiviles.SOLICITUD_PROYECTO_ID,
                                 UCASE(solicitudesProyectos.NOMBRE_PROYECTO) AS NOMBRE_PROYECTO,
                                 UCASE(solicitudesProyectos.OBJETIVO_PROYECTO) AS OBJETIVO_PROYECTO,
                                 UCASE(solicitudesProyectos.DESCRIPCION_PROYECTO) AS DESCRIPCION_PROYECTO,
                                 solicitudesProyectos.DIMENSION_METRO_LARGO_TERRENO,
                                 solicitudesProyectos.DIMENSION_METRO_ANCHO_TERRENO,
                                 solicitudesProyectos.AREA_TOTAL_TERRENO,
                                 UCASE(solicitudesProyectos.UBICACION) AS UBICACION,
                                 solicitudesProyectos.PRESUPUESTO_ESTIMADO_PROYECTO,
                                 solicitudesProyectos.FECHA_ESTIMADA_DESEADA,
                                 solicitudesProyectos.VERIFICACION_TITULO_PROPIEDAD,
                                 UCASE(clientes.NOMBRE_CLIENTE) AS NOMBRE_CLIENTE,
                                 UCASE(tiposProyectosObrasCiviles.TIPO_PROYECTO_OBRA_CIVIL) AS TIPO_PROYECTO_OBRA_CIVIL,
                                 UCASE(categoriasTiposProyectosObrasCiviles.CATEGORIA_TIPO_PROYECTO_OBRA_CIVIL) AS CATEGORIA_TIPO_PROYECTO_OBRA_CIVIL,
                                 CONCAT(empleados.PRIMER_NOMBRE, " ", empleados.SEGUNDO_NOMBRE, " ", empleados.PRIMER_APELLIDO, " ", empleados.SEGUNDO_APELLIDO
                                       ) AS RESPONSABLES,
                                 proyectosObrasCiviles.FECHA_INICIO_PROYECTO,
                                 UCASE(estados.ESTADO) AS ESTADO
  	                    FROM PROYECTOS_OBRAS_CIVILES proyectosObrasCiviles
                      INNER JOIN SOLICITUDES_PROYECTOS solicitudesProyectos
		              ON proyectosObrasCiviles.SOLICITUD_PROYECTO_ID = solicitudesProyectos.SOLICITUD_PROYECTO_ID
                      INNER JOIN TIPOS_PROYECTOS_OBRAS_CIVILES tiposProyectosObrasCiviles
		              ON proyectosObrasCiviles.TIPO_PROYECTO_OBRA_CIVIL_ID = 
                                 tiposProyectosObrasCiviles.TIPO_PROYECTO_OBRA_CIVIL_ID
                      INNER JOIN CATEGORIAS_TIPOS_PROYECTOS_OBRAS_CIVILES categoriasTiposProyectosObrasCiviles
                              ON proyectosObrasCiviles.CATEGORIA_TIPO_PROYECTO_OBRA_CIVIL_ID =
                                 categoriasTiposProyectosObrasCiviles.CATEGORIA_TIPO_PROYECTO_OBRA_CIVIL_ID
                      INNER JOIN USUARIOS usuariosSolicitantes
                              ON solicitudesProyectos.CREADO_POR = usuariosSolicitantes.USUARIO_ID
                      INNER JOIN CLIENTES clientes 
	                      ON usuariosSolicitantes.CLIENTE_ID = clientes.CLIENTE_ID
                      INNER JOIN USUARIOS responsables
                              ON proyectosObrasCiviles.RESPONSABLE_ID = responsables.USUARIO_ID
                      INNER JOIN EMPLEADOS empleados 
                              ON responsables.EMPLEADO_ID = empleados.EMPLEADO_ID
                      INNER JOIN ESTADOS estados
                              ON proyectosObrasCiviles.ESTADO_ID = estados.ESTADO_ID
                           WHERE proyectosObrasCiviles.PROYECTO_OBRA_CIVIL_ID = ? 
                             AND proyectosObrasCiviles.SOLICITUD_PROYECTO_ID = ?;';

                $query = $conectar->prepare($query);
                $query->bindValue(1, $proyectoObraCivilID);
                $query->bindValue(2, $solicitudProyectoID);
                $query->execute();

                $resultado = $query->fetchAll();

                return $resultado;
        }

        public function obtener_documentos_proyectos_obras_civiles_por_solicitud_proyecto_ID_proyecto_obra_civil_ID($solicitudProyectoID, $proyectoObraCivilID)
        {
                $conectar = parent::Connection();
                parent::set_names();

                $query = 'SELECT documentos.DOCUMENTO_ID,
                                 documentos.SOLICITUD_PROYECTO_ID,
                                 documentos.PROYECTO_OBRA_CIVIL_ID,
                                 documentos.NOMBRE_DOCUMENTO,
                                 documentos.TIPO_DOCUMENTO,
                                 UCASE(estados.ESTADO) AS ESTADOS
                            FROM DOCUMENTOS documentos
                      INNER JOIN ESTADOS estados
                              ON documentos.ESTADO_ID = estados.ESTADO_ID
                           WHERE documentos.SOLICITUD_PROYECTO_ID = ? OR PROYECTO_OBRA_CIVIL_ID = ?
                             AND documentos.ESTADO_ID IN(1, 2, 5, 6, 7)';

                $query = $conectar->prepare($query);
                $query->bindValue(1, $solicitudProyectoID);
                $query->bindValue(2, $proyectoObraCivilID);
                $query->execute();

                $resultado = $query->fetchAll();

                return $resultado;
        }

        public function obtener_ruta_documento_proyecto_obra_civil_por_documento_ID_solicitud_proyecto_ID_proyecto_obra_civil_ID(
                $documentoID,
                $solicitudProyectoID,
                $proyectoObraCivilID
        ) {
                $conectar = parent::Connection();
                parent::set_names();

                $query = 'SELECT NOMBRE_DOCUMENTO 
                            FROM DOCUMENTOS 
                           WHERE DOCUMENTO_ID = ?
                             AND (IFNULL(SOLICITUD_PROYECTO_ID, PROYECTO_OBRA_CIVIL_ID) = IFNULL(?, ?));';

                $query = $conectar->prepare($query);
                $query->bindValue(1, $documentoID);
                $query->bindValue(2, $solicitudProyectoID);
                $query->bindValue(3, $proyectoObraCivilID);
                $query->execute();

                $resultado = $query->fetchAll();

                return $resultado;
        }
}
