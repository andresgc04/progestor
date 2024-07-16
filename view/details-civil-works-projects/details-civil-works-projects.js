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
            descripcionProyecto,
            tipoProyectoObraCivilID,
            categoriaTipoProyectoObraCivilID,
            responsableID,
            fechaInicioProyecto,
            fechaFinalizacionProyecto,
            estado,
          } = responseData;

          const proyectoObraCivilIDInput = document.getElementById(
            "proyectoObraCivilID"
          );

          const solicitudProyectoIDInput = document.getElementById(
            "solicitudProyectoID"
          );

          const nombreProyectoInput = document.getElementById("nombreProyecto");

          const descripcionProyectoInput = document.getElementById(
            "descripcionProyecto"
          );

          const fechaInicioProyectoInput = document.getElementById(
            "fechaInicioProyecto"
          );

          const fechaFinalizacionProyectoInput = document.getElementById(
            "fechaFinalizacionProyecto"
          );

          const EstadoProyectoInput = document.getElementById("EstadoProyecto");

          proyectoObraCivilIDInput.value =
            proyectoObraCivilID != null ? proyectoObraCivilID : "";

          solicitudProyectoIDInput.value =
            solicitudProyectoID != null ? solicitudProyectoID : "";

          nombreProyectoInput.value =
            nombreProyecto != null ? nombreProyecto : "";

          descripcionProyectoInput.value =
            descripcionProyecto != null ? descripcionProyecto : "";

          fechaInicioProyectoInput.value =
            fechaInicioProyecto != null ? fechaInicioProyecto : "";

          fechaFinalizacionProyectoInput.value =
            fechaFinalizacionProyecto != null ? fechaFinalizacionProyecto : "";

          getSelectListProjectManagerOptionsByResposableID(
            "../../controller/EmpleadosController.php?op=obtener_listado_opciones_responsables_proyecto_por_responsable_ID",
            responsableID,
            "#responsableID"
          );

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
  const proyectoObraCivilID = getParams("proyectoObraCivilID");
  const solicitudProyectoID = getParams("solicitudProyectoID");

  obtenerDatosProyectosObrasCivilesPorProyectoObraCivilIDSolicitudProyectoID(
    proyectoObraCivilID,
    solicitudProyectoID
  );
})();
