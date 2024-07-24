navLinkPrimary("navLinkMaintenance");

navLinkSecondary("navLinkHomeTypesSuppliers");

setContentHeaderTitle("Listado De Tipos De Proveedores");

setBreadCrumbContentHeaderTitle("../dashboard/", "Dashboard");

setBreadCrumbContentHeaderSubTitle("Listado De Tipos De Proveedores");

const openNewTypesSuppliersFormModal = () => {
  $("#newTypesSuppliersFormModal").modal("show");
};

const newTypesSuppliersButton = document.getElementById(
  "newTypesSuppliersButton"
);
newTypesSuppliersButton.addEventListener("click", () => {
  openNewTypesSuppliersFormModal();
});

const obtenerListadoTiposProveedoresDataTable = () => {
  $("#listadoTiposProveedoresDataTable")
    .dataTable({
      aProcessing: true,
      aServerSide: true,
      dom: "Bfrtip",
      searching: true,
      lengthChange: false,
      colReorder: true,
      buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
      ajax: {
        url: "../../controller/TiposProveedoresController.php?op=listado_tipos_proveedores",
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
  obtenerListadoTiposProveedoresDataTable();
})();

const openUpdateTypesSuppliersFormModal = () => {
  $("#updateTypesSuppliersFormModal").modal("show");
};

const verDetalleTipoProveedor = (tipoProveedorID) => {
  $.post(
    "../../controller/TiposProveedoresController.php?op=obtener_detalles_tipos_proveedores_por_tipo_proveedor_ID",
    {
      tipoProveedorID: tipoProveedorID,
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

        const { tipoProveedorID, tipoProveedor } = responseData;

        const tipoProveedorIDInput = document.getElementById("tipoProveedorID");
        const modificarTipoProveedorInput = document.getElementById(
          "modificarTipoProveedor"
        );

        tipoProveedorIDInput.value =
          tipoProveedorID != null ? tipoProveedorID : "";

        modificarTipoProveedorInput.value =
          tipoProveedor != null ? tipoProveedor : "";

        openUpdateTypesSuppliersFormModal();
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

const eliminarTipoProveedor = (tipoProveedorID) => {
  Swal.fire({
    title: "¿Deseas eliminar este tipo de proveedor seleccionado?",
    inputAttributes: {
      autocapitalize: "off",
    },
    showCancelButton: true,
    confirmButtonText: "Eliminar",
    showLoaderOnConfirm: true,
    preConfirm: () => {
      $.post(
        "../../controller/TiposProveedoresController.php?op=eliminar_tipos_proveedores_por_tipo_proveedor_ID",
        {
          tipoProveedorID: tipoProveedorID,
        }
      )
        .done(function (data, status) {
          Swal.fire({
            position: "center",
            icon: "success",
            title: "Tipo de proveedor eliminado satisfactoriamente.",
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
