navLinkPrimary("navLinkHomeProjectRequests");

setContentHeaderTitle("Listado De Solicitudes De Proyectos");

setBreadCrumbContentHeaderTitle("../dashboard/", "Dashboard");

setBreadCrumbContentHeaderSubTitle("Listado De Solicitudes De Proyectos");

const obtenerListadoSolicitudesProyectosPorUsuarioIDDataTable = () => {
  $("#listadoSolicitudesProyectosDataTable")
    .dataTable({
      aProcessing: true,
      aServerSide: true,
      dom: "Bfrtip",
      searching: true,
      lengthChange: false,
      colReorder: true,
      buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
      ajax: {
        url: "../../controller/SolicitudesProyectosController.php?op=listado_solicitudes_proyectos_por_usuarioID",
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
  obtenerListadoSolicitudesProyectosPorUsuarioIDDataTable();
})();

const goNewProjectRequestsForm = () => {
  window.location.href = "../new-project-requests/";
};

const newProjectRequestsButton = document.getElementById(
  "newProjectRequestsButton"
);
newProjectRequestsButton.addEventListener("click", () => {
  goNewProjectRequestsForm();
});

const verDetalleSolicitudProyecto = (solicitudProyectoID) => {
  window.location.href = `../project-request-details/index.php?solicitudProyectoID=${solicitudProyectoID}`;
};

const eliminarSolicitudProyecto = (solicitudProyectoID) => {
  Swal.fire({
    title: "¿Deseas eliminar esta solicitud de proyecto seleccionado?",
    inputAttributes: {
      autocapitalize: "off",
    },
    showCancelButton: true,
    confirmButtonText: "Eliminar",
    showLoaderOnConfirm: true,
    preConfirm: () => {
      $.post(
        "../../controller/SolicitudesProyectosController.php?op=modificar_solicitud_proyecto_cambiar_estado_activo_eliminado_por_solicitud_proyecto_ID",
        {
          solicitudProyectoID: solicitudProyectoID,
        }
      )
        .done(function (data, status) {
          Swal.fire({
            position: "center",
            icon: "success",
            title: "Solicitud de proyecto eliminado satisfactoriamente.",
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
          }).then(
            (willClose = () => {
              window.location.reload();
            })
          );
        })
        .fail(function (data, status) {
          Swal.fire({
            position: "center",
            icon: "error",
            title: "Ocurrio Un Error Inesperado.",
            text: `${dataResult.error}`,
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
          }).then(
            (willClose = () => {
              window.location.reload();
            })
          );
        });
    },
  });
};
