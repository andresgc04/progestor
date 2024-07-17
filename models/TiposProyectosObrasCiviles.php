<?php
class TiposProyectosObrasCiviles extends Connection
{
    public function obtener_listado_opciones_tipos_proyectos_obras_civiles()
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT TIPO_PROYECTO_OBRA_CIVIL_ID,
                         UCASE(TIPO_PROYECTO_OBRA_CIVIL) TIPO_PROYECTO_OBRA_CIVIL
                    FROM TIPOS_PROYECTOS_OBRAS_CIVILES
                   WHERE ESTADO_ID = 1;';

        $query = $conectar->prepare($query);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function obtener_listado_opciones_tipos_proyectos_obras_civiles_por_tipo_proyecto_obra_civil_ID($tipoProyectoObraCivilID)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = "SELECT TIPO_PROYECTO_OBRA_CIVIL_ID, 
                         UCASE(TIPO_PROYECTO_OBRA_CIVIL) TIPO_PROYECTO_OBRA_CIVIL
                    FROM TIPOS_PROYECTOS_OBRAS_CIVILES 
                   WHERE TIPO_PROYECTO_OBRA_CIVIL_ID = ?;";

        $query = $conectar->prepare($query);
        $query->bindValue(1, $tipoProyectoObraCivilID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function obtener_listado_opciones_tipos_proyectos_obras_civiles_diferente_tipo_proyecto_obra_civil_ID($tipoProyectoObraCivilID)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = "SELECT TIPO_PROYECTO_OBRA_CIVIL_ID, 
                         UCASE(TIPO_PROYECTO_OBRA_CIVIL) TIPO_PROYECTO_OBRA_CIVIL
                    FROM TIPOS_PROYECTOS_OBRAS_CIVILES 
                   WHERE TIPO_PROYECTO_OBRA_CIVIL_ID != ?;";

        $query = $conectar->prepare($query);
        $query->bindValue(1, $tipoProyectoObraCivilID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }
}
