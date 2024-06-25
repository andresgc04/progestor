navLinkSecondary("navLinkHomeSuppliers");

setContentHeaderTitle("Registrar Nuevo Proveedor");

setBreadCrumbContentHeaderTitle("../home-suppliers/", "Listado De Proveedores");

setBreadCrumbContentHeaderSubTitle("Registrar Nuevo proveedor");

(function () {
  //Initialize Select2 Elements:
  initializeSelect2Elements();

  //Initialize InputMask:
  $("[data-mask]").inputmask();

  getSelectListTypesSuppliersOptions(
    "../../controller/TiposProveedoresController.php?op=obtener_listado_opciones_tipos_proveedores",
    "#tipoProveedorID"
  );

  getSelectListPaymentConditionsOptions(
    "../../controller/CondicionesPagosController.php?op=obtener_listado_opciones_condiciones_pagos",
    "#condicionPagoID"
  );

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

const provinciaSelectInput = document.getElementById("provinciaID");
provinciaSelectInput.onchange = (event) => {
  const paisID = document.getElementById("paisID").value;
  const provinciaID = event.target.value;

  getSelectListCitiesOptionsByPaisIDAndProvinciaID(
    "../../controller/CiudadesController.php?op=obtener_listado_opciones_ciudades_por_paisID_provinciaID",
    paisID,
    provinciaID,
    "#ciudadID"
  );
};

function saveNewSuppliers() {
  let newSuppliersFormData = new FormData($("#newSuppliersForm")[0]);

  $.ajax({
    url: "../../controller/ProveedoresController.php?op=registrar_proveedores",
    type: "POST",
    data: newSuppliersFormData,
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        position: "center",
        icon: "success",
        title: "Proveedor Registrado Correctamente",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
      }).then(
        (willClose = () => {
          window.location.href = "../home-suppliers/";
        })
      );
    },
    error: function (data) {
      Swal.fire({
        position: "center",
        icon: "error",
        title: "Ocurrio un error inesperado",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
      }).then(
        (willClose = () => {
          window.location.reload();
        })
      );
    },
  });
}

$(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      saveNewSuppliers();
    },
  });

  $("#newSuppliersForm").validate({
    rules: {
      nombreProveedor: {
        required: true,
      },
      tipoProveedorID: {
        required: true,
      },
      condicionPagoID: {
        required: true,
      },
      paisID: {
        required: true,
      },
      provinciaID: {
        required: true,
      },
      ciudadID: {
        required: true,
      },
      direccion: {
        required: true,
      },
      telefono: {
        required: true,
      },
      correoElectronico: {
        required: true,
      },
      nombreRepresentanteVentas: {
        required: true,
      },
      contactoRepresentanteVentas: {
        required: true,
      },
    },
    messages: {
      nombreProveedor: {
        required: "Por favor ingrese el primer nombre.",
      },
      tipoProveedorID: {
        required: "Por favor ingrese el primer apellido.",
      },
      condicionPagoID: {
        required: "Por favor seleccione el sexo.",
      },
      paisID: {
        required: "Por favor seleccione el estado civil.",
      },
      provinciaID: {
        required: "Por favor ingrese la cedula.",
      },
      ciudadID: {
        required: "Por favor seleccione la fecha de nacimiento.",
      },
      direccion: {
        required: "Por favor seleccione la nacionalidad.",
      },
      telefono: {
        required: "Por favor seleccione el país.",
      },
      correoElectronico: {
        required: "Por favor seleccione la provincia.",
      },
      nombreRepresentanteVentas: {
        required: "Por favor seleccione la ciudad.",
      },
      contactoRepresentanteVentas: {
        required: "Por favor ingrese la dirección.",
      },
    },
    errorElement: "span",
    errorPlacement: function (error, element) {
      error.addClass("invalid-feedback");
      element.closest(".form-group").append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass("is-invalid");
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass("is-invalid");
    },
  });
});
