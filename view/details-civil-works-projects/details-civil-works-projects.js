navLinkPrimary("navLinkHomeProjects");

setContentHeaderTitle("Detalles Del Proyecto");

setBreadCrumbContentHeaderTitle(
  "../home-civil-works-projects",
  "Listado De Proyectos"
);

setBreadCrumbContentHeaderSubTitle("Detalles Del Proyecto");

const obtenerDatosProyectosObrasCivilesPorProyectoObraCivilIDSolicitudProyectoID =
  (proyectoObraCivilID, solicitudProyectoID) => {
    $.post(
      "../../controller/ProyectosObrasCivilesController.php?op=obtener_datos_proyectos_obras_civiles_por_proyecto_obra_civil_ID_solicitud_proyecto_ID",
      {
        proyectoObraCivilID: proyectoObraCivilID,
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
            proyectoObraCivilID,
            solicitudProyectoID,
            nombreProyecto,
            objetivoProyecto,
            descripcionProyecto,
            fechaEstimadaDeseada,
            nombreCliente,
            tipoProyectoObraCivil,
            categoriaTipoProyectoObraCivil,
            responsable,
            fechaInicioProyecto,
            estado,
          } = responseData;

          const proyectoObraCivilIDInput = document.getElementById(
            "proyectoObraCivilID"
          );

          const solicitudProyectoIDInput = document.getElementById(
            "solicitudProyectoID"
          );

          const nombreProyectoInput = document.getElementById("nombreProyecto");

          const objetivoProyectoInput =
            document.getElementById("objetivoProyecto");

          const descripcionProyectoInput = document.getElementById(
            "descripcionProyecto"
          );

          const tipoProyectoObraCivilInput = document.getElementById(
            "tipoProyectoObraCivil"
          );

          const categoriaTipoProyectoObraCivilInput = document.getElementById(
            "categoriaTipoProyectoObraCivil"
          );

          const solicitadoPorInput = document.getElementById("solicitadoPor");

          const fechaEstimadaDeseadaInput = document.getElementById(
            "fechaEstimadaDeseada"
          );

          const responsableProyectoInput = document.getElementById(
            "responsableProyecto"
          );

          const fechaInicioProyectoInput = document.getElementById(
            "fechaInicioProyecto"
          );

          const EstadoProyectoInput = document.getElementById("estadoProyecto");

          proyectoObraCivilIDInput.value =
            proyectoObraCivilID != null ? proyectoObraCivilID : "";

          solicitudProyectoIDInput.value =
            solicitudProyectoID != null ? solicitudProyectoID : "";

          nombreProyectoInput.value =
            nombreProyecto != null ? nombreProyecto : "";

          objetivoProyectoInput.value =
            objetivoProyecto != null ? objetivoProyecto : "";

          descripcionProyectoInput.value =
            descripcionProyecto != null ? descripcionProyecto : "";

          tipoProyectoObraCivilInput.value =
            tipoProyectoObraCivil != null ? tipoProyectoObraCivil : "";

          categoriaTipoProyectoObraCivilInput.value =
            categoriaTipoProyectoObraCivil != null
              ? categoriaTipoProyectoObraCivil
              : "";

          solicitadoPorInput.value = nombreCliente != null ? nombreCliente : "";

          fechaEstimadaDeseadaInput.value =
            fechaEstimadaDeseada != null ? fechaEstimadaDeseada : "";

          responsableProyectoInput.value =
            responsable != null ? responsable : "";

          fechaInicioProyectoInput.value =
            fechaInicioProyecto != null ? fechaInicioProyecto : "";

          EstadoProyectoInput.value = estado != null ? estado : "";
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
  //Initialize Select2 Elements:
  initializeSelect2Elements();

  const proyectoObraCivilID = getParams("proyectoObraCivilID");
  const solicitudProyectoID = getParams("solicitudProyectoID");

  obtenerDatosProyectosObrasCivilesPorProyectoObraCivilIDSolicitudProyectoID(
    proyectoObraCivilID,
    solicitudProyectoID
  );

  getSelectListTypesActivitiesOptions(
    "../../controller/TiposActividadesController.php?op=obtener_listado_opciones_tipos_actividades",
    "#tipoActividadID"
  );
})();

const openAddNewProjectActivityFormModal = () => {
  const proyectoObraCivilIDInput = document.getElementById(
    "addActivityProyectoObraCivilID"
  );
  proyectoObraCivilIDInput.value = getParams("proyectoObraCivilID");

  $("#newProjectActivityFormModal").modal("show");
};

const addNewProjectActivityButton = document.getElementById(
  "addNewProjectActivityButton"
);
addNewProjectActivityButton.addEventListener("click", () => {
  openAddNewProjectActivityFormModal();
});
