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

const obtenerListadoRecursosMaterialesProyectosObrasCivilesDataTable = (
  proyectoObraCivilID
) => {
  $("#listadoRecursosMaterialesProyectosObrasCivilesDataTable")
    .dataTable({
      aProcessing: true,
      aServerSide: true,
      dom: "Bfrtip",
      searching: true,
      lengthChange: false,
      colReorder: true,
      buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
      ajax: {
        url: "../../controller/RecursosMaterialesProyectosObrasCivilesController.php?op=listado_recursos_materiales_proyectos_obras_civiles_por_proyecto_obra_civil_ID",
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

const obtenerListadoRecursosManosObrasProyectosObrasCivilesDataTable = (
  proyectoObraCivilID
) => {
  $("#listadoRecursosManosObrasProyectosObrasCivilesDataTable")
    .dataTable({
      aProcessing: true,
      aServerSide: true,
      dom: "Bfrtip",
      searching: true,
      lengthChange: false,
      colReorder: true,
      buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
      ajax: {
        url: "../../controller/RecursosManosObrasProyectosObrasCivilesController.php?op=listado_recursos_manos_obras_proyectos_obras_civiles",
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

const obtenerListadoDocumentosProyectosObrasCivilesDataTable = (
  solicitudProyectoID,
  proyectoObraCivilID
) => {
  $("#listadoDocumentosProyectosObrasCivilesDataTable")
    .dataTable({
      aProcessing: true,
      aServerSide: true,
      dom: "Bfrtip",
      searching: true,
      lengthChange: false,
      colReorder: true,
      buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
      ajax: {
        url: "../../controller/ProyectosObrasCivilesController.php?op=obtener_documentos_proyectos_obras_civiles_por_solicitud_proyecto_ID_proyecto_obra_civil_ID",
        type: "post",
        dataType: "json",
        data: {
          solicitudProyectoID: solicitudProyectoID,
          proyectoObraCivilID: proyectoObraCivilID,
        },
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

const obtenerCostosTotalesActividadesProyectosObrasCivilesPorProyectoObraCivilID =
  (proyectoObraCivilID) => {
    $.post(
      "../../controller/ActividadesProyectosObrasCivilesController.php?op=obtener_costos_totales_actividades_proyectos_obras_civiles_por_proyecto_obra_civil_ID",
      {
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

          const { costoTotal } = responseData;

          const costoTotalActividadesProyectosObrasCivilesValue =
            document.getElementById(
              "costoTotalActividadesProyectosObrasCivilesValue"
            );

          costoTotalActividadesProyectosObrasCivilesValue.value =
            costoTotal != null ? costoTotal : "";

          localStorage.setItem(
            "costoTotalActividadesProyectosObrasCiviles",
            costoTotal
          );
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

const obtenerCostosTotalesRecursosMaterialesProyectosObrasCivilesPorProyectoObraCivilID =
  (proyectoObraCivilID) => {
    $.post(
      "../../controller/RecursosMaterialesProyectosObrasCivilesController.php?op=obtener_costos_totales_recursos_materiales_proyectos_obras_civiles_por_proyecto_obra_civil_ID",
      {
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

          const { costoTotal } = responseData;

          const costoTotalRecursosMaterialesValue = document.getElementById(
            "costoTotalRecursosMaterialesValue"
          );

          costoTotalRecursosMaterialesValue.value =
            costoTotal != null ? costoTotal : "";

          localStorage.setItem(
            "costoTotalRecursosMaterialesProyectosObrasCiviles",
            costoTotal
          );
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

const obtenerCostoTotalProyectoObraCivil = () => {
  const costoTotalActividadesProyectosObrasCiviles =
    parseFloat(
      localStorage.getItem("costoTotalActividadesProyectosObrasCiviles")
    ) || 0;

  const costoTotalRecursosMaterialesProyectosObrasCiviles =
    parseFloat(
      localStorage.getItem("costoTotalRecursosMaterialesProyectosObrasCiviles")
    ) || 0;

  const resultadoCostoTotalProyectoObraCivil =
    costoTotalActividadesProyectosObrasCiviles +
    costoTotalRecursosMaterialesProyectosObrasCiviles;

  document.getElementById("costoTotalProyecto").value =
    resultadoCostoTotalProyectoObraCivil;
};

const verificarConsumoPresupuestoCliente = () => {
  const presupuestoEstimadoProyecto =
    parseFloat(localStorage.getItem("presupuestoEstimadoProyecto")) || 0;

  const costoTotalActividadesProyectosObrasCiviles =
    parseFloat(
      localStorage.getItem("costoTotalActividadesProyectosObrasCiviles")
    ) || 0;

  const costoTotalRecursosMaterialesProyectosObrasCiviles =
    parseFloat(
      localStorage.getItem("costoTotalRecursosMaterialesProyectosObrasCiviles")
    ) || 0;

  const costoTotalProyectoInput = document.getElementById("costoTotalProyecto");

  const resultadoCostoTotalProyectoObraCivil =
    costoTotalActividadesProyectosObrasCiviles +
    costoTotalRecursosMaterialesProyectosObrasCiviles;

  if (
    resultadoCostoTotalProyectoObraCivil <
    presupuestoEstimadoProyecto * 0.5
  ) {
    costoTotalProyectoInput.style.backgroundColor = "green";
    costoTotalProyectoInput.style.color = "white";
  } else if (
    resultadoCostoTotalProyectoObraCivil < presupuestoEstimadoProyecto
  ) {
    costoTotalProyectoInput.style.backgroundColor = "yellow";
    costoTotalProyectoInput.style.color = "white";
  } else {
    costoTotalProyectoInput.style.backgroundColor = "rojo";
    costoTotalProyectoInput.style.color = "white";
  }
};

(function () {
  //Initialize Select2 Elements:
  initializeSelect2Elements();

  bsCustomFileInput.init();

  const proyectoObraCivilID = getParams("proyectoObraCivilID");
  const solicitudProyectoID = getParams("solicitudProyectoID");

  obtenerDatosProyectosObrasCivilesPorProyectoObraCivilIDSolicitudProyectoID(
    proyectoObraCivilID,
    solicitudProyectoID
  );

  getSelectListProjectPhasesOptions(
    "../../controller/FasesProyectosController.php?op=obtener_listado_opciones_fases_proyectos",
    "#faseProyectoID"
  );

  getSelectListTypesActivitiesOptions(
    "../../controller/TiposActividadesController.php?op=obtener_listado_opciones_tipos_actividades",
    "#tipoActividadID"
  );

  obtenerListadoActividadesProyectosObrasCivilesDataTable(proyectoObraCivilID);

  obtenerListadoRecursosMaterialesProyectosObrasCivilesDataTable(
    proyectoObraCivilID
  );

  obtenerListadoRecursosManosObrasProyectosObrasCivilesDataTable(
    proyectoObraCivilID
  );

  obtenerCostosTotalesActividadesProyectosObrasCivilesPorProyectoObraCivilID(
    proyectoObraCivilID
  );

  obtenerCostosTotalesRecursosMaterialesProyectosObrasCivilesPorProyectoObraCivilID(
    proyectoObraCivilID
  );

  obtenerListadoDocumentosProyectosObrasCivilesDataTable(
    solicitudProyectoID,
    proyectoObraCivilID
  );

  obtenerCostoTotalProyectoObraCivil();

  verificarConsumoPresupuestoCliente();

  getSelectListProjectPhasesOptions(
    "../../controller/FasesProyectosController.php?op=obtener_listado_opciones_fases_proyectos",
    "#faseProyectoIDRecursoMaterial"
  );

  getSelectListSuppliersOptions(
    "../../controller/ProveedoresController.php?op=obtener_listado_opciones_proveedores",
    "#proveedorID"
  );

  getSelectListTypesMaterialResourcesOptions(
    "../../controller/TiposRecursosMaterialesController.php?op=obtener_listado_opciones_tipos_recursos_materiales",
    "#tipoRecursoMaterialID"
  );

  getSelectListProjectPhasesOptions(
    "../../controller/FasesProyectosController.php?op=obtener_listado_opciones_fases_proyectos",
    "#faseProyectoIDRecursoManoObra"
  );

  getSelectListLaborResourcesOptions(
    "../../controller/RecursosManosObrasController.php?op=obtener_listado_opciones_recursos_manos_obras",
    "#recursoManoObraID"
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

const tipoActividadIDInput = document.getElementById("tipoActividadID");
tipoActividadIDInput.onchange = function (event) {
  const tipoActividadID = event.target.value;

  getSelectListProjectActivitiesOptionsByTipoActividadID(
    "../../controller/ActividadesProyectosController.php?op=obtener_listado_opciones_actividades_proyectos_por_tipo_actividad_ID",
    tipoActividadID,
    "#actividadProyectoID"
  );
};

const obtenerUnidadMedidaYCostoActividadProyectoPorActividadProyectoID = (
  actividadProyectoID
) => {
  $.post(
    "../../controller/ActividadesProyectosController.php?op=obtener_unidades_medidas_costos_actividades_proyectos_por_actividad_proyecto_ID",
    {
      actividadProyectoID: actividadProyectoID,
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

        const { unidadMedida, costoActividadProyecto } = responseData;

        const unidadMedidaInput = document.getElementById("unidadMedida");

        const costoActividadProyectoInput = document.getElementById(
          "costoActividadProyecto"
        );

        unidadMedidaInput.value = unidadMedida != null ? unidadMedida : "";

        costoActividadProyectoInput.value =
          costoActividadProyecto != null ? costoActividadProyecto : "";
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

const actividadProyectoIDInput = document.getElementById("actividadProyectoID");
actividadProyectoIDInput.onchange = function (event) {
  const actividadProyectoID = event.target.value;

  obtenerUnidadMedidaYCostoActividadProyectoPorActividadProyectoID(
    actividadProyectoID
  );
};

// Función para multiplicar los valores de los inputs:
const calcularSubTotalITBISCostoTotal = () => {
  // Obtener los valores de los inputs:
  const cantidadActividadesValue =
    parseFloat(document.getElementById("cantidadActividades").value) || 0;

  const costoActividadProyectoValue =
    parseFloat(document.getElementById("costoActividadProyecto").value) || 0;

  // Multiplicar los valores:
  const resultadoSubTotal =
    cantidadActividadesValue * costoActividadProyectoValue;

  document.getElementById("subTotal").value = resultadoSubTotal;

  const porcentajeITBIS = 0.18;

  const resultadoITBIS = resultadoSubTotal * porcentajeITBIS;

  document.getElementById("itbis").value = resultadoITBIS;

  const resultadoCostoTotalActividad = resultadoSubTotal + resultadoITBIS;

  document.getElementById("costoTotalActividad").value =
    resultadoCostoTotalActividad;
};

// Agregar eventos de 'input' a los campos de entrada:
document
  .getElementById("cantidadActividades")
  .addEventListener("input", calcularSubTotalITBISCostoTotal);

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

const openAddNewResourcesMaterialFormModal = () => {
  const proyectoObraCivilIDInput = document.getElementById(
    "addResourceMaterialProyectoObraCivilID"
  );
  proyectoObraCivilIDInput.value = getParams("proyectoObraCivilID");

  $("#newResourcesMaterialFormModal").modal("show");
};

const addNewResourceMaterialButton = document.getElementById(
  "addNewResourceMaterialButton"
);
addNewResourceMaterialButton.addEventListener("click", () => {
  openAddNewResourcesMaterialFormModal();
});

const tipoRecursoMaterialIDInput = document.getElementById(
  "tipoRecursoMaterialID"
);
tipoRecursoMaterialIDInput.onchange = function (event) {
  const proveedorID = document.getElementById("proveedorID").value;
  const tipoRecursoMaterialID = event.target.value;

  getSelectListMaterialResourcesSuppliersOptionsByProveedorIDAndTipoRecursoMaterialID(
    "../../controller/RecursosMaterialesProveedoresController.php?op=obtener_listado_opciones_recursos_materiales_proveedores_por_proveedor_ID_tipo_recurso_material_ID",
    proveedorID,
    tipoRecursoMaterialID,
    "#recursoMaterialID"
  );
};

const obtenerUnidadMedidaYCostoRecursoMaterialPorRecursoMaterialID = (
  recursoMaterialID
) => {
  $.post(
    "../../controller/RecursosMaterialesController.php?op=obtener_unidades_medidas_costos_recursos_materiales_por_recurso_material_ID",
    {
      recursoMaterialID: recursoMaterialID,
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

        const { unidadMedida, costoRecursoMaterial } = responseData;

        const unidadMedidaRecursoMaterialInput = document.getElementById(
          "unidadMedidaRecursoMaterial"
        );

        const costoRecursoMaterialInput = document.getElementById(
          "costoRecursoMaterial"
        );

        unidadMedidaRecursoMaterialInput.value =
          unidadMedida != null ? unidadMedida : "";

        costoRecursoMaterialInput.value =
          costoRecursoMaterial != null ? costoRecursoMaterial : "";
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

const recursoMaterialIDInput = document.getElementById("recursoMaterialID");
recursoMaterialIDInput.onchange = function (event) {
  const recursoMaterialID = event.target.value;

  obtenerUnidadMedidaYCostoRecursoMaterialPorRecursoMaterialID(
    recursoMaterialID
  );
};

// Función para multiplicar los valores de los inputs:
const calcularSubTotalITBISCostoTotalRecursosMateriales = () => {
  // Obtener los valores de los inputs:
  const cantidadRecursosMaterialesValue =
    parseFloat(document.getElementById("cantidadRecursosMateriales").value) ||
    0;

  const costoRecursoMaterialValue =
    parseFloat(document.getElementById("costoRecursoMaterial").value) || 0;

  // Multiplicar los valores:
  const resultadoSubTotal =
    cantidadRecursosMaterialesValue * costoRecursoMaterialValue;

  document.getElementById("subTotalRecursoMaterial").value = resultadoSubTotal;

  const porcentajeITBIS = 0.18;

  const resultadoITBIS = resultadoSubTotal * porcentajeITBIS;

  document.getElementById("itbisRecursoMaterial").value = resultadoITBIS;

  const resultadoCostoTotalActividad = resultadoSubTotal + resultadoITBIS;

  document.getElementById("costoTotalRecursoMaterial").value =
    resultadoCostoTotalActividad;
};

// Agregar eventos de 'input' a los campos de entrada:
document
  .getElementById("cantidadRecursosMateriales")
  .addEventListener("input", calcularSubTotalITBISCostoTotalRecursosMateriales);

const obtenerRutaDocumentoProyectoObraCivilIDPorDocumentoIDYSolicitudProyectoIDODocumentoIDYProyectoObraCivilID =
  (documentoID, solicitudProyectoID, proyectoObraCivilID) => {
    $.post(
      "../../controller/ProyectosObrasCivilesController.php?op=obtener_ruta_documento_proyecto_obra_civil_por_documento_ID_solicitud_proyecto_ID_proyecto_obra_civil_ID",
      {
        documentoID: documentoID,
        solicitudProyectoID: solicitudProyectoID,
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

          console.log(responseData);

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

const verDetallesDocumentosProyectosObrasCiviles = (
  documentoID,
  solicitudProyectoID,
  proyectoObraCivilID
) => {
  obtenerRutaDocumentoProyectoObraCivilIDPorDocumentoIDYSolicitudProyectoIDODocumentoIDYProyectoObraCivilID(
    documentoID,
    solicitudProyectoID,
    proyectoObraCivilID
  );
};

const openAddNewProjectDocument = () => {
  const addProjectDocumentsProyectoObraCivilIDInput = document.getElementById(
    "addProjectDocumentsProyectoObraCivilID"
  );
  addProjectDocumentsProyectoObraCivilIDInput.value = getParams(
    "proyectoObraCivilID"
  );

  $("#newProjectDocumentsFormModal").modal("show");
};

const addNewProjectDocumentButton = document.getElementById(
  "addNewProjectDocumentButton"
);
addNewProjectDocumentButton.addEventListener("click", () => {
  openAddNewProjectDocument();
});

const openAddNewLaborResourcesFormModal = () => {
  const addLaborResourcesProyectoObraCivilID = document.getElementById(
    "addLaborResourcesProyectoObraCivilID"
  );
  addLaborResourcesProyectoObraCivilID.value = getParams("proyectoObraCivilID");

  $("#newLaborResourcesFormModal").modal("show");
};

const addNewLaborResourcesButton = document.getElementById(
  "addNewLaborResourcesButton"
);
addNewLaborResourcesButton.addEventListener("click", () => {
  openAddNewLaborResourcesFormModal();
});

const obtenerTipoPagoYCostoRecursoManoObraPorRecursoManoObraID = (
  recursoManoObraID
) => {
  $.post(
    "../../controller/RecursosManosObrasController.php?op=obtener_tipos_pagos_costos_pagos_recursos_manos_obras_por_recurso_mano_obra_ID",
    {
      recursoManoObraID: recursoManoObraID,
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

        const { tipoPago, costoPagoRecursoManoObra } = responseData;

        const tipoPagoInput = document.getElementById("tipoPago");

        const costoRecursoManoObraInput = document.getElementById(
          "costoRecursoManoObra"
        );

        tipoPagoInput.value = tipoPago != null ? tipoPago : "";

        costoRecursoManoObraInput.value =
          costoPagoRecursoManoObra != null ? costoPagoRecursoManoObra : "";
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

const recursoManoObraIDInput = document.getElementById("recursoManoObraID");
recursoManoObraIDInput.onchange = function (event) {
  const recursoManoObraID = event.target.value;

  obtenerTipoPagoYCostoRecursoManoObraPorRecursoManoObraID(recursoManoObraID);
};

// Función para multiplicar los valores de los inputs:
const calcularCostoTotalRecursosManosObras = () => {
  // Obtener los valores de los inputs:
  const cantidadRecursosManosObrasValue =
    parseFloat(document.getElementById("cantidadRecursosManosObras").value) ||
    0;

  const costoRecursoManoObraValue =
    parseFloat(document.getElementById("costoRecursoManoObra").value) || 0;

  // Multiplicar los valores:
  const resultadoCostoTotalRecursosManosObrasValue =
    cantidadRecursosManosObrasValue * costoRecursoManoObraValue;

  document.getElementById("costoTotalRecursoManoObra").value =
    resultadoCostoTotalRecursosManosObrasValue;
};

// Agregar eventos de 'input' a los campos de entrada:
document
  .getElementById("cantidadRecursosManosObras")
  .addEventListener("input", calcularCostoTotalRecursosManosObras);
