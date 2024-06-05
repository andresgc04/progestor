function saveNewCountry() {
  let newCountryFormData = new FormData($("#newCountryForm")[0]);

  $.ajax({
    url: "../../controller/PaisesController.php?op=registrar_pais",
    type: "POST",
    data: newCountryFormData,
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        position: "center",
        icon: "success",
        title: "País Registrado Correctamente",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
      }).then(
        (willClose = () => {
          $("#nombrePais").val("");

          $("#newCountryFormModal").modal("hide");
          $("#listadoPaisesDataTable").DataTable().ajax.reload();
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
          $("#nombrePais").val("");

          window.location.reload();
        })
      );
    },
  });
}

$(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      saveNewCountry();
    },
  });

  $("#newCountryForm").validate({
    rules: {
      nombrePais: {
        required: true,
      },
    },
    messages: {
      nombrePais: {
        required: "Por favor ingrese el nombre del país.",
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
