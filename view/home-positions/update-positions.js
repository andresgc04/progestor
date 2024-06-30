function updatePositions() {
  let updatePositionsFormData = new FormData($("#updatePositionsForm")[0]);

  $.ajax({
    url: "../../controller/PuestosController.php?op=modificar_puestos_por_puestoID",
    type: "POST",
    data: updatePositionsFormData,
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        position: "center",
        icon: "success",
        title: "Puesto Modificado Correctamente",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
      }).then(
        (willClose = () => {
          $("#puestoID").val("");
          $("#modificarPuesto").val("");

          $("#updatePositionsFormModal").modal("hide");
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
          $("#puestoID").val("");
          $("#modificarPuesto").val("");

          window.location.reload();
        })
      );
    },
  });
}

$(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      updatePositions();
    },
  });

  $("#updatePositionsForm").validate({
    rules: {
      modificarPuesto: {
        required: true,
      },
    },
    messages: {
      modificarPuesto: {
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
