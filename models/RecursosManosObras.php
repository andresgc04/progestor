<?php
class RecursosManosObras extends Connection
{
    public function registrar_recursos_manos_obras(
        $recursoManoObra,
        $tipoPagoID,
        $costoPagoRecursoManoObra,
        $creadoPor
    ) {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'INSERT INTO RECURSOS_MANOS_OBRAS (RECURSO_MANO_OBRA, TIPO_PAGO_ID,
                                                    COSTO_PAGO_RECURSO_MANO_OBRA, ESTADO_ID,
                                                    CREADO_POR, FECHA_CREACION
                                                   )
                                             VALUES(UCASE(?), ?,
                                                    ?, 1,
                                                    ?, NOW()
                                                   );';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $recursoManoObra);
        $query->bindValue(2, $tipoPagoID);
        $query->bindValue(3, $costoPagoRecursoManoObra);
        $query->bindValue(4, $creadoPor);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function listado_recursos_manos_obras()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT recursosManosObras.RECURSO_MANO_OBRA_ID,
    	                 UCASE(recursosManosObras.RECURSO_MANO_OBRA) AS RECURSO_MANO_OBRA,
                         UCASE(tiposPagos.TIPO_PAGO) AS TIPO_PAGO,
                         recursosManosObras.COSTO_PAGO_RECURSO_MANO_OBRA,
                         UCASE(estados.ESTADO) AS ESTADO
                    FROM RECURSOS_MANOS_OBRAS recursosManosObras
              INNER JOIN TIPOS_PAGOS tiposPagos
                      ON recursosManosObras.TIPO_PAGO_ID = tiposPagos.TIPO_PAGO_ID
              INNER JOIN ESTADOS estados
                      ON recursosManosObras.ESTADO_ID = estados.ESTADO_ID
                   WHERE recursosManosObras.ESTADO_ID = 1
                ORDER BY recursosManosObras.RECURSO_MANO_OBRA_ID DESC, 
   		                 recursosManosObras.FECHA_CREACION DESC;';

        $query = $conectar->prepare($query);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }
}
