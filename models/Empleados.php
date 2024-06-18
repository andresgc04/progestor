<?php
class Empleados extends Connection
{
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
                    ON empleados.departamento_id = DEPARTAMENTOS.departamento_id
                       INNER JOIN EMPLEADOS supervisores 
                    ON empleados.supervisor_id = supervisores.empleado_id
                       INNER JOIN ESTADOS estados
                    ON empleados.estado_id = estados.estado_id
                 WHERE empleados.estado_id = 1
              ORDER BY empleados.empleado_id desc, empleados.fecha_creacion desc;";

      $query = $conectar->prepare($query);
      $query->execute();

      return $resultado = $query->fetchAll();
   }
}
