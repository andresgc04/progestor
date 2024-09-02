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
                                             VALUES(?, ?,
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
}
