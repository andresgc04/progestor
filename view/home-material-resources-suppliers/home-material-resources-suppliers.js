navLinkPrimary("navLinkMaterialResources");

navLinkSecondary("navLinkHomeMaterialResourcesSuppliers");

setContentHeaderTitle("Listado De Recursos Materiales Por Proveedores");

setBreadCrumbContentHeaderTitle("../dashboard/", "Dashboard");

setBreadCrumbContentHeaderSubTitle(
  "Listado De Recursos Materiales Por Proveedores"
);

const openNewMaterialResourcesSuppliersFormModal = () => {
  $("#newMaterialResourcesSuppliersFormModal").modal("show");
};

const newMaterialResourcesSuppliersButton = document.getElementById(
  "newMaterialResourcesSuppliersButton"
);
newMaterialResourcesSuppliersButton.addEventListener("click", () => {
  openNewMaterialResourcesSuppliersFormModal();
});

const obtenerListadoRecursosMaterialesProveedoresDataTable = () => {
  $("#listadoRecursosMaterialesProveedoresDataTable")
    .dataTable({
      aProcessing: true,
      aServerSide: true,
      dom: "Bfrtip",
      searching: true,
      lengthChange: false,
      colReorder: true,
      buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
      ajax: {
        url: "../../controller/RecursosMaterialesProveedoresController.php?op=listado_recursos_materiales_proveedores",
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

  getSelectListTypesMaterialResourcesOptions(
    "../../controller/TiposRecursosMaterialesController.php?op=obtener_listado_opciones_tipos_recursos_materiales",
    "#tipoRecursoMaterialID"
  );

  getSelectListSuppliersOptions(
    "../../controller/ProveedoresController.php?op=obtener_listado_opciones_proveedores",
    "#proveedorID"
  );

  obtenerListadoRecursosMaterialesProveedoresDataTable();
})();

const tipoRecursoMaterialIDInput = document.getElementById(
  "tipoRecursoMaterialID"
);
tipoRecursoMaterialIDInput.onchange = function (event) {
  const tipoRecursoMaterialID = event.target.value;

  getSelectListMaterialResourcesOptionsByTipoRecursoMaterialID(
    "../../controller/RecursosMaterialesController.php?op=obtener_listado_opciones_recursos_materiales_por_tipo_recurso_material_ID",
    tipoRecursoMaterialID,
    "#recursoMaterialID"
  );
};

const openUpdateMaterialResourcesSuppliersFormModal = () => {
  $("#updateMaterialResourcesSuppliersFormModal").modal("show");
};

const verDetalleRecursoMaterialProveedor = (recursoMaterialID, proveedorID) => {
  console.log(recursoMaterialID, proveedorID);
  openUpdateMaterialResourcesSuppliersFormModal();
};
