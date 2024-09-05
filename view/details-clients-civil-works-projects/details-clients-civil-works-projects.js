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

const obtenerListadoActividadesProyectosObrasCivilesClientesDataTable = (
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
        url: "../../controller/ActividadesProyectosObrasCivilesController.php?op=listado_actividades_proyectos_obras_civiles_clientes_por_proyecto_obra_civil_ID",
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

const obtenerListadoRecursosMaterialesProyectosObrasCivilesClientesDataTable = (
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
        url: "../../controller/RecursosMaterialesProyectosObrasCivilesController.php?op=listado_recursos_materiales_proyectos_obras_civiles_clientes_por_proyecto_obra_civil_ID",
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

const obtenerListadoRecursosManosObrasProyectosObrasCivilesClientesDataTable = (
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
        url: "../../controller/RecursosManosObrasProyectosObrasCivilesController.php?op=listado_recursos_manos_obras_proyectos_obras_civiles_clientes",
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

const obtenerListadoDocumentosProyectosObrasCivilesClientesDataTable = (
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
        url: "../../controller/ProyectosObrasCivilesController.php?op=obtener_documentos_proyectos_obras_civiles_clientes_por_solicitud_proyecto_ID_proyecto_obra_civil_ID",
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

          const costoTotalFormatValue = parseFloat(costoTotal).toLocaleString(
            "es-DO",
            {
              style: "currency",
              currency: "DOP",
            }
          );

          const costoTotalActividadesProyectosObrasCivilesValue =
            document.getElementById(
              "costoTotalActividadesProyectosObrasCivilesValue"
            );

          costoTotalActividadesProyectosObrasCivilesValue.value =
            costoTotalFormatValue != null ? costoTotalFormatValue : "";

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

          const costoTotalFormatValue = parseFloat(costoTotal).toLocaleString(
            "es-DO",
            {
              style: "currency",
              currency: "DOP",
            }
          );

          const costoTotalRecursosMaterialesValue = document.getElementById(
            "costoTotalRecursosMaterialesValue"
          );

          costoTotalRecursosMaterialesValue.value =
            costoTotalFormatValue != null ? costoTotalFormatValue : "";

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

const obtenerCostosTotalesRecursosManosObrasProyectosObrasCivilesPorProyectoObraCivilID =
  (proyectoObraCivilID) => {
    $.post(
      "../../controller/RecursosManosObrasProyectosObrasCivilesController.php?op=obtener_costos_totales_recursos_manos_obras_proyectos_obras_civiles_por_proyecto_obra_civil_ID",
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

          const costoTotalFormatValue = parseFloat(costoTotal).toLocaleString(
            "es-DO",
            {
              style: "currency",
              currency: "DOP",
            }
          );

          const costoTotalRecursosManosObrasValue = document.getElementById(
            "costoTotalRecursosManosObrasValue"
          );

          costoTotalRecursosManosObrasValue.value =
            costoTotalFormatValue != null ? costoTotalFormatValue : "";

          localStorage.setItem(
            "costoTotalRecursosManosObrasProyectosObrasCiviles",
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

  const costoTotalRecursosManosObrasProyectosObrasCiviles =
    parseFloat(
      localStorage.getItem("costoTotalRecursosManosObrasProyectosObrasCiviles")
    ) || 0;

  const resultadoCostoTotalProyectoObraCivil =
    costoTotalActividadesProyectosObrasCiviles +
    costoTotalRecursosMaterialesProyectosObrasCiviles +
    costoTotalRecursosManosObrasProyectosObrasCiviles;

  const resultadoCostoTotalProyectoObraCivilFormatValue =
    resultadoCostoTotalProyectoObraCivil.toLocaleString("es-DO", {
      style: "currency",
      currency: "DOP",
    });

  document.getElementById("costoTotalProyecto").value =
    resultadoCostoTotalProyectoObraCivilFormatValue;
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

  const costoTotalRecursosManosObrasProyectosObrasCiviles =
    parseFloat(
      localStorage.getItem("costoTotalRecursosManosObrasProyectosObrasCiviles")
    ) || 0;

  const costoTotalProyectoInput = document.getElementById("costoTotalProyecto");

  const resultadoCostoTotalProyectoObraCivil =
    costoTotalActividadesProyectosObrasCiviles +
    costoTotalRecursosMaterialesProyectosObrasCiviles +
    costoTotalRecursosManosObrasProyectosObrasCiviles;

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
  const proyectoObraCivilID = getParams("proyectoObraCivilID");
  const solicitudProyectoID = getParams("solicitudProyectoID");

  obtenerDatosProyectosObrasCivilesPorProyectoObraCivilIDSolicitudProyectoID(
    proyectoObraCivilID,
    solicitudProyectoID
  );

  obtenerListadoActividadesProyectosObrasCivilesClientesDataTable(
    proyectoObraCivilID
  );

  obtenerListadoRecursosMaterialesProyectosObrasCivilesClientesDataTable(
    proyectoObraCivilID
  );

  obtenerListadoRecursosManosObrasProyectosObrasCivilesClientesDataTable(
    proyectoObraCivilID
  );

  obtenerCostosTotalesActividadesProyectosObrasCivilesPorProyectoObraCivilID(
    proyectoObraCivilID
  );

  obtenerCostosTotalesRecursosMaterialesProyectosObrasCivilesPorProyectoObraCivilID(
    proyectoObraCivilID
  );

  obtenerCostosTotalesRecursosManosObrasProyectosObrasCivilesPorProyectoObraCivilID(
    proyectoObraCivilID
  );

  obtenerListadoDocumentosProyectosObrasCivilesClientesDataTable(
    solicitudProyectoID,
    proyectoObraCivilID
  );

  obtenerCostoTotalProyectoObraCivil();

  verificarConsumoPresupuestoCliente();
})();

const obtenerRutaDocumentoProyectoObraCivilIDPorDocumentoIDYSolicitudProyectoID =
  (documentoID, solicitudProyectoID) => {
    $.post(
      "../../controller/DocumentosController.php?op=obtener_ruta_documento_proyecto_obra_civil_por_documento_ID_solicitud_proyecto_ID",
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

const obtenerRutaDocumentoProyectoObraCivilIDPorDocumentoIDYProyectoObraCivilID =
  (documentoID, proyectoObraCivilID) => {
    $.post(
      "../../controller/DocumentosController.php?op=obtener_ruta_documento_proyecto_obra_civil_por_documento_ID_proyecto_obra_civil_ID",
      {
        documentoID: documentoID,
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
  if (solicitudProyectoID != null) {
    obtenerRutaDocumentoProyectoObraCivilIDPorDocumentoIDYSolicitudProyectoID(
      documentoID,
      solicitudProyectoID
    );
  } else {
    obtenerRutaDocumentoProyectoObraCivilIDPorDocumentoIDYProyectoObraCivilID(
      documentoID,
      proyectoObraCivilID
    );
  }
};

const viewQuotesButton = document.getElementById("viewQuotesButton");
viewQuotesButton.onclick = function () {
  window.open(
    `../../view/reports/quotes/index.php?proyectoObraCivilID=${getParams(
      "proyectoObraCivilID"
    )}&solicitudProyectoObraCivilID=${getParams("solicitudProyectoID")}`,
    "_blank"
  );
};
