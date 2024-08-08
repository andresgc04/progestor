navLinkPrimary("navLinkViewHomeProjectRequests");

setContentHeaderTitle("Crear Nuevo Proyecto");

setBreadCrumbContentHeaderTitle(
  "../view-home-project-requests/",
  "Listado De Solicitudes De Proyectos"
);

setBreadCrumbContentHeaderSubTitle("Crear Nuevo Proyecto");

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
          fechaEstimadaDeseada,
          nombreCliente,
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

        const fechaEstimadaDeseadaInput = document.getElementById(
          "fechaEstimadaDeseada"
        );

        const solicitadoPorInput = document.getElementById("solicitadoPor");

        solicitudProyectoIDInput.value =
          solicitudProyectoID != null ? solicitudProyectoID : "";

        nombreProyectoInput.value =
          nombreProyecto != null ? nombreProyecto : "";

        descripcionProyectoInput.value =
          descripcionProyecto != null ? descripcionProyecto : "";

        objetivoProyectoInput.value =
          objetivoProyecto != null ? objetivoProyecto : "";

        fechaEstimadaDeseadaInput.value =
          fechaEstimadaDeseada != null ? fechaEstimadaDeseada : "";

        solicitadoPorInput.value = nombreCliente != null ? nombreCliente : "";
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

(function () {
  //GetParams:
  const solicitudProyectoID = getParams("solicitudProyectoID");

  //Initialize Select2 Elements:
  initializeSelect2Elements();

  obtenerEncabezadoSolicitudesProyectosPorSolicitudProyectoID(
    solicitudProyectoID
  );

  //Initialize Date picker:
  $("#fechaInicioProyecto").datetimepicker({
    format: "YYYY/MM/DD",
  });

  getSelectListTypesCivilWorksProjectsOptions(
    "../../controller/TiposProyectosObrasCivilesController.php?op=obtener_listado_opciones_tipos_proyectos_obras_civiles",
    "#tipoProyectoObraCivilID"
  );

  getSelectListProjectManagersOptions(
    "../../controller/EmpleadosController.php?op=obtener_listado_opciones_responsables_proyecto",
    "#responsableID"
  );
})();

const tipoProyectoObraCivilIDInput = document.getElementById(
  "tipoProyectoObraCivilID"
);
tipoProyectoObraCivilIDInput.onchange = (event) => {
  const tipoProyectoObraCivilID = event.target.value;

  getSelectListCategoriesTypesProjectsCivilWorksOptionsByTipoProyectoObraCivilID(
    "../../controller/CategoriasTiposProyectosObrasCivilesController.php?op=obtener_listado_opciones_categorias_tipos_proyectos_obras_civiles_por_tipo_proyecto_obra_civil_ID",
    tipoProyectoObraCivilID,
    "#categoriaTipoProyectoObraCivilID"
  );
};
