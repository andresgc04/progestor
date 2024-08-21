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
                                         VALUES(?, 1,
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
}
