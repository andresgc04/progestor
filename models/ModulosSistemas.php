<?php
class ModulosSistemas extends Connection
{
    public function registrar_modulos_sistemas($moduloSistema, $creadoPor)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'INSERT INTO MODULOS_SISTEMAS (MODULO, ESTADO_ID,
                                                CREADO_POR, FECHA_CREACION
                                               )
                                         VALUES(?, 1,
                                                ?, NOW()
                                               );';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $moduloSistema);
        $query->bindValue(2, $creadoPor);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function listado_modulos_sistemas()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT modulosSistemas.MODULO_SISTEMA_ID,
                         UCASE(modulosSistemas.MODULO) AS MODULO,
                         UCASE(estados.ESTADO) AS ESTADO
                    FROM MODULOS_SISTEMAS modulosSistemas
              INNER JOIN ESTADOS estados
                      ON modulosSistemas.ESTADO_ID = estados.ESTADO_ID
                   WHERE modulosSistemas.ESTADO_ID = 1
                ORDER BY modulosSistemas.MODULO_SISTEMA_ID DESC, modulosSistemas.FECHA_CREACION DESC;';

        $query = $conectar->prepare($query);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }
}
