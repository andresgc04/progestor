function updateUnitMeasurement() {
  let updateUnitMeasurementFormData = new FormData(
    $("#updateUnitMeasurementForm")[0]
  );

  $.ajax({
    url: "../../controller/UnidadesMedidasController.php?op=modificar_unidades_medidas",
    type: "POST",
    data: updateUnitMeasurementFormData,
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        position: "center",
        icon: "success",
        title: "Unidad De Medida Modificada Correctamente",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
      }).then(
        (willClose = () => {
          $("#unidadMedidaID").val("");
          $("#modificarUnidadMedida").val("");

          $("#updateUnitMeasurementFormModal").modal("hide");

          $("#listadoUnidadesMedidasDataTable").DataTable().ajax.reload();
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
      updateUnitMeasurement();
    },
  });

  $("#updateUnitMeasurementForm").validate({
    rules: {
      modificarUnidadMedida: {
        required: true,
      },
    },
    messages: {
      modificarUnidadMedida: {
        required: "Por favor ingrese el nombre de la unidad de medida.",
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
