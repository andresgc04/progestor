<?php
require_once('../config/connection.php');
require_once('../models/Documentos.php');
require_once('../public/php/constants/sessions-constants.php');

session_start();

$creadoPor = $_SESSION[$USUARIO_ID];
$modificadoPor = $creadoPor;

$documentos = new Documentos();

switch ($_GET['op']) {
    case 'registrar_documentos':
        $documentos->registrar_documentos(
            $_POST['addProjectDocumentsProyectoObraCivilID'],
            $_FILES['documento'],
            $creadoPor
        );
        break;
    case 'obtener_ruta_documento_proyecto_obra_civil_por_documento_ID_solicitud_proyecto_ID':
        $data = $documentos->obtener_ruta_documento_proyecto_obra_civil_por_documento_ID_solicitud_proyecto_ID(
            $_POST['documentoID'],
            $_POST['solicitudProyectoID'],
        );

        if (is_array($data) == true and count($data) > 0) {
            // Normalizar la estructura de los datos si es necesario
            $normalizedData = array();

            foreach ($data as $item) {
                // Si los datos son un array asociativo con claves numéricas y asociativas,
                // seleccionar las claves que deseas mantener o normalizar la estructura según sea necesario.
                $normalizedItem = [
                    'nombreDocumento' => $item['NOMBRE_DOCUMENTO'],
                ];

                // Agregar el elemento normalizado al array resultante
                $normalizedData = $normalizedItem;
            }

            // Crear un array asociativo con la clave "data"
            $response = array('data' => $normalizedData);

            // Convertir el array de objetos a formato JSON:
            $json = json_encode($response, JSON_UNESCAPED_UNICODE);

            // Configurar la cabecera para indicar que la respuesta es JSON
            header('Content-Type: application/json');

            // Retornar o imprimir el JSON
            echo $json;
        } else {
            echo json_encode(['data' => []]);
        }
        break;
    case 'obtener_ruta_documento_proyecto_obra_civil_por_documento_ID_proyecto_obra_civil_ID':
        $data = $documentos->obtener_ruta_documento_proyecto_obra_civil_por_documento_ID_proyecto_obra_civil_ID(
            $_POST['documentoID'],
            $_POST['proyectoObraCivilID'],
        );

        if (is_array($data) == true and count($data) > 0) {
            // Normalizar la estructura de los datos si es necesario
            $normalizedData = array();

            foreach ($data as $item) {
                // Si los datos son un array asociativo con claves numéricas y asociativas,
                // seleccionar las claves que deseas mantener o normalizar la estructura según sea necesario.
                $normalizedItem = [
                    'nombreDocumento' => $item['NOMBRE_DOCUMENTO'],
                ];

                // Agregar el elemento normalizado al array resultante
                $normalizedData = $normalizedItem;
            }

            // Crear un array asociativo con la clave "data"
            $response = array('data' => $normalizedData);

            // Convertir el array de objetos a formato JSON:
            $json = json_encode($response, JSON_UNESCAPED_UNICODE);

            // Configurar la cabecera para indicar que la respuesta es JSON
            header('Content-Type: application/json');

            // Retornar o imprimir el JSON
            echo $json;
        } else {
            echo json_encode(['data' => []]);
        }
        break;
}
