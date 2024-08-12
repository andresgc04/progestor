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

    public function obtener_detalle_modulo_sistema_por_modulo_sistema_ID($moduloSistemaID)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT MODULO_SISTEMA_ID,
                         UCASE(MODULO) AS MODULO
                    FROM MODULOS_SISTEMAS
                   WHERE MODULO_SISTEMA_ID = ?;';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $moduloSistemaID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function modificar_modulos_sistemas_por_modulo_sistema_ID($modificarModuloSistema, $modificadoPor, $moduloSistemaID)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'UPDATE MODULOS_SISTEMAS SET MODULO = ?, MODIFICADO_POR = ?, FECHA_MODIFICACION = NOW()
					                    WHERE MODULO_SISTEMA_ID = ?;';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $modificarModuloSistema);
        $query->bindValue(2, $modificadoPor);
        $query->bindValue(3, $moduloSistemaID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function eliminar_modulos_sistemas_por_modulo_sistema_ID($modificadoPor, $moduloSistemaID)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'UPDATE MODULOS_SISTEMAS SET ESTADO_ID = 4, MODIFICADO_POR = ?, FECHA_MODIFICACION = NOW()
					                    WHERE MODULO_SISTEMA_ID = ?;';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $modificadoPor);
        $query->bindValue(2, $moduloSistemaID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function obtener_listado_opciones_modulos_sistemas()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT MODULO_SISTEMA_ID,
                         UCASE(MODULO) AS MODULO
                    FROM MODULOS_SISTEMAS 
                   WHERE ESTADO_ID = 1
                ORDER BY MODULO ASC;';

        $query = $conectar->prepare($query);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }
}
