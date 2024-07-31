navLinkPrimary("navLinkMaintenance");

navLinkSecondary("navLinkHomeCities");

setContentHeaderTitle("Listado De Ciudades");

setBreadCrumbContentHeaderTitle("../dashboard/", "Dashboard");

setBreadCrumbContentHeaderSubTitle("Listado De Ciudades");

const openNewCitiesFormModal = () => {
  $("#newCitiesFormModal").modal("show");
};

const newCityButton = document.getElementById("newCityButton");
newCityButton.addEventListener("click", () => {
  openNewCitiesFormModal();
});

const obtenerListadoCiudadesDataTable = () => {
  $("#listadoCiudadesDataTable")
    .dataTable({
      aProcessing: true,
      aServerSide: true,
      dom: "Bfrtip",
      searching: true,
      lengthChange: false,
      colReorder: true,
      buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
      ajax: {
        url: "../../controller/CiudadesController.php?op=listado_ciudades",
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

  obtenerListadoCiudadesDataTable();

  getSelectListCountriesOptions(
    "../../controller/PaisesController.php?op=obtener_listado_opciones_paises",
    "#paisID"
  );
})();

const paisSelectInput = document.getElementById("paisID");
paisSelectInput.onchange = (event) => {
  const paisID = event.target.value;

  getSelectListProvincesOptionsByPaisID(
    "../../controller/ProvinciasController.php?op=obtener_listado_opciones_provincias_por_paisID",
    paisID,
    "#provinciaID"
  );
};

const openUpdateCitiesFormModal = () => {
  $("#updateCitiesFormModal").modal("show");
};

const verDetalleCiudad = (paisID, provinciaID, ciudadID) => {
  $.post(
    "../../controller/CiudadesController.php?op=obtener_detalles_ciudades_por_pais_ID_provincia_ID_ciudad_ID",
    {
      paisID: paisID,
      provinciaID: provinciaID,
      ciudadID: ciudadID,
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

        const { paisID, provinciaID, ciudadID, ciudad } = responseData;

        const paisIDInput = document.getElementById("updatePaisID");

        const provinciaIDInput = document.getElementById("updateProvinciaID");

        const ciudadIDInput = document.getElementById("updateCiudadID");

        paisIDInput.value = paisID != null ? paisID : "";

        provinciaIDInput.value = provinciaID != null ? provinciaID : "";

        ciudadIDInput.value = ciudadID != null ? ciudadID : "";

        getSelectListCountriesOptionsByPaisID(
          "../../controller/PaisesController.php?op=obtener_listado_opciones_paises_por_pais_ID",
          paisID,
          "#modificarPaisID"
        );

        getSelectListProvincesOptionsByProvinciaID(
          "../../controller/ProvinciasController.php?op=obtener_listado_opciones_provincias_por_provincia_ID",
          provinciaID,
          "#modificarProvinciaID"
        );

        const modificarNombreCiudadInput = document.getElementById(
          "modificarNombreCiudad"
        );

        modificarNombreCiudadInput.value = ciudad != null ? ciudad : "";

        const paisSelectInput = document.getElementById("modificarPaisID");
        paisSelectInput.onchange = (event) => {
          const paisID = event.target.value;

          getSelectListProvincesOptionsByPaisID(
            "../../controller/ProvinciasController.php?op=obtener_listado_opciones_provincias_por_paisID",
            paisID,
            "#modificarProvinciaID"
          );
        };

        openUpdateCitiesFormModal();
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
