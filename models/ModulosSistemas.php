<?php
class ModulosSistemas extends Connection
{
    public function listado_modulos_sistemas()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT MODULO_SISTEMA_ID, UCASE(MODULO) AS MODULO
                    FROM MODULOS_SISTEMAS
                   WHERE ESTADO_ID = 1
                ORDER BY MODULO_SISTEMA_ID DESC, FECHA_CREACION DESC;';

        $query = $conectar->prepare($query);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }
}
