navLinkPrimary("navLinkMaintenance");

navLinkSecondary("navLinkHomeLaborResources");

setContentHeaderTitle("Listado De Recursos De Manos De Obras");

setBreadCrumbContentHeaderTitle("../dashboard/", "Dashboard");

setBreadCrumbContentHeaderSubTitle("Listado De Recursos De Manos De Obras");

const openNewLaborResourcesFormModal = () => {
  $("#newLaborResourcesFormModal").modal("show");
};

const newLaborResourcesButton = document.getElementById(
  "newLaborResourcesButton"
);
newLaborResourcesButton.addEventListener("click", () => {
  openNewLaborResourcesFormModal();
});

const obtenerListadoRecursosManosObrasDataTable = () => {
  $("#listadoRecursosManosObrasDataTable")
    .dataTable({
      aProcessing: true,
      aServerSide: true,
      dom: "Bfrtip",
      searching: true,
      lengthChange: false,
      colReorder: true,
      buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
      ajax: {
        url: "../../controller/RecursosManosObrasController.php?op=listado_recursos_manos_obras",
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

  getSelectListTypesPaymentsOptions(
    "../../controller/TiposPagosController.php?op=obtener_listado_opciones_tipos_pagos",
    "#tipoPagoID"
  );

  obtenerListadoRecursosManosObrasDataTable();
})();
