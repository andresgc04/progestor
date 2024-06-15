<?php
class TiposClientes extends Connection
{
    public function obtener_listado_opciones_tipos_clientes()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT TIPO_CLIENTE_ID, TIPO_CLIENTE 
                    FROM TIPOS_CLIENTES
                   WHERE ESTADO_ID = 1;
                 ';

        $query = $conectar->prepare($query);
        $query->execute();

        return $resultado = $query->fetchAll();
    }
}
