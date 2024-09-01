<?php
class TiposPagos extends Connection
{
    public function listado_tipos_pagos()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT tiposPagos.TIPO_PAGO_ID,
                         tiposPagos.TIPO_PAGO,
                         estados.ESTADO
                    FROM TIPOS_PAGOS tiposPagos
              INNER JOIN ESTADOS estados
                      ON tiposPagos.ESTADO_ID = estados.ESTADO_ID
                   WHERE tiposPagos.ESTADO_ID = 1
                ORDER BY tiposPagos.TIPO_PAGO_ID DESC, tiposPagos.FECHA_CREACION DESC; ';

        $query = $conectar->prepare($query);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }
}
