navLinkPrimary("navLinkHomeProjects");

setContentHeaderTitle("Detalles Del Proyecto");

setBreadCrumbContentHeaderTitle(
  "../home-clients-civil-works-projects/",
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
            dimensionMetroLargoTerreno,
            dimensionMetroAnchoTerreno,
            areaTotalTerreno,
            ubicacion,
            presupuestoEstimadoProyecto,
            fechaEstimadaDeseada,
            verificacionTituloPropiedad,
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

          const dimensionMetroLargoTerrenoInput = document.getElementById(
            "dimensionMetroLargoTerreno"
          );

          const dimensionMetroAnchoTerrenoInput = document.getElementById(
            "dimensionMetroAnchoTerreno"
          );

          const areaTotalTerrenoInput =
            document.getElementById("areaTotalTerreno");

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

          const tipoProyectoObraCivilInput = document.getElementById(
            "tipoProyectoObraCivil"
          );

          const categoriaTipoProyectoObraCivilInput = document.getElementById(
            "categoriaTipoProyectoObraCivil"
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

          dimensionMetroLargoTerrenoInput.value =
            dimensionMetroLargoTerreno != null
              ? dimensionMetroLargoTerreno
              : "";

          dimensionMetroAnchoTerrenoInput.value =
            dimensionMetroAnchoTerreno != null
              ? dimensionMetroAnchoTerreno
              : "";

          areaTotalTerrenoInput.value =
            areaTotalTerreno != null ? areaTotalTerreno : "";

          ubicacionInput.value = ubicacion != null ? ubicacion : "";

          const presupuestoEstimadoProyectoFormatValue = parseFloat(
            presupuestoEstimadoProyecto
          ).toLocaleString("es-DO", {
            style: "currency",
            currency: "DOP",
          });

          presupuestoEstimadoProyectoInput.value =
            presupuestoEstimadoProyectoFormatValue != null
              ? presupuestoEstimadoProyectoFormatValue
              : "";

          localStorage.setItem(
            "presupuestoEstimadoProyecto",
            presupuestoEstimadoProyecto
          );

          fechaEstimadaDeseadaInput.value =
            fechaEstimadaDeseada != null ? fechaEstimadaDeseada : "";

          verificacionTituloInput.value =
            verificacionTituloPropiedad != null
              ? verificacionTituloPropiedad
              : "";

          solicitadoPorInput.value = nombreCliente != null ? nombreCliente : "";

          tipoProyectoObraCivilInput.value =
            tipoProyectoObraCivil != null ? tipoProyectoObraCivil : "";

          categoriaTipoProyectoObraCivilInput.value =
            categoriaTipoProyectoObraCivil != null
              ? categoriaTipoProyectoObraCivil
              : "";

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
  const proyectoObraCivilID = getParams("proyectoObraCivilID");
  const solicitudProyectoID = getParams("solicitudProyectoID");

  obtenerDatosProyectosObrasCivilesPorProyectoObraCivilIDSolicitudProyectoID(
    proyectoObraCivilID,
    solicitudProyectoID
  );

  //   obtenerListadoActividadesProyectosObrasCivilesDataTable(proyectoObraCivilID);

  //   obtenerListadoRecursosMaterialesProyectosObrasCivilesDataTable(
  //     proyectoObraCivilID
  //   );

  //   obtenerListadoRecursosManosObrasProyectosObrasCivilesDataTable(
  //     proyectoObraCivilID
  //   );

  //   obtenerCostosTotalesActividadesProyectosObrasCivilesPorProyectoObraCivilID(
  //     proyectoObraCivilID
  //   );

  //   obtenerCostosTotalesRecursosMaterialesProyectosObrasCivilesPorProyectoObraCivilID(
  //     proyectoObraCivilID
  //   );

  //   obtenerCostosTotalesRecursosManosObrasProyectosObrasCivilesPorProyectoObraCivilID(
  //     proyectoObraCivilID
  //   );

  //   obtenerListadoDocumentosProyectosObrasCivilesDataTable(
  //     solicitudProyectoID,
  //     proyectoObraCivilID
  //   );

  //   obtenerCostoTotalProyectoObraCivil();

  //   verificarConsumoPresupuestoCliente();
})();
