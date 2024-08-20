<?php
class UnidadesMedidas extends Connection
{
    public function listado_unidades_medidas()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT UNIDAD_MEDIDA_ID,
	                     UCASE(UNIDAD_MEDIDA) AS UNIDAD_MEDIDA
                    FROM UNIDADES_MEDIDAS 
                   WHERE ESTADO_ID = 1
                ORDER BY UNIDAD_MEDIDA_ID DESC, FECHA_CREACION DESC;';

        $query = $conectar->prepare($query);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }
}
