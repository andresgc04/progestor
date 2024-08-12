navLinkPrimary("navLinkHomeAssignSystemModuleRole");

setContentHeaderTitle("Listado De Accesos A Módulos Del Sistema");

setBreadCrumbContentHeaderTitle("../dashboard/", "Dashboard");

setBreadCrumbContentHeaderSubTitle("Listado De Accesos A Módulos Del Sistema");

const openNewAssignSystemModuleRoleFormModal = () => {
  $("#newAssignSystemModuleRoleFormModal").modal("show");
};

const newAssingSystemModuleRoleButton = document.getElementById(
  "newAssingSystemModuleRoleButton"
);
newAssingSystemModuleRoleButton.addEventListener("click", () => {
  openNewAssignSystemModuleRoleFormModal();
});

const obtenerListadoAccesosModulosSistemaDataTable = () => {
  $("#listadoAccesosModulosSistemasDataTable")
    .dataTable({
      aProcessing: true,
      aServerSide: true,
      dom: "Bfrtip",
      searching: true,
      lengthChange: false,
      colReorder: true,
      buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
      ajax: {
        url: "../../controller/AccesosModulosSistemasController.php?op=obtener_listado_accesos_modulos_sistemas",
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

  getSelectListRolesOptions(
    "../../controller/RolesController.php?op=obtener_listado_opciones_roles",
    "#rolID"
  );

  getSelectListSystemModulesOptions(
    "../../controller/ModulosSistemasController.php?op=obtener_listado_opciones_modulos_sistemas",
    "#moduloSistemaID"
  );

  obtenerListadoAccesosModulosSistemaDataTable();
})();
