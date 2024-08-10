navLinkPrimary("navLinkHomeSystemModules");

setContentHeaderTitle("Listado De Módulos Del Sistema");

setBreadCrumbContentHeaderTitle("../dashboard/", "Dashboard");

setBreadCrumbContentHeaderSubTitle("Listado De Módulos Del Sistema");

const openNewSystemModulesFormModal = () => {
  $("#newSystemModulesFormModal").modal("show");
};

const newSystemModulesButton = document.getElementById(
  "newSystemModulesButton"
);
newSystemModulesButton.addEventListener("click", () => {
  openNewSystemModulesFormModal();
});

const obtenerListadoModulosSistemasDataTable = () => {
  $("#listadoModulosDelSistemaDataTable")
    .dataTable({
      aProcessing: true,
      aServerSide: true,
      dom: "Bfrtip",
      searching: true,
      lengthChange: false,
      colReorder: true,
      buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
      ajax: {
        url: "../../controller/ModulosSistemasController.php?op=listado_modulos_sistemas",
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
  obtenerListadoModulosSistemasDataTable();
})();

const openUpdateSystemModulesFormModal = () => {
  $("#updateSystemModulesFormModal").modal("show");
};

const verDetalleModuloSistema = (moduloSistemaID) => {
  $.post(
    "../../controller/ModulosSistemasController.php?op=obtener_detalle_modulo_sistema_por_modulo_sistema_ID",
    {
      moduloSistemaID: moduloSistemaID,
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

        const { moduloSistemaID, modulo } = responseData;

        const moduloSistemaIDInput = document.getElementById("moduloSistemaID");
        const modificarNombreModuloSistemaInput = document.getElementById(
          "modificarNombreModuloSistema"
        );

        moduloSistemaIDInput.value =
          moduloSistemaID != null ? moduloSistemaID : "";

        modificarNombreModuloSistemaInput.value = modulo != null ? modulo : "";

        openUpdateSystemModulesFormModal();
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

const eliminarModuloSistema = (moduloSistemaID) => {
  Swal.fire({
    title: "¿Deseas eliminar este modulo del sistema seleccionado?",
    inputAttributes: {
      autocapitalize: "off",
    },
    showCancelButton: true,
    confirmButtonText: "Eliminar",
    showLoaderOnConfirm: true,
    preConfirm: () => {
      $.post(
        "../../controller/ModulosSistemasController.php?op=eliminar_modulos_sistemas_por_modulo_sistema_ID",
        {
          moduloSistemaID: moduloSistemaID,
        }
      )
        .done(function (data, status) {
          Swal.fire({
            position: "center",
            icon: "success",
            title: "Modulo del sistema eliminado satisfactoriamente.",
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
