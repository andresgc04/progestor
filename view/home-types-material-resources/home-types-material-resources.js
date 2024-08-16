navLinkPrimary("navLinkMaterialResources");

navLinkSecondary("navLinkHomeTypesMaterialResources");

setContentHeaderTitle("Listado De Tipos De Recursos Materiales");

setBreadCrumbContentHeaderTitle("../dashboard/", "Dashboard");

setBreadCrumbContentHeaderSubTitle("Listado De Tipos De Recursos Materiales");

const openNewTypesMaterialResourcesFormModal = () => {
  $("#newTypesMaterialResourcesFormModal").modal("show");
};

const newTypesMaterialResourcesButton = document.getElementById(
  "newTypesMaterialResourcesButton"
);
newTypesMaterialResourcesButton.addEventListener("click", () => {
  openNewTypesMaterialResourcesFormModal();
});

const obtenerListadoTiposRecursosMaterialesDataTable = () => {
  $("#listadoTiposRecursosMaterialesDataTable")
    .dataTable({
      aProcessing: true,
      aServerSide: true,
      dom: "Bfrtip",
      searching: true,
      lengthChange: false,
      colReorder: true,
      buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
      ajax: {
        url: "../../controller/TiposRecursosMaterialesController.php?op=listado_tipos_recursos_materiales",
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
  obtenerListadoTiposRecursosMaterialesDataTable();
})();

const openUpdateTypesMaterialResourcesFormModal = () => {
  $("#updateTypesMaterialResourcesFormModal").modal("show");
};

const verDetalleTipoRecursoMaterial = (tipoRecursoMaterialID) => {
  $.post(
    "../../controller/TiposRecursosMaterialesController.php?op=obtener_detalles_tipos_recursos_materiales_por_tipo_recurso_material_ID",
    {
      tipoRecursoMaterialID: tipoRecursoMaterialID,
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

        const { tipoRecursoMaterialID, tipoRecursoMaterial } = responseData;

        const tipoRecursoMaterialIDInput = document.getElementById(
          "tipoRecursoMaterialID"
        );
        const modificarNombreTipoRecursoMaterialInput = document.getElementById(
          "modificarNombreTipoRecursoMaterial"
        );

        tipoRecursoMaterialIDInput.value =
          tipoRecursoMaterialID != null ? tipoRecursoMaterialID : "";

        modificarNombreTipoRecursoMaterialInput.value =
          tipoRecursoMaterial != null ? tipoRecursoMaterial : "";

        openUpdateTypesMaterialResourcesFormModal();
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
