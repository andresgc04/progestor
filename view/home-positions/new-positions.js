function saveNewPositions() {
  let newPositionsFormData = new FormData($("#newPositionsForm")[0]);

  $.ajax({
    url: "../../controller/PuestosController.php?op=registrar_puestos",
    type: "POST",
    data: newPositionsFormData,
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        position: "center",
        icon: "success",
        title: "Puesto Registrado Correctamente",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
      }).then(
        (willClose = () => {
          $("#puesto").val("");

          $("#newPositionsFormModal").modal("hide");
          $("#listadoPuestosDataTable").DataTable().ajax.reload();
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
          $("#puesto").val("");

          window.location.reload();
        })
      );
    },
  });
}

$(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      saveNewPositions();
    },
  });

  $("#newPositionsForm").validate({
    rules: {
      puesto: {
        required: true,
      },
    },
    messages: {
      puesto: {
        required: "Por favor ingrese el nombre del puesto.",
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
