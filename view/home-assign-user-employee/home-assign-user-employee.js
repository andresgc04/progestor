navLinkPrimary("navLinkUsers");

navLinkSecondary("navLinkHomeAssignUserEmployee");

setContentHeaderTitle("Listado De Usuarios Asignados A Empleados");

setBreadCrumbContentHeaderTitle("../dashboard/", "Dashboard");

setBreadCrumbContentHeaderSubTitle("Listado De Usuarios Asignados A Empleados");

const obtenerListadoUsuariosAsignadosEmpleadosDataTable = () => {
  $("#listadoUsuariosAsignadosEmpleadosDataTable")
    .dataTable({
      aProcessing: true,
      aServerSide: true,
      dom: "Bfrtip",
      searching: true,
      lengthChange: false,
      colReorder: true,
      buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
      ajax: {
        url: "../../controller/UsuariosController.php?op=listado_usuarios_asignados_empleados",
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
      iDisplayLength: 5,
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
  obtenerListadoUsuariosAsignadosEmpleadosDataTable();
})();

const openNewAssignUserEmployeeForm = () => {
  window.location.href = "../new-assign-user-employee/";
};

const newAssignUserEmployeeButton = document.getElementById(
  "newAssignUserEmployeeButton"
);
newAssignUserEmployeeButton.addEventListener("click", () => {
  openNewAssignUserEmployeeForm();
});
