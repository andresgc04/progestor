navLinkPrimary("navLinkMaterialResources");

navLinkSecondary("navLinkHomeMaterialResourcesSuppliers");

setContentHeaderTitle("Listado De Recursos Materiales Por Proveedores");

setBreadCrumbContentHeaderTitle("../dashboard/", "Dashboard");

setBreadCrumbContentHeaderSubTitle(
  "Listado De Recursos Materiales Por Proveedores"
);

const openNewMaterialResourcesSuppliersFormModal = () => {
  $("#newMaterialResourcesSuppliersFormModal").modal("show");
};

const newMaterialResourcesSuppliersButton = document.getElementById(
  "newMaterialResourcesSuppliersButton"
);
newMaterialResourcesSuppliersButton.addEventListener("click", () => {
  openNewMaterialResourcesSuppliersFormModal();
});

const obtenerListadoRecursosMaterialesProveedoresDataTable = () => {
  $("#listadoRecursosMaterialesProveedoresDataTable")
    .dataTable({
      aProcessing: true,
      aServerSide: true,
      dom: "Bfrtip",
      searching: true,
      lengthChange: false,
      colReorder: true,
      buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
      ajax: {
        url: "../../controller/RecursosMaterialesProveedoresController.php?op=listado_recursos_materiales_proveedores",
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

  getSelectListSuppliersOptions(
    "../../controller/ProveedoresController.php?op=obtener_listado_opciones_proveedores",
    "#proveedorID"
  );

  obtenerListadoRecursosMaterialesProveedoresDataTable();
})();

const tipoRecursoMaterialIDInput = document.getElementById(
  "tipoRecursoMaterialID"
);
tipoRecursoMaterialIDInput.onchange = function (event) {
  const tipoRecursoMaterialID = event.target.value;

  getSelectListMaterialResourcesOptionsByTipoRecursoMaterialID(
    "../../controller/RecursosMaterialesController.php?op=obtener_listado_opciones_recursos_materiales_por_tipo_recurso_material_ID",
    tipoRecursoMaterialID,
    "#recursoMaterialID"
  );
};

const openUpdateMaterialResourcesSuppliersFormModal = () => {
  $("#updateMaterialResourcesSuppliersFormModal").modal("show");
};

const verDetalleRecursoMaterialProveedor = (recursoMaterialID, proveedorID) => {
  $.post(
    "../../controller/RecursosMaterialesProveedoresController.php?op=obtener_detalles_recursos_materiales_proveedores_por_recurso_material_ID_proveedor_ID",
    {
      recursoMaterialID: recursoMaterialID,
      proveedorID: proveedorID,
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
          tipoRecursoMaterialID,
          recursoMaterialID,
          proveedorID,
          costoRecursoMaterial,
        } = responseData;

        const updateRecursoMaterialIDInput = document.getElementById(
          "updateRecursoMaterialID"
        );
        updateRecursoMaterialIDInput.value =
          recursoMaterialID != null ? recursoMaterialID : "";

        const updateProveedorIDInput =
          document.getElementById("updateProveedorID");
        updateProveedorIDInput.value = proveedorID != null ? proveedorID : "";

        getSelectListTypesMaterialResourcesOptionsByTipoRecursoMaterialID(
          "../../controller/TiposRecursosMaterialesController.php?op=obtener_listado_opciones_tipos_recursos_materiales_por_tipo_recurso_material_ID",
          tipoRecursoMaterialID,
          "#modificarTipoRecursoMaterialID"
        );

        getSelectListMaterialResourcesOptionsByRecursoMaterialID(
          "../../controller/RecursosMaterialesController.php?op=obtener_listado_opciones_recursos_materiales_por_recurso_material_ID",
          recursoMaterialID,
          "#modificarRecursoMaterialID"
        );

        getSelectListSuppliersOptionsByProveedorID(
          "../../controller/ProveedoresController.php?op=obtener_listado_opciones_proveedores_por_proveedor_ID",
          proveedorID,
          "#modificarProveedorID"
        );

        const modificarCostoRecursoMaterialInput = document.getElementById(
          "modificarCostoRecursoMaterial"
        );
        modificarCostoRecursoMaterialInput.value =
          costoRecursoMaterial != null ? costoRecursoMaterial : "";

        const modificarTipoRecursoMaterialIDInput = document.getElementById(
          "modificarTipoRecursoMaterialID"
        );
        modificarTipoRecursoMaterialIDInput.onchange = function (event) {
          const modificarTipoRecursoMaterialID = event.target.value;

          getSelectListMaterialResourcesOptionsByTipoRecursoMaterialID(
            "../../controller/RecursosMaterialesController.php?op=obtener_listado_opciones_recursos_materiales_por_tipo_recurso_material_ID",
            modificarTipoRecursoMaterialID,
            "#modificarRecursoMaterialID"
          );
        };

        openUpdateMaterialResourcesSuppliersFormModal();
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

const eliminarRecursoMaterialProveedor = (recursoMaterialID, proveedorID) => {
  Swal.fire({
    title:
      "¿Deseas eliminar este recurso material abastecido por este proveedor seleccionado?",
    inputAttributes: {
      autocapitalize: "off",
    },
    showCancelButton: true,
    confirmButtonText: "Eliminar",
    showLoaderOnConfirm: true,
    preConfirm: () => {
      $.post(
        "../../controller/RecursosMaterialesProveedoresController.php?op=eliminar_recursos_materiales_proveedores",
        {
          recursoMaterialID: recursoMaterialID,
          proveedorID: proveedorID,
        }
      )
        .done(function (data, status) {
          Swal.fire({
            position: "center",
            icon: "success",
            title:
              "Recurso material abastecido por este proveedor eliminado satisfactoriamente.",
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
