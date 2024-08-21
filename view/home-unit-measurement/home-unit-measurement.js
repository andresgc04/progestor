navLinkPrimary("navLinkMaintenance");

navLinkSecondary("navLinkHomeUnitMeasurement");

setContentHeaderTitle("Listado De Unidades De Medidas");

setBreadCrumbContentHeaderTitle("../dashboard/", "Dashboard");

setBreadCrumbContentHeaderSubTitle("Listado De Unidades De Medidas");

const openNewUnitMeasurementFormModal = () => {
  $("#newUnitMeasurementFormModal").modal("show");
};

const newUnitMeasurementButton = document.getElementById(
  "newUnitMeasurementButton"
);
newUnitMeasurementButton.addEventListener("click", () => {
  openNewUnitMeasurementFormModal();
});

const obtenerListadoUnidadesMedidasDataTable = () => {
  $("#listadoUnidadesMedidasDataTable")
    .dataTable({
      aProcessing: true,
      aServerSide: true,
      dom: "Bfrtip",
      searching: true,
      lengthChange: false,
      colReorder: true,
      buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
      ajax: {
        url: "../../controller/UnidadesMedidasController.php?op=listado_unidades_medidas",
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
  obtenerListadoUnidadesMedidasDataTable();
})();

const openUpdateUnitMeasurementFormModal = () => {
  $("#updateUnitMeasurementFormModal").modal("show");
};

const verDetalleUnidadMedida = (unidadMedidaID) => {
  $.post(
    "../../controller/UnidadesMedidasController.php?op=obtener_detalles_unidades_medidas_por_unidad_medida_ID",
    {
      unidadMedidaID: unidadMedidaID,
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

        const { unidadMedidaID, unidadMedida } = responseData;

        const unidadMedidaIDInput = document.getElementById("unidadMedidaID");
        const modificarUnidadMedidaInput = document.getElementById(
          "modificarUnidadMedida"
        );

        unidadMedidaIDInput.value =
          unidadMedidaID != null ? unidadMedidaID : "";

        modificarUnidadMedidaInput.value =
          unidadMedida != null ? unidadMedida : "";

        openUpdateUnitMeasurementFormModal();
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

const eliminarUnidadMedida = (unidadMedidaID) => {
  Swal.fire({
    title: "¿Deseas eliminar esta unidad de medida seleccionada?",
    inputAttributes: {
      autocapitalize: "off",
    },
    showCancelButton: true,
    confirmButtonText: "Eliminar",
    showLoaderOnConfirm: true,
    preConfirm: () => {
      $.post(
        "../../controller/UnidadesMedidasController.php?op=eliminar_unidades_medidas",
        {
          unidadMedidaID: unidadMedidaID,
        }
      )
        .done(function (data, status) {
          Swal.fire({
            position: "center",
            icon: "success",
            title: "Unidad de medida eliminada satisfactoriamente.",
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
