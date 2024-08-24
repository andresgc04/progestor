navLinkPrimary("navLinkViewHomeProjectRequests");

setContentHeaderTitle("Detalle De Solicitud Del Proyecto");

setBreadCrumbContentHeaderTitle(
  "../view-home-project-requests/",
  "Listado De Solicitudes De Proyectos"
);

setBreadCrumbContentHeaderSubTitle("Detalle De Solicitud Del Proyecto");

let rejectProjectRequestButton = document.getElementById(
  "rejectProjectRequestButton"
);
let approveProjectRequestButton = document.getElementById(
  "approveProjectRequestButton"
);
let createNewProjectButton = document.getElementById("createNewProjectButton");

const mantenerHabilitadosButtons = () => {
  rejectProjectRequestButton.removeAttribute("style", "display:none");
  approveProjectRequestButton.removeAttribute("style", "display:none");
  createNewProjectButton.setAttribute("style", "display:none");
};

const deshabilitarButtons = () => {
  rejectProjectRequestButton.setAttribute("style", "display:none");
  approveProjectRequestButton.setAttribute("style", "display:none");
  createNewProjectButton.setAttribute("style", "display:none");
};

const habilitarCrearNuevoProyectoButton = () => {
  rejectProjectRequestButton.setAttribute("style", "display:none");
  approveProjectRequestButton.setAttribute("style", "display:none");
  createNewProjectButton.removeAttribute("style", "display:none");
};

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
          nombreProyecto,
          descripcionProyecto,
          objetivoProyecto,
          areaTotalTerreno,
          dimensionMetroLargoTerreno,
          dimensionMetroAnchoTerreno,
          ubicacion,
          presupuestoEstimadoProyecto,
          fechaEstimadaDeseada,
          verificacionTituloPropiedad,
          nombreCliente,
          estado,
        } = responseData;

        const solicitudProyectoIDInput = document.getElementById(
          "solicitudProyectoID"
        );

        const nombreProyectoInput = document.getElementById("nombreProyecto");

        const descripcionProyectoInput = document.getElementById(
          "descripcionProyecto"
        );

        const objetivoProyectoInput =
          document.getElementById("objetivoProyecto");

        const areaTotalTerrenoInput =
          document.getElementById("areaTotalTerreno");

        const dimensionMetroLargoTerrenoInput = document.getElementById(
          "dimensionMetroLargoTerreno"
        );

        const dimensionMetroAnchoTerrenoInput = document.getElementById(
          "dimensionMetroAnchoTerreno"
        );

        const ubicacionInput = document.getElementById("ubicacion");

        const presupuestoEstimadoProyectoInput = document.getElementById(
          "presupuestoEstimadoProyecto"
        );

        const fechaEstimadaDeseadaInput = document.getElementById(
          "fechaEstimadaDeseada"
        );

        const verificacionTituloInput =
          document.getElementById("verificacionTitulo");

        const solicitadoPorInput = document.getElementById("solicitadoPor");

        const estadoSolicitudInput = document.getElementById("estadoSolicitud");

        solicitudProyectoIDInput.value =
          solicitudProyectoID != null ? solicitudProyectoID : "";

        nombreProyectoInput.value =
          nombreProyecto != null ? nombreProyecto : "";

        descripcionProyectoInput.value =
          descripcionProyecto != null ? descripcionProyecto : "";

        objetivoProyectoInput.value =
          objetivoProyecto != null ? objetivoProyecto : "";

        areaTotalTerrenoInput.value =
          areaTotalTerreno != null ? areaTotalTerreno : "";

        dimensionMetroLargoTerrenoInput.value =
          dimensionMetroLargoTerreno != null ? dimensionMetroLargoTerreno : "";

        dimensionMetroAnchoTerrenoInput.value =
          dimensionMetroAnchoTerreno != null ? dimensionMetroAnchoTerreno : "";

        ubicacionInput.value = ubicacion != null ? ubicacion : "";

        presupuestoEstimadoProyectoInput.value =
          presupuestoEstimadoProyecto != null
            ? presupuestoEstimadoProyecto
            : "";

        fechaEstimadaDeseadaInput.value =
          fechaEstimadaDeseada != null ? fechaEstimadaDeseada : "";

        verificacionTituloInput.value =
          verificacionTituloPropiedad != null
            ? verificacionTituloPropiedad
            : "";

        solicitadoPorInput.value = nombreCliente != null ? nombreCliente : "";

        estadoSolicitudInput.value = estado != null ? estado : "";

        switch (estado) {
          case "PENDIENTE":
            mantenerHabilitadosButtons();
            break;
          case "RECHAZADO":
            deshabilitarButtons();
            break;
          case "APROBADO":
            habilitarCrearNuevoProyectoButton();
            break;
        }
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
  const solicitudProyectoID = getParams("solicitudProyectoID");

  obtenerEncabezadoSolicitudesProyectosPorSolicitudProyectoID(
    solicitudProyectoID
  );

  obtenerRequerimientosSolicitudesProyectosPorSolicitudProyectoIDDataTable(
    solicitudProyectoID
  );
})();

createNewProjectButton.addEventListener("click", () => {
  window.location.href = `../new-project/index.php?solicitudProyectoID=${getParams(
    "solicitudProyectoID"
  )}`;
});
