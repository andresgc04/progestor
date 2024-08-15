<?php
class Empleados extends Connection
{
   public function registrar_empleado(
      $primerNombre,
      $segundoNombre,
      $primerApellido,
      $segundoApellido,
      $sexoID,
      $estadoCivilID,
      $cedula,
      $fechaNacimiento,
      $nacionalidadID,
      $paisID,
      $provinciaID,
      $ciudadID,
      $direccion,
      $telefonoResidencial,
      $telefonoCelular,
      $correoElectronico,
      $puestoID,
      $departamentoID,
      $supervisorID,
      $salario,
      $numeroSeguridadSocial,
      $fechaContratacion,
      $creadoPor
   ) {
      $conectar = parent::Connection();
      parent::set_names();

      $query = 'INSERT INTO EMPLEADOS (primer_nombre, segundo_nombre, primer_apellido, segundo_apellido,
                                       sexo_id, estado_civil_id, cedula, fecha_nacimiento,
                                       nacionalidad_id, pais_id, provincia_id, ciudad_id,
                                       direccion, telefono_residencial, telefono_celular,
                                       correo_electronico, puesto_id, departamento_id, supervisor_id,
                                       salario, numero_seguridad_social, fecha_contratacion,
                                       estado_id, creado_por, fecha_creacion
                                       )
                                 VALUES(?, ?, ?, ?,
                                        ?, ?, ?, ?,
                                        ?, ?, ?, ?,
                                        ?, ?, ?,
                                        ?, ?, ?, ?,
                                        ?, ?, ?,
                                        1, ?, NOW() 
                                       );';

      $query = $conectar->prepare($query);
      $query->bindValue(1, $primerNombre);
      $query->bindValue(2, $segundoNombre);
      $query->bindValue(3, $primerApellido);
      $query->bindValue(4, $segundoApellido);
      $query->bindValue(5, $sexoID);
      $query->bindValue(6, $estadoCivilID);
      $query->bindValue(7, $cedula);
      $query->bindValue(8, $fechaNacimiento);
      $query->bindValue(9, $nacionalidadID);
      $query->bindValue(10, $paisID);
      $query->bindValue(11, $provinciaID);
      $query->bindValue(12, $ciudadID);
      $query->bindValue(13, $direccion);
      $query->bindValue(14, $telefonoResidencial);
      $query->bindValue(15, $telefonoCelular);
      $query->bindValue(16, $correoElectronico);
      $query->bindValue(17, $puestoID);
      $query->bindValue(18, $departamentoID);
      $query->bindValue(19, $supervisorID);
      $query->bindValue(20, $salario);
      $query->bindValue(21, $numeroSeguridadSocial);
      $query->bindValue(22, $fechaContratacion);
      $query->bindValue(23, $creadoPor);
      $query->execute();

      return $resultado = $query->fetchAll();
   }

   public function listado_empleados()
   {
      $conectar = parent::Connection();
      parent::set_names();

      $query = "SELECT empleados.empleado_id,
                       UCASE(CONCAT(empleados.primer_nombre, ' ', empleados.segundo_nombre, ' ',
                       empleados.primer_apellido, ' ', empleados.segundo_apellido)) AS empleados,
                       UCASE(puestos.puesto) AS puestos, UCASE(departamentos.departamento) AS departamentos,
                       UCASE(CONCAT(supervisores.primer_nombre, ' ', supervisores.segundo_nombre, '', 
                       supervisores.primer_apellido, ' ', supervisores.segundo_apellido)) AS supervisores,
                       DATE_FORMAT(empleados.fecha_contratacion, '%d/%m/%Y') AS fechas_contrataciones, UCASE(estados.estado) AS estados
                  FROM EMPLEADOS empleados
                       INNER JOIN PUESTOS puestos
                    ON empleados.puesto_id = puestos.puesto_id
                       INNER JOIN DEPARTAMENTOS departamentos
                    ON empleados.departamento_id = departamentos.departamento_id
                       LEFT JOIN EMPLEADOS supervisores 
                    ON empleados.supervisor_id = supervisores.empleado_id
                       INNER JOIN ESTADOS estados
                    ON empleados.estado_id = estados.estado_id
                 WHERE empleados.estado_id = 1
              ORDER BY empleados.empleado_id desc, empleados.fecha_creacion desc;";

      $query = $conectar->prepare($query);
      $query->execute();

      return $resultado = $query->fetchAll();
   }

   public function obtener_listado_opciones_supervisores_por_departamentoID($departamentoID)
   {
      $conectar = parent::Connection();
      parent::set_names();

      $query = "SELECT empleados.EMPLEADO_ID,
                       UCASE(CONCAT(empleados.PRIMER_NOMBRE, ' ', empleados.SEGUNDO_NOMBRE, ' ',
                       empleados.PRIMER_APELLIDO, ' ', empleados.SEGUNDO_APELLIDO)) 
                    AS SUPERVISORES
                  FROM EMPLEADOS empleados
            INNER JOIN PUESTOS puestos
                    ON empleados.PUESTO_ID = puestos.PUESTO_ID
                 WHERE empleados.DEPARTAMENTO_ID = ?
                   AND puestos.PUESTO 
                    IN ('Gerente de Proyecto', 
                        'Director de Proyectos',
                        'Jefe de Obra',
                        'Supervisor de Obra',
                        'Gerente De Tecnología De La Información',
                        'Gerente De Recursos Humanos')
                    AND empleados.ESTADO_ID = 1;
                ";

      $query = $conectar->prepare($query);
      $query->bindValue(1, $departamentoID);
      $query->execute();

      return $resultado = $query->fetchAll();
   }

   public function obtener_listado_opciones_empleados()
   {
      $conectar = parent::Connection();
      parent::set_names();

      $query = "SELECT empleado_id, UCASE(CONCAT(primer_nombre, ' ',
                                                 segundo_nombre, ' ',
                                                 primer_apellido, ' ',
                                                 segundo_apellido, ' - ',
                                                 cedula
                                               )) AS empleados
                  FROM EMPLEADOS
                 WHERE estado_id = 1;";

      $query = $conectar->prepare($query);
      $query->execute();

      return $resultado = $query->fetchAll();
   }

   public function obtener_listado_opciones_responsables_proyecto()
   {
      $conectar = parent::Connection();
      parent::set_names();

      $query = "SELECT EMPLEADO_ID,
                       CONCAT(UCASE(PRIMER_NOMBRE),' ',
                       UCASE(SEGUNDO_NOMBRE),' ',
                       UCASE(PRIMER_APELLIDO), ' ',
                       UCASE(SEGUNDO_APELLIDO)) EMPLEADO 
                  FROM EMPLEADOS 
                 WHERE PUESTO_ID IN (2, 3, 4) AND ESTADO_ID = 1;";

      $query = $conectar->prepare($query);
      $query->execute();

      $resultado = $query->fetchAll();

      return $resultado;
   }

   public function obtener_listado_opciones_responsables_proyecto_por_responsable_ID($responsableID)
   {
      $conectar = parent::Connection();
      parent::set_names();

      $query = "SELECT EMPLEADO_ID,
                       CONCAT(UCASE(PRIMER_NOMBRE),' ',
                       UCASE(SEGUNDO_NOMBRE),' ',
                       UCASE(PRIMER_APELLIDO), ' ',
                       UCASE(SEGUNDO_APELLIDO)) EMPLEADO 
                  FROM EMPLEADOS 
                 WHERE EMPLEADO_ID = ? AND PUESTO_ID IN (2, 3, 4) AND ESTADO_ID = 1;";

      $query = $conectar->prepare($query);
      $query->bindValue(1, $responsableID);
      $query->execute();

      $resultado = $query->fetchAll();

      return $resultado;
   }

   public function obtener_listado_opciones_responsables_proyecto_diferente_responsable_ID($responsableID)
   {
      $conectar = parent::Connection();
      parent::set_names();

      $query = "SELECT EMPLEADO_ID,
                       CONCAT(UCASE(PRIMER_NOMBRE),' ',
                       UCASE(SEGUNDO_NOMBRE),' ',
                       UCASE(PRIMER_APELLIDO), ' ',
                       UCASE(SEGUNDO_APELLIDO)) EMPLEADO 
                  FROM EMPLEADOS 
                 WHERE EMPLEADO_ID != ? AND PUESTO_ID IN (2, 3, 4) AND ESTADO_ID = 1;";

      $query = $conectar->prepare($query);
      $query->bindValue(1, $responsableID);
      $query->execute();

      $resultado = $query->fetchAll();

      return $resultado;
   }

   public function obtener_cedulas_empleados_por_cedula($cedula)
   {
      $conectar = parent::Connection();
      parent::set_names();

      $query = 'SELECT CEDULA 
                  FROM EMPLEADOS
                 WHERE CEDULA = ?;';

      $query = $conectar->prepare($query);
      $query->bindValue(1, $cedula);
      $query->execute();

      $resultado = $query->fetchAll();

      return $resultado;
   }
}
