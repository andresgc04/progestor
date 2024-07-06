navLinkPrimary("navLinkHomeProjectRequests");

setContentHeaderTitle("Detalle De Solicitud De Proyectos");

setBreadCrumbContentHeaderTitle(
  "../home-project-requests/",
  "Listado De Solicitudes De Proyectos"
);

setBreadCrumbContentHeaderSubTitle("Detalle De Solicitud De Proyectos");

const obtenerEncabezadoSolicitudesProyectosPorSolicitudProyectoID = (
  solicitudProyectoID
) => {
  $.post(
    "../../controller/SolicitudesProyectosController.php?op=obtener_encabezado_solicitudes_proyectos_por_solicitud_proyecto_ID",
    {
      solicitudProyectoID: solicitudProyectoID,
    },
    "json"
  )
    .done(function (data) {
      if (data.error) {
        Swal.fire({
          position: "center",
          icon: "warning",
          title: "Ocurrio un error!!",
          text: `${data.error}`,
          showConfirmButton: false,
          timer: 2000,
          timerProgressBar: true,
        }).then(
          (willClose = () => {
            window.location.reload();
          })
        );
      } else {
        const responseData = data.data;

        const {
          solicitudProyectoID,
          descripcionProyecto,
          objetivoProyecto,
          presupuestoProyecto,
          estado,
        } = responseData;

        const solicitudProyectoIDInput = document.getElementById(
          "solicitudProyectoID"
        );

        const descripcionProyectoInput = document.getElementById(
          "descripcionProyecto"
        );

        const objetivoProyectoInput =
          document.getElementById("objetivoProyecto");

        const presupuestoProyectoInput = document.getElementById(
          "presupuestoProyecto"
        );

        const estadoSolicitudInput = document.getElementById("estadoSolicitud");

        solicitudProyectoIDInput.value =
          solicitudProyectoID != null ? solicitudProyectoID : "";

        descripcionProyectoInput.value =
          descripcionProyecto != null ? descripcionProyecto : "";

        objetivoProyectoInput.value =
          objetivoProyecto != null ? objetivoProyecto : "";

        presupuestoProyectoInput.value =
          presupuestoProyecto != null ? presupuestoProyecto : "";

        estadoSolicitudInput.value = estado != null ? estado : "";
      }
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
      Swal.fire({
        position: "center",
        icon: "warning",
        title: `${textStatus}`,
        text: `${errorThrown}`,
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
      }).then(
        (willClose = () => {
          window.location.reload();
        })
      );
    });
};

const obtenerRequerimientosSolicitudesProyectosPorSolicitudProyectoIDDataTable =
  (solicitudProyectoID) => {
    $("#listadoRequerimientosSolicitudesProyectosDataTable")
      .dataTable({
        aProcessing: true,
        aServerSide: true,
        dom: "Bfrtip",
        searching: true,
        lengthChange: false,
        colReorder: true,
        buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
        ajax: {
          url: "../../controller/SolicitudesProyectosController.php?op=obtener_requerimientos_solicitudes_proyectos_por_solicitud_proyecto_ID",
          type: "post",
          dataType: "json",
          data: { solicitudProyectoID: solicitudProyectoID },
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
  const solicitudProyectoID = getParams("solicitudProyectoID");

  obtenerEncabezadoSolicitudesProyectosPorSolicitudProyectoID(
    solicitudProyectoID
  );

  obtenerRequerimientosSolicitudesProyectosPorSolicitudProyectoIDDataTable(
    solicitudProyectoID
  );
})();

const retroceder = () => {
  window.location.href = "../home-project-requests/";
};
