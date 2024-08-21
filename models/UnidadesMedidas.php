<?php
class UnidadesMedidas extends Connection
{
    public function registrar_unidades_medidas($unidadMedida, $creadoPor)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'INSERT INTO UNIDADES_MEDIDAS (UNIDAD_MEDIDA, ESTADO_ID,
                                                CREADO_POR, FECHA_CREACION
                                               )
                                         VALUES(UCASE(?), 1,
                                                ?, NOW());';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $unidadMedida);
        $query->bindValue(2, $creadoPor);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function listado_unidades_medidas()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT unidadesMedidas.UNIDAD_MEDIDA_ID,
	                     UCASE(unidadesMedidas.UNIDAD_MEDIDA) AS UNIDAD_MEDIDA,
                         UCASE(estados.ESTADO) AS ESTADOS
                    FROM UNIDADES_MEDIDAS unidadesMedidas
              INNER JOIN ESTADOS estados
		              ON unidadesMedidas.ESTADO_ID = estados.ESTADO_ID
                   WHERE unidadesMedidas.ESTADO_ID = 1
                ORDER BY unidadesMedidas.UNIDAD_MEDIDA_ID DESC, unidadesMedidas.FECHA_CREACION DESC;';

        $query = $conectar->prepare($query);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function obtener_detalles_unidades_medidas_por_unidad_medida_ID($unidadMedidaID)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT UNIDAD_MEDIDA_ID,
                         UCASE(UNIDAD_MEDIDA) AS UNIDAD_MEDIDA
                    FROM UNIDADES_MEDIDAS
                   WHERE UNIDAD_MEDIDA_ID = ?;';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $unidadMedidaID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function modificar_unidades_medidas(
        $unidadMedida,
        $modificadoPor,
        $unidadMedidaID,
    ) {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'UPDATE UNIDADES_MEDIDAS SET UNIDAD_MEDIDA = UCASE(?), 
						                      MODIFICADO_POR = ?,
                                              FECHA_MODIFICACION = NOW()
                                        WHERE UNIDAD_MEDIDA_ID = ?;';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $unidadMedida);
        $query->bindValue(2, $modificadoPor);
        $query->bindValue(3, $unidadMedidaID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function eliminar_unidades_medidas(
        $modificadoPor,
        $unidadMedidaID,
    ) {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'UPDATE UNIDADES_MEDIDAS SET ESTADO_ID = 4,
							                  MODIFICADO_POR = ?,
                                              FECHA_MODIFICACION = NOW()
                                        WHERE UNIDAD_MEDIDA_ID = ?;';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $modificadoPor);
        $query->bindValue(2, $unidadMedidaID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function obtener_listado_opciones_unidades_medidas()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT UNIDAD_MEDIDA_ID,
                         UCASE(UNIDAD_MEDIDA) AS UNIDAD_MEDIDA
                    FROM UNIDADES_MEDIDAS
                   WHERE ESTADO_ID = 1
                ORDER BY UNIDAD_MEDIDA ASC;';

        $query = $conectar->prepare($query);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function obtener_listado_opciones_unidades_medidas_por_unidad_medida_ID($unidadMedidaID)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT UNIDAD_MEDIDA_ID,
                         UCASE(UNIDAD_MEDIDA) AS UNIDAD_MEDIDA
                    FROM UNIDADES_MEDIDAS
                   WHERE UNIDAD_MEDIDA_ID = ? AND ESTADO_ID = 1;';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $unidadMedidaID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }
}
