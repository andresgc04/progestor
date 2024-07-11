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
})();
