function saveNewCities() {
  let newCitiesFormData = new FormData($("#newCitiesForm")[0]);

  $.ajax({
    url: "../../controller/CiudadesController.php?op=registrar_ciudad",
    type: "POST",
    data: newCitiesFormData,
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        position: "center",
        icon: "success",
        title: "Ciudad Registrada Correctamente",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
      }).then(
        (willClose = () => {
          getSelectListCountriesOptions(
            "../../controller/PaisesController.php?op=obtener_listado_opciones_paises",
            "#paisID"
          );

          $("#provinciaID").html("");
          $("#nombreCiudad").val("");

          $("#newCitiesFormModal").modal("hide");
          $("#listadoCiudadesDataTable").DataTable().ajax.reload();
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
          $("#paisID").val("");
          $("#provinciaID").val("");
          $("#nombreCiudad").val("");

          window.location.reload();
        })
      );
    },
  });
}

$(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      saveNewCities();
    },
  });

  $("#newCitiesForm").validate({
    rules: {
      paisID: {
        required: true,
      },
      provinciaID: {
        required: true,
      },
      nombreCiudad: {
        required: true,
      },
    },
    messages: {
      paisID: {
        required: "Por favor seleccione el país.",
      },
      provinciaID: {
        required: "Por favor seleccione la provincia.",
      },
      nombreCiudad: {
        required: "Por favor ingrese el nombre de la ciudad.",
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
