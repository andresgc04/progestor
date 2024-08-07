<?php
class TiposDocumentos extends Connection
{
    public function obtener_listado_tipos_documentos()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT TIPO_DOCUMENTO_ID,
                         UCASE(TIPO_DOCUMENTO) TIPO_DOCUMENTO
                    FROM TIPOS_DOCUMENTOS
                   WHERE ESTADO_ID = 1
                ORDER BY TIPO_DOCUMENTO;';

        $query = $conectar->prepare($query);
        $query->execute();

        return $resultado = $query->fetchAll();
    }
}
