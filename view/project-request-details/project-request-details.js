navLinkPrimary("navLinkHomeProjectRequests");

setContentHeaderTitle("Detalle De Solicitud De Proyectos");

setBreadCrumbContentHeaderTitle(
  "../home-project-requests/",
  "Listado De Solicitudes De Proyectos"
);

setBreadCrumbContentHeaderSubTitle("Detalle De Solicitud De Proyectos");

let nombreProyecto = document.getElementById("nombreProyecto");

let objetivoProyecto = document.getElementById("objetivoProyecto");

let descripcionProyecto = document.getElementById("descripcionProyecto");

let fechaEstimadaDeseada = document.getElementById("fechaEstimadaDeseada");

let addNewProjectRequestRequirementButton = document.getElementById(
  "addNewProjectRequestRequirementButton"
);

let validateUpdateRequestDetailsButton = document.getElementById(
  "validateUpdateRequestDetailsButton"
);

let validateCancelProjectRequestDetailsButton = document.getElementById(
  "validateCancelProjectRequestDetailsButton"
);

let validateSubmissionProjectRequestDetailButton = document.getElementById(
  "validateSubmissionProjectRequestDetailButton"
);

const mantenerHabilitadosInputsEnEstadoActivo = () => {
  nombreProyecto.removeAttribute("readonly", true);
  objetivoProyecto.removeAttribute("readonly", true);
  descripcionProyecto.removeAttribute("readonly", true);
  fechaEstimadaDeseada.removeAttribute("readonly", true);
  addNewProjectRequestRequirementButton.style.display = "block";
  validateUpdateRequestDetailsButton.style.display = "block";
  validateCancelProjectRequestDetailsButton.style.display = "block";
  validateSubmissionProjectRequestDetailButton.style.display = "block";
};

const deshabilitarInputsEnEstadosDiferentesEstadoActivo = () => {
  nombreProyecto.setAttribute("readonly", true);
  objetivoProyecto.setAttribute("readonly", true);
  descripcionProyecto.setAttribute("readonly", true);
  fechaEstimadaDeseada.setAttribute("readonly", true);
  addNewProjectRequestRequirementButton.style.display = "none";
  validateUpdateRequestDetailsButton.style.display = "none";
  validateCancelProjectRequestDetailsButton.style.display = "none";
  validateSubmissionProjectRequestDetailButton.style.display = "none";
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

        const nombreClienteInput = document.getElementById("nombreCliente");

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

        nombreClienteInput.value = nombreCliente != null ? nombreCliente : "";

        estadoSolicitudInput.value = estado != null ? estado : "";

        switch (estado) {
          case "ACTIVO":
            mantenerHabilitadosInputsEnEstadoActivo();
            break;
          case "PENDIENTE":
            deshabilitarInputsEnEstadosDiferentesEstadoActivo();
            break;
          case "APROBADO":
            deshabilitarInputsEnEstadosDiferentesEstadoActivo();
            break;
          case "CANCELADO":
            deshabilitarInputsEnEstadosDiferentesEstadoActivo();
            break;
          case "RECHAZADO":
            deshabilitarInputsEnEstadosDiferentesEstadoActivo();
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

const obtenerDocumentosSolicitudesProyectosPorSolicitudProyectoIDDataTable = (
  solicitudProyectoID
) => {
  $("#listadoDocumentosSolicitudesProyectosDataTable")
    .dataTable({
      aProcessing: true,
      aServerSide: true,
      dom: "Bfrtip",
      searching: true,
      lengthChange: false,
      colReorder: true,
      buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
      ajax: {
        url: "../../controller/SolicitudesProyectosController.php?op=obtener_documentos_solicitudes_proyectos_por_solicitud_proyecto_ID",
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
  //Initialize Date picker:
  $("#fechaEstimadaDeseada").datetimepicker({
    format: "YYYY/MM/DD",
  });

  const solicitudProyectoID = getParams("solicitudProyectoID");

  obtenerEncabezadoSolicitudesProyectosPorSolicitudProyectoID(
    solicitudProyectoID
  );

  obtenerRequerimientosSolicitudesProyectosPorSolicitudProyectoIDDataTable(
    solicitudProyectoID
  );

  obtenerDocumentosSolicitudesProyectosPorSolicitudProyectoIDDataTable(
    solicitudProyectoID
  );
})();

const retroceder = () => {
  window.location.href = "../home-project-requests/";
};

const openAddNewProjectRequestRequirementFormModal = () => {
  const solicitudProyectoID = getParams("solicitudProyectoID");

  const agregarSolicitudProyectoID = document.getElementById(
    "agregarSolicitudProyectoID"
  );
  agregarSolicitudProyectoID.value = solicitudProyectoID;

  $("#addNewProjectRequestRequirementFormModal").modal("show");
};

addNewProjectRequestRequirementButton = document.getElementById(
  "addNewProjectRequestRequirementButton"
);
addNewProjectRequestRequirementButton.addEventListener("click", () => {
  openAddNewProjectRequestRequirementFormModal();
});

const obtenerRequerimientoSolicitudProyectoPorSolicitudProyectoIDYRequerimientoSolicitudProyectoID =
  (solicitudProyectoID, requerimientoSolicitudProyectoID) => {
    $.post(
      "../../controller/SolicitudesProyectosController.php?op=obtener_requerimiento_solicitud_proyecto_por_solicitud_proyecto_ID_requerimiento_solicitud_proyecto_ID",
      {
        solicitudProyectoID: solicitudProyectoID,
        requerimientoSolicitudProyectoID: requerimientoSolicitudProyectoID,
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
            requerimientoSolicitudProyectoID,
            descripcionRequerimiento,
          } = responseData;

          const modificarSolicitudProyectoIDInput = document.getElementById(
            "modificarSolicitudProyectoID"
          );
          const modificarRequerimientoSolicitudProyectoIDInput =
            document.getElementById(
              "modificarRequerimientoSolicitudProyectoID"
            );
          const modificarDescripcionRequerimientoInput =
            document.getElementById("modificarDescripcionRequerimiento");

          modificarSolicitudProyectoIDInput.value =
            solicitudProyectoID != null ? solicitudProyectoID : "";

          modificarRequerimientoSolicitudProyectoIDInput.value =
            requerimientoSolicitudProyectoID != null
              ? requerimientoSolicitudProyectoID
              : "";

          modificarDescripcionRequerimientoInput.value =
            descripcionRequerimiento != null ? descripcionRequerimiento : "";

          $("#updateProjectRequestRequirementFormModal").modal("show");
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

const verDetallesRequerimientosSolicitudesProyectos = (
  solicitudProyectoID,
  requerimientoSolicitudProyectoID
) => {
  obtenerRequerimientoSolicitudProyectoPorSolicitudProyectoIDYRequerimientoSolicitudProyectoID(
    solicitudProyectoID,
    requerimientoSolicitudProyectoID
  );
};

const obtenerRutaDocumentoSolicitudProyectoPorDocumentoIDYSolicitudProyectoID =
  (documentoID, solicitudProyectoID) => {
    $.post(
      "../../controller/SolicitudesProyectosController.php?op=obtener_ruta_documento_solicitud_proyecto_por_documento_ID_solicitud_proyecto_ID",
      {
        documentoID: documentoID,
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

          const { nombreDocumento } = responseData;

          const rutaDocumento = `../../documents/${nombreDocumento}`;

          console.log(rutaDocumento);

          window.open(rutaDocumento, "_blank");
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

const verDetallesDocumentosSolicitudesProyectos = (
  documentoID,
  solicitudProyectoID
) => {
  obtenerRutaDocumentoSolicitudProyectoPorDocumentoIDYSolicitudProyectoID(
    documentoID,
    solicitudProyectoID
  );
};

const eliminarRequerimientoSolicitudesProyectos = (
  solicitudProyectoID,
  requerimientoSolicitudProyectoID
) => {
  Swal.fire({
    title:
      "¿Deseas eliminar este requerimiento de solicitud de proyecto seleccionado?",
    inputAttributes: {
      autocapitalize: "off",
    },
    showCancelButton: true,
    confirmButtonText: "Eliminar",
    showLoaderOnConfirm: true,
    preConfirm: () => {
      $.post(
        "../../controller/SolicitudesProyectosController.php?op=modificar_requerimiento_solicitud_proyecto_cambiar_estado_activo_eliminado_por_solicitud_proyecto_ID_requerimiento_solicitud_proyecto_ID",
        {
          solicitudProyectoID: solicitudProyectoID,
          requerimientoSolicitudProyectoID: requerimientoSolicitudProyectoID,
        }
      )
        .done(function (data, status) {
          Swal.fire({
            position: "center",
            icon: "success",
            title:
              "Requerimiento de solicitud de proyecto eliminado satisfactoriamente.",
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

// Función para multiplicar los valores de los inputs:
const calcularAreaTotaTerreno = () => {
  // Obtener los valores de los inputs:
  const dimensionMetroLargoTerrenoValue =
    parseFloat(document.getElementById("dimensionMetroLargoTerreno").value) ||
    0;

  const dimensionMetroAnchoTerrenoValue =
    parseFloat(document.getElementById("dimensionMetroAnchoTerreno").value) ||
    0;

  // Multiplicar los valores:
  const resultadoAreaTotalTerreno =
    dimensionMetroLargoTerrenoValue * dimensionMetroAnchoTerrenoValue;

  document.getElementById("areaTotalTerreno").value = resultadoAreaTotalTerreno;
};

// Agregar eventos de 'input' a los campos de entrada:
document
  .getElementById("dimensionMetroLargoTerreno")
  .addEventListener("input", calcularAreaTotaTerreno);

document
  .getElementById("dimensionMetroAnchoTerreno")
  .addEventListener("input", calcularAreaTotaTerreno);
