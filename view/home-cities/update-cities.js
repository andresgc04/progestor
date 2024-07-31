function updateCities() {
  let updateCitiesFormData = new FormData($("#updateCitiesForm")[0]);

  $.ajax({
    url: "../../controller/CiudadesController.php?op=modificar_ciudades_por_pais_ID_provincia_ID_ciudad_ID",
    type: "POST",
    data: updateCitiesFormData,
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        position: "center",
        icon: "success",
        title: "Ciudad Modificada Correctamente",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
      }).then(
        (willClose = () => {
          window.location.reload();
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
      updateCities();
    },
  });

  $("#updateCitiesForm").validate({
    rules: {
      modificarPaisID: {
        required: true,
      },
      modificarProvinciaID: {
        required: true,
      },
      modificarNombreCiudad: {
        required: true,
      },
    },
    messages: {
      modificarPaisID: {
        required: "Por favor seleccione el país.",
      },
      modificarProvinciaID: {
        required: "Por favor seleccione la provincia.",
      },
      modificarNombreCiudad: {
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
