<?php
class CondicionesPagos extends Connection
{
    public function obtener_listado_opciones_condiciones_pagos()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT CONDICION_PAGO_ID,
                         CONDICION_PAGO
                    FROM CONDICIONES_PAGOS
                   WHERE ESTADO_ID = 1;';

        $query = $conectar->prepare($query);
        $query->execute();

        return $resultado = $query->fetchAll();
    }
}
