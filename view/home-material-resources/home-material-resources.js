navLinkPrimary("navLinkMaterialResources");

navLinkSecondary("navLinkHomeMaterialResources");

setContentHeaderTitle("Listado De Recursos Materiales");

setBreadCrumbContentHeaderTitle("../dashboard/", "Dashboard");

setBreadCrumbContentHeaderSubTitle("Listado De Recursos Materiales");

const openNewMaterialResourcesFormModal = () => {
  $("#newMaterialResourcesFormModal").modal("show");
};

const newMaterialResourcesButton = document.getElementById(
  "newMaterialResourcesButton"
);
newMaterialResourcesButton.addEventListener("click", () => {
  openNewMaterialResourcesFormModal();
});

const obtenerListadoRecursosMaterialesDataTable = () => {
  $("#listadoRecursosMaterialesDataTable")
    .dataTable({
      aProcessing: true,
      aServerSide: true,
      dom: "Bfrtip",
      searching: true,
      lengthChange: false,
      colReorder: true,
      buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
      ajax: {
        url: "../../controller/RecursosMaterialesController.php?op=listado_recursos_materiales",
        type: "post",
        dataType: "json",
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

  getSelectListTypesMaterialResourcesOptions(
    "../../controller/TiposRecursosMaterialesController.php?op=obtener_listado_opciones_tipos_recursos_materiales",
    "#tipoRecursoMaterialID"
  );

  getSelectListUnitsMeasurementsOptions(
    "../../controller/UnidadesMedidasController.php?op=obtener_listado_opciones_unidades_medidas",
    "#unidadMedidaID"
  );

  obtenerListadoRecursosMaterialesDataTable();
})();

const openUpdateMaterialResourcesFormModal = () => {
  $("#updateMaterialResourcesFormModal").modal("show");
};

const verDetalleRecursoMaterial = (
  tipoRecursoMaterialID,
  recursoMaterialID
) => {
  $.post(
    "../../controller/RecursosMaterialesController.php?op=obtener_detalles_recursos_materiales_por_tipo_recurso_material_ID_recurso_material_ID",
    {
      tipoRecursoMaterialID: tipoRecursoMaterialID,
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

        const { recursoMaterialID, tipoRecursoMaterialID, recursoMaterial } =
          responseData;

        const tipoRecursoMaterialIDInput = document.getElementById(
          "updateTipoRecursoMaterialID"
        );

        const recursoMaterialIDInput = document.getElementById(
          "updateRecursoMaterialID"
        );

        getSelectListTypesMaterialResourcesOptionsByTipoRecursoMaterialID(
          "../../controller/TiposRecursosMaterialesController.php?op=obtener_listado_opciones_tipos_recursos_materiales_por_tipo_recurso_material_ID",
          tipoRecursoMaterialID,
          "#modificarTipoRecursoMaterialID"
        );

        const modificarNombreRecursoMaterialInput = document.getElementById(
          "modificarNombreRecursoMaterial"
        );

        tipoRecursoMaterialIDInput.value =
          tipoRecursoMaterialID != null ? tipoRecursoMaterialID : "";

        recursoMaterialIDInput.value =
          recursoMaterialID != null ? recursoMaterialID : "";

        modificarNombreRecursoMaterialInput.value =
          recursoMaterial != null ? recursoMaterial : "";

        openUpdateMaterialResourcesFormModal();
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

const eliminarRecursoMaterial = (tipoRecursoMaterialID, recursoMaterialID) => {
  Swal.fire({
    title: "¿Deseas eliminar este recurso material seleccionado?",
    inputAttributes: {
      autocapitalize: "off",
    },
    showCancelButton: true,
    confirmButtonText: "Eliminar",
    showLoaderOnConfirm: true,
    preConfirm: () => {
      $.post(
        "../../controller/RecursosMaterialesController.php?op=eliminar_recursos_materiales",
        {
          tipoRecursoMaterialID: tipoRecursoMaterialID,
          recursoMaterialID: recursoMaterialID,
        }
      )
        .done(function (data, status) {
          Swal.fire({
            position: "center",
            icon: "success",
            title: "Recurso material eliminado satisfactoriamente.",
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
            text: `${dataResult.messageError}`,
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
