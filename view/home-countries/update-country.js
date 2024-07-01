function updateCountry() {
  let updateCountryFormData = new FormData($("#updateCountryForm")[0]);

  $.ajax({
    url: "../../controller/PaisesController.php?op=modificar_puestos_por_puestoID",
    type: "POST",
    data: updateCountryFormData,
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        position: "center",
        icon: "success",
        title: "País Modificado Correctamente",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
      }).then(
        (willClose = () => {
          $("#paisID").val("");
          $("#modificarNombrePais").val("");

          $("#updateCountryFormModal").modal("hide");
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
          window.location.reload();
        })
      );
    },
  });
}

$(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      updateCountry();
    },
  });

  $("#updateCountryForm").validate({
    rules: {
      modificarNombrePais: {
        required: true,
      },
    },
    messages: {
      modificarNombrePais: {
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
