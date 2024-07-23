navLinkPrimary("navLinkMaintenance");

navLinkSecondary("navLinkHomeTypesSuppliers");

setContentHeaderTitle("Listado De Tipos De Proveedores");

setBreadCrumbContentHeaderTitle("../dashboard/", "Dashboard");

setBreadCrumbContentHeaderSubTitle("Listado De Tipos De Proveedores");

const openNewTypesSuppliersFormModal = () => {
  $("#newTypesSuppliersFormModal").modal("show");
};

const newTypesSuppliersButton = document.getElementById(
  "newTypesSuppliersButton"
);
newTypesSuppliersButton.addEventListener("click", () => {
  openNewTypesSuppliersFormModal();
});

const obtenerListadoTiposProveedoresDataTable = () => {
  $("#listadoTiposProveedoresDataTable")
    .dataTable({
      aProcessing: true,
      aServerSide: true,
      dom: "Bfrtip",
      searching: true,
      lengthChange: false,
      colReorder: true,
      buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
      ajax: {
        url: "../../controller/TiposProveedoresController.php?op=listado_tipos_proveedores",
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
  obtenerListadoTiposProveedoresDataTable();
})();

const openUpdateTypesSuppliersFormModal = () => {
  $("#updateTypesSuppliersFormModal").modal("show");
};

const verDetalleTipoProveedor = (tipoProveedorID) => {
  const tipoProveedorIDInput = document.getElementById("tipoProveedorID");
  tipoProveedorIDInput.value = tipoProveedorID;

  openUpdateTypesSuppliersFormModal();
};
