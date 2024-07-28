navLinkPrimary("navLinkMaintenance");

navLinkSecondary("navLinkHomeProvinces");

setContentHeaderTitle("Listado De Provincias");

setBreadCrumbContentHeaderTitle("../dashboard/", "Dashboard");

setBreadCrumbContentHeaderSubTitle("Listado De Provincias");

const openNewProvinceFormModal = () => {
  $("#newProvinceFormModal").modal("show");
};

const newProvinceButton = document.getElementById("newProvinceButton");
newProvinceButton.addEventListener("click", () => {
  openNewProvinceFormModal();
});

const obtenerListadoProvinciasDataTable = () => {
  $("#listadoProvinciasDataTable")
    .dataTable({
      aProcessing: true,
      aServerSide: true,
      dom: "Bfrtip",
      searching: true,
      lengthChange: false,
      colReorder: true,
      buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
      ajax: {
        url: "../../controller/ProvinciasController.php?op=listado_provincias",
        type: "post",
        dataType: "json",
        error: function (e) {
          console.log(e.responseText);
        },
      },
      ordering: true,
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

  obtenerListadoProvinciasDataTable();

  getSelectListCountriesOptions(
    "../../controller/PaisesController.php?op=obtener_listado_opciones_paises",
    "#paisID"
  );
})();

const openUpdateProvinceFormModal = () => {
  $("#updateProvinceFormModal").modal("show");
};

const verDetalleProvincia = (paisID, provinciaID) => {
  $.post(
    "../../controller/ProvinciasController.php?op=obtener_detalles_provincias_por_pais_ID_provincia_ID",
    {
      paisID: paisID,
      provinciaID: provinciaID,
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

        const { paisID, provinciaID, provincia } = responseData;

        const paisIDInput = document.getElementById("updatePaisID");

        const provinciaIDInput = document.getElementById("updateProvinciaID");

        getSelectListCountriesOptionsByPaisID(
          "../../controller/PaisesController.php?op=obtener_listado_opciones_paises_por_pais_ID",
          paisID,
          "#modificarPaisID"
        );

        const modificarNombreProvinciaInput = document.getElementById(
          "modificarNombreProvincia"
        );

        paisIDInput.value = paisID != null ? paisID : "";

        provinciaIDInput.value = provinciaID != null ? provinciaID : "";

        modificarNombreProvinciaInput.value =
          provincia != null ? provincia : "";

        openUpdateProvinceFormModal();
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

const eliminarProvincia = (paisID, provinciaID) => {
  Swal.fire({
    title: "¿Deseas eliminar esta provincia seleccionada?",
    inputAttributes: {
      autocapitalize: "off",
    },
    showCancelButton: true,
    confirmButtonText: "Eliminar",
    showLoaderOnConfirm: true,
    preConfirm: () => {
      $.post(
        "../../controller/ProvinciasController.php?op=eliminar_provincias_por_pais_ID_provinciaID",
        {
          paisID: paisID,
          provinciaID: provinciaID,
        }
      )
        .done(function (data, status) {
          Swal.fire({
            position: "center",
            icon: "success",
            title: "Provincia eliminada satisfactoriamente.",
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
