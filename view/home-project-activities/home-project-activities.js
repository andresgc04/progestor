navLinkPrimary("navLinkMaintenance");

navLinkSecondary("navLinkHomeProjectActivities");

setContentHeaderTitle("Listado De Actividades De Los Proyectos");

setBreadCrumbContentHeaderTitle("../dashboard/", "Dashboard");

setBreadCrumbContentHeaderSubTitle("Listado De Actividades De Los Proyectos");

const openNewProjectActivitiesFormModal = () => {
  $("#newProjectActivitiesFormModal").modal("show");
};

const newProjectActivitiesButton = document.getElementById(
  "newProjectActivitiesButton"
);
newProjectActivitiesButton.addEventListener("click", () => {
  openNewProjectActivitiesFormModal();
});

const obtenerListadoActividadesProyectosDataTable = () => {
  $("#listadoActividadesProyectosDataTable")
    .dataTable({
      aProcessing: true,
      aServerSide: true,
      dom: "Bfrtip",
      searching: true,
      lengthChange: false,
      colReorder: true,
      buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
      ajax: {
        url: "../../controller/ActividadesProyectosController.php?op=listado_actividades_proyectos",
        type: "post",
        dataType: "json",
        error: function (e) {
          console.log(e.responseText);
        },
      },
      ordering: false,
      bDestroy: true,
      responsive: true,
      bInfo: true,
      iDisplayLength: 10,
      autoWidth: false,
      language: {
        sProcessing: "Procesando...",
        sLengthMenu: "Mostrar _MENU_ registros",
        sZeroRecords: "No se encontraron resultados",
        sEmptyTable: "Ningun dato disponible en esta tabla",
        sInfo: "Mostrando un total de _TOTAL_ registros",
        sInfoEmpty: "Mostrando un total de 0 registros",
        sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
        sInfoPostFix: "",
        sSearch: "Buscar:",
        sUrl: "",
        sInfoThousands: ",",
        sLoadingRecords: "Cargando....",
        oPaginate: {
          sFirst: "Primero",
          sLast: "Ultimo",
          sNext: "Siguiente",
          sPrevious: "Anterior",
        },
        oAria: {
          sSortAscending:
            ": Activar para ordenar la columna de manera ascendente",
          sSortDescending:
            ": Activar para ordenar la columna de manera descendente",
        },
      },
    })
    .DataTable();
};

(function () {
  //Initialize Select2 Elements:
  initializeSelect2Elements();

  obtenerListadoActividadesProyectosDataTable();

  getSelectListTypesActivitiesOptions(
    "../../controller/TiposActividadesController.php?op=obtener_listado_opciones_tipos_actividades",
    "#tipoActividadID"
  );

  getSelectListUnitsMeasurementsOptions(
    "../../controller/UnidadesMedidasController.php?op=obtener_listado_opciones_unidades_medidas",
    "#unidadMedidaID"
  );
})();
