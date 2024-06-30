<?php
class Puestos extends Connection
{
    public function registrar_puestos($puesto, $creadoPor)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'INSERT INTO PUESTOS (PUESTO, ESTADO_ID, CREADO_POR, FECHA_CREACION)
                                VALUES(UCASE(?), 1, ?, NOW());';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $puesto);
        $query->bindValue(2, $creadoPor);
        $query->execute();

        return $resultado = $query->fetchAll();
    }

    public function listado_puestos()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT puestos.PUESTO_ID,
                         UCASE(puestos.PUESTO) PUESTO,
                         UCASE(estados.ESTADO) ESTADO
                    FROM PUESTOS
                         INNER JOIN ESTADOS estados
                      ON puestos.ESTADO_ID = estados.ESTADO_ID
                   WHERE puestos.ESTADO_ID = 1
                ORDER BY puestos.PUESTO_ID DESC, puestos.FECHA_CREACION DESC;';

        $query = $conectar->prepare($query);
        $query->execute();

        return $resultado = $query->fetchAll();
    }

    public function obtener_listado_opciones_puestos()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT PUESTO_ID, PUESTO 
                    FROM PUESTOS
                   WHERE ESTADO_ID = 1;';

        $query = $conectar->prepare($query);
        $query->execute();

        return $resultado = $query->fetchAll();
    }

    public function obtener_detalle_puesto_por_puestoID($puestoID)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT PUESTO_ID, UCASE(PUESTO) PUESTO 
                    FROM PUESTOS
                   WHERE PUESTO_ID = ?;';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $puestoID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function modificar_puestos_por_puestoID($modificarPuesto, $puestoID, $modificadoPor)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'UPDATE PUESTOS SET PUESTO = ?, MODIFICADO_POR = ?, FECHA_MODIFICACION = NOW()
                               WHERE PUESTO_ID = ?;';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $modificarPuesto);
        $query->bindValue(2, $modificadoPor);
        $query->bindValue(3, $puestoID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function eliminar_puestos_por_puestoID($puestoID, $modificadoPor)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'UPDATE PUESTOS SET ESTADO_ID = 4, MODIFICADO_POR = ?, FECHA_MODIFICACION = NOW()
                               WHERE PUESTO_ID = ?;';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $modificadoPor);
        $query->bindValue(2, $puestoID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }
}
