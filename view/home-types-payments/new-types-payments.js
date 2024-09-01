function saveNewTypesPayments() {
  let newTypesPaymentsFormData = new FormData($("#newTypesPaymentsForm")[0]);

  $.ajax({
    url: "../../controller/TiposPagosController.php?op=registrar_tipos_pagos",
    type: "POST",
    data: newTypesPaymentsFormData,
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        position: "center",
        icon: "success",
        title: "Tipo De Pago Registrado Correctamente",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
      }).then(
        (willClose = () => {
          $("#tipoPago").val("");

          $("#newTypesPaymentsFormModal").modal("hide");
          $("#listadoTiposPagosDataTable").DataTable().ajax.reload();
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
      saveNewTypesPayments();
    },
  });

  $("#newTypesPaymentsForm").validate({
    rules: {
      tipoPago: {
        required: true,
      },
    },
    messages: {
      tipoPago: {
        required: "Por favor ingrese el nombre del tipo de pago.",
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
