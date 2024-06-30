navLinkPrimary("navLinkMaintenance");

navLinkSecondary("navLinkHomePositions");

setContentHeaderTitle("Listado De Puestos");

setBreadCrumbContentHeaderTitle("../dashboard/", "Dashboard");

setBreadCrumbContentHeaderSubTitle("Listado De Puestos");

const openNewPositionsFormModal = () => {
  $("#newPositionsFormModal").modal("show");
};

const newPositionsButton = document.getElementById("newPositionsButton");
newPositionsButton.addEventListener("click", () => {
  openNewPositionsFormModal();
});

const obtenerListadoPuestosDataTable = () => {
  $("#listadoPuestosDataTable")
    .dataTable({
      aProcessing: true,
      aServerSide: true,
      dom: "Bfrtip",
      searching: true,
      lengthChange: false,
      colReorder: true,
      buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
      ajax: {
        url: "../../controller/PuestosController.php?op=listado_puestos",
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
  obtenerListadoPuestosDataTable();
})();

const verDetallePuesto = (puestoID) => {
  $.post(
    "../../controller/PuestosController.php?op=obtener_detalle_puesto_por_puestoID",
    {
      puestoID: puestoID,
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

        const { puestoID, puesto } = responseData;

        const puestoIDInput = document.getElementById("puestoID");
        const puestoInput = document.getElementById("modificarPuesto");

        puestoIDInput.value = puestoID != null ? puestoID : "";
        puestoInput.value = puesto != null ? puesto : "";

        $("#updatePositionsFormModal").modal("show");
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
