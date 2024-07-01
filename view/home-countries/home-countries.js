navLinkPrimary("navLinkMaintenance");

navLinkSecondary("navLinkHomeCountries");

setContentHeaderTitle("Listado De Países");

setBreadCrumbContentHeaderTitle("../dashboard/", "Dashboard");

setBreadCrumbContentHeaderSubTitle("Listado De Países");

const openNewCountryFormModal = () => {
  $("#newCountryFormModal").modal("show");
};

const newCountryButton = document.getElementById("newCountryButton");
newCountryButton.addEventListener("click", () => {
  openNewCountryFormModal();
});

const obtenerListadoPaisesDataTable = () => {
  $("#listadoPaisesDataTable")
    .dataTable({
      aProcessing: true,
      aServerSide: true,
      dom: "Bfrtip",
      searching: true,
      lengthChange: false,
      colReorder: true,
      buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
      ajax: {
        url: "../../controller/PaisesController.php?op=listado_paises",
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
      iDisplayLength: 5,
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
  obtenerListadoPaisesDataTable();
})();

const verDetallePais = (paisID) => {
  $.post(
    "../../controller/PaisesController.php?op=obtener_detalle_pais_por_paisID",
    {
      paisID: paisID,
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

        const { paisID, pais } = responseData;

        const paisIDInput = document.getElementById("paisID");
        const modificarNombrepaisInput = document.getElementById(
          "modificarNombrePais"
        );

        paisIDInput.value = paisID != null ? paisID : "";
        modificarNombrepaisInput.value = pais != null ? pais : "";

        $("#updateCountryFormModal").modal("show");
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

const eliminarPais = (paisID) => {
  Swal.fire({
    title: "¿Deseas eliminar este país seleccionado?",
    inputAttributes: {
      autocapitalize: "off",
    },
    showCancelButton: true,
    confirmButtonText: "Eliminar",
    showLoaderOnConfirm: true,
    preConfirm: () => {
      $.post(
        "../../controller/PaisesController.php?op=eliminar_paises_por_paisID",
        {
          paisID: paisID,
        }
      )
        .done(function (data, status) {
          Swal.fire({
            position: "center",
            icon: "success",
            title: "País eliminado satisfactoriamente.",
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
