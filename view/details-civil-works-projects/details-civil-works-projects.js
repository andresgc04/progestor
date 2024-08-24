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

const obtenerListadoActividadesProyectosObrasCivilesDataTable = (
  proyectoObraCivilID
) => {
  $("#listadoActividadesProyectosObrasCivilesDataTable")
    .dataTable({
      aProcessing: true,
      aServerSide: true,
      dom: "Bfrtip",
      searching: true,
      lengthChange: false,
      colReorder: true,
      buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
      ajax: {
        url: "../../controller/ActividadesProyectosObrasCivilesController.php?op=listado_actividades_proyectos_obras_civiles_por_proyecto_obra_civil_ID",
        type: "post",
        dataType: "json",
        data: { proyectoObraCivilID: proyectoObraCivilID },
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

  obtenerListadoActividadesProyectosObrasCivilesDataTable(proyectoObraCivilID);
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

const openUpdateProjectActivityFormModal = () => {
  $("#updateProjectActivityFormModal").modal("show");
};

const obtenerDetallesActividadesProyectosObrasCivilesPorActividadProyectoObraCivilIDYProyectoObraCivilID =
  (actividadProyectoObraCivilID, proyectoObraCivilID) => {
    $.post(
      "../../controller/ActividadesProyectosObrasCivilesController.php?op=obtener_detalles_actividades_proyectos_obras_civiles_por_actividad_proyecto_obra_civil_ID_proyecto_obra_civil_ID",
      {
        actividadProyectoObraCivilID: actividadProyectoObraCivilID,
        proyectoObraCivilID: proyectoObraCivilID,
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
            actividadID,
            proyectoObraCivilID,
            tipoActividadID,
            nombreActividad,
            descripcionActividad,
            costoActividad,
          } = responseData;

          const modifyActividadProyectoObraCivilIDInput =
            document.getElementById("modifyActividadProyectoObraCivilID");

          const modifyProyectoObraCivilIDInput = document.getElementById(
            "modifyProyectoObraCivilID"
          );

          const modifyTipoActividadIDInput = document.getElementById(
            "modifyTipoActividadID"
          );

          const modifyNombreActividadInput = document.getElementById(
            "modifyNombreActividad"
          );

          const modifyDescripcionActividadInput = document.getElementById(
            "modifyDescripcionActividad"
          );

          const modifyCostoActividadInput = document.getElementById(
            "modifyCostoActividad"
          );

          modifyActividadProyectoObraCivilIDInput.value =
            actividadID != null ? actividadID : "";

          modifyProyectoObraCivilIDInput.value =
            proyectoObraCivilID != null ? proyectoObraCivilID : "";

          getSelectListTypesActivitiesOptionsByTipoActividadID(
            "../../controller/TiposActividadesController.php?op=obtener_listado_opciones_tipos_actividades_por_tipo_actividad_ID",
            tipoActividadID,
            "#modifyTipoActividadID"
          );

          modifyNombreActividadInput.value =
            nombreActividad != null ? nombreActividad : "";

          modifyDescripcionActividadInput.value =
            descripcionActividad != null ? descripcionActividad : "";

          modifyCostoActividadInput.value =
            costoActividad != null ? costoActividad : "";

          openUpdateProjectActivityFormModal();
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

const verDetalleActividadProyectoObraCivil = (
  actividadProyectoObraCivilID,
  proyectoObraCivilID
) => {
  obtenerDetallesActividadesProyectosObrasCivilesPorActividadProyectoObraCivilIDYProyectoObraCivilID(
    actividadProyectoObraCivilID,
    proyectoObraCivilID
  );
};
