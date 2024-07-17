<?php
class CategoriasTiposProyectosObrasCiviles extends Connection
{
    public function obtener_listado_opciones_categorias_tipos_proyectos_obras_civiles_por_tipo_proyecto_obra_civil_ID($tipoProyectoObraCivilID)
    {
        $conectar = parent::Connection();
        parent::set_names();

        $query = 'SELECT CATEGORIA_TIPO_PROYECTO_OBRA_CIVIL_ID,
                         UCASE(CATEGORIA_TIPO_PROYECTO_OBRA_CIVIL) CATEGORIA_TIPO_PROYECTO_OBRA_CIVIL
                    FROM CATEGORIAS_TIPOS_PROYECTOS_OBRAS_CIVILES
                   WHERE TIPO_PROYECTO_OBRA_CIVIL_ID = ? AND ESTADO_ID = 1;';

        $query = $conectar->prepare($query);
        $query->bindValue(1, $tipoProyectoObraCivilID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function obtener_listado_opciones_categorias_tipos_proyectos_obras_civiles_por_categoria_tipo_proyecto_obra_civil_ID_tipo_proyecto_obra_civil_ID(
        $categoriaTipoProyectoObraCivilID,
        $tipoProyectoObraCivilID
    ) {
        $conectar = parent::Connection();
        parent::set_names();

        $query = "SELECT CATEGORIA_TIPO_PROYECTO_OBRA_CIVIL_ID,
                         UCASE(CATEGORIA_TIPO_PROYECTO_OBRA_CIVIL) CATEGORIA_TIPO_PROYECTO_OBRA_CIVIL
                    FROM CATEGORIAS_TIPOS_PROYECTOS_OBRAS_CIVILES
                   WHERE CATEGORIA_TIPO_PROYECTO_OBRA_CIVIL_ID = ? 
                     AND TIPO_PROYECTO_OBRA_CIVIL_ID = ?;";

        $query = $conectar->prepare($query);
        $query->bindValue(1, $categoriaTipoProyectoObraCivilID);
        $query->bindValue(2, $tipoProyectoObraCivilID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }

    public function obtener_listado_opciones_categorias_tipos_proyectos_obras_civiles_diferente_categoria_tipo_proyecto_obra_civil_ID_tipo_proyecto_obra_civil_ID(
        $categoriaTipoProyectoObraCivilID,
        $tipoProyectoObraCivilID
    ) {
        $conectar = parent::Connection();
        parent::set_names();

        $query = "SELECT CATEGORIA_TIPO_PROYECTO_OBRA_CIVIL_ID,
                         UCASE(CATEGORIA_TIPO_PROYECTO_OBRA_CIVIL) CATEGORIA_TIPO_PROYECTO_OBRA_CIVIL
                    FROM CATEGORIAS_TIPOS_PROYECTOS_OBRAS_CIVILES
                   WHERE CATEGORIA_TIPO_PROYECTO_OBRA_CIVIL_ID != ? 
                     AND TIPO_PROYECTO_OBRA_CIVIL_ID = ?;";

        $query = $conectar->prepare($query);
        $query->bindValue(1, $categoriaTipoProyectoObraCivilID);
        $query->bindValue(2, $tipoProyectoObraCivilID);
        $query->execute();

        $resultado = $query->fetchAll();

        return $resultado;
    }
}
