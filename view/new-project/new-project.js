navLinkPrimary("navLinkViewHomeProjectRequests");

setContentHeaderTitle("Crear Nuevo Proyecto");

setBreadCrumbContentHeaderTitle(
  "../view-home-project-requests/",
  "Listado De Solicitudes De Proyectos"
);

setBreadCrumbContentHeaderSubTitle("Crear Nuevo Proyecto");

(function () {
  //Initialize Select2 Elements:
  initializeSelect2Elements();

  //Initialize Date picker:
  $("#fechaInicioProyecto").datetimepicker({
    format: "YYYY/MM/DD",
  });

  $("#fechaFinalizacionProyecto").datetimepicker({
    format: "YYYY/MM/DD",
  });

  getSelectListTypesCivilWorksProjectsOptions(
    "../../controller/TiposProyectosObrasCivilesController.php?op=obtener_listado_opciones_tipos_proyectos_obras_civiles",
    "#tipoProyectoObraCivilID"
  );

  getSelectListProjectManagersOptions(
    "../../controller/EmpleadosController.php?op=obtener_listado_opciones_responsables_proyecto",
    "#responsableID"
  );
})();

const tipoProyectoObraCivilIDInput = document.getElementById(
  "tipoProyectoObraCivilID"
);
tipoProyectoObraCivilIDInput.onchange = (event) => {
  const tipoProyectoObraCivilID = event.target.value;

  getSelectListCategoriesTypesProjectsCivilWorksOptionsByTipoProyectoObraCivilID(
    "../../controller/CategoriasTiposProyectosObrasCivilesController.php?op=obtener_listado_opciones_categorias_tipos_proyectos_obras_civiles_por_tipo_proyecto_obra_civil_ID",
    tipoProyectoObraCivilID,
    "#categoriaTipoProyectoObraCivilID"
  );
};
