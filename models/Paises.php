<?php
class Paises extends Connection
{
    public function registrar_pais($pais, $creadoPor)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'INSERT INTO PAISES (PAIS, ESTADO_ID, CREADO_POR, FECHA_CREACION)
                               VALUES(?, 1, ?, NOW());';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $pais);
        $query->bindValue(2, $creadoPor);
        $query->execute();

        return $resultado = $query->fetchAll();
    }
}
