<?php
class Documentos extends Connection
{
    public function registrar_documentos(
        $proyectoObraCivilID,
        $documento,
        $creadoPor
    ) {
        $conectar = parent::Connection();
        parent::set_names();

        //Insertar Documento:
        if (isset($documento) && $documento['error'] == 0) {
            $fileTmpPath = $documento['tmp_name'];
            $fileName = $documento['name'];
            $fileSize = $documento['size'];
            $fileType = $documento['type'];
            $uploadDirectory = '../../progestor/documents/';

            // Definir la ruta completa del archivo
            $dest_path = $uploadDirectory . $fileName;

            // Mover el archivo al directorio de destino
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                // Guardar la información del archivo en la base de datos
                $query = 'INSERT INTO DOCUMENTOS (PROYECTO_OBRA_CIVIL_ID, NOMBRE_DOCUMENTO,
                                                  TIPO_DOCUMENTO, SIZE_DOCUMENTO,
                                                  RUTA_DOCUMENTO, ESTADO_ID,
                                                  CREADO_POR, FECHA_CREACION
                                                 )
                                           VALUES(?, ?,
                                                  ?, ?,
                                                  ?, 1,
                                                  ?, NOW()
                                                 );';

                $query = $conectar->prepare($query);
                $query->bindValue(1, $proyectoObraCivilID);
                $query->bindValue(2, $fileName);
                $query->bindValue(3, $fileType);
                $query->bindValue(4, $fileSize);
                $query->bindValue(5, $dest_path);
                $query->bindValue(6, $creadoPor);
                $query->execute();

                $resultado = $query->fetchAll();

                return $resultado;


                echo 'El archivo se ha subido y guardado exitosamente.';
            } else {
                echo "Hubo un error al mover el archivo.";
            }
        } else {
            echo "No se seleccionó ningún archivo o hubo un error en la subida.";
        }
    }

    public function obtener_ruta_documento_proyecto_obra_civil_por_documento_ID_solicitud_proyecto_ID(
        $documentoID,
        $solicitudProyectoID,
    ) {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT NOMBRE_DOCUMENTO
                    FROM DOCUMENTOS
                   WHERE DOCUMENTO_ID = ? AND SOLICITUD_PROYECTO_ID = ?;';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $documentoID);
        $query->bindValue(2, $solicitudProyectoID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function obtener_ruta_documento_proyecto_obra_civil_por_documento_ID_proyecto_obra_civil_ID(
        $documentoID,
        $proyectoObraCivilID,
    ) {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT NOMBRE_DOCUMENTO
                    FROM DOCUMENTOS
                   WHERE DOCUMENTO_ID = ? AND PROYECTO_OBRA_CIVIL_ID = ?;';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $documentoID);
        $query->bindValue(2, $proyectoObraCivilID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }
}
