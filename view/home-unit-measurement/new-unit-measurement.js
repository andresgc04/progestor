function saveNewUnitMeasurement() {
  let newUnitMeasurementFormData = new FormData(
    $("#newUnitMeasurementForm")[0]
  );

  $.ajax({
    url: "../../controller/UnidadesMedidasController.php?op=registrar_unidades_medidas",
    type: "POST",
    data: newUnitMeasurementFormData,
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        position: "center",
        icon: "success",
        title: "Unidad De Medida Registrada Correctamente",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
      }).then(
        (willClose = () => {
          $("#unidadMedida").val("");

          $("#newUnitMeasurementFormModal").modal("hide");

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
          $("#unidadMedida").val("");

          window.location.reload();
        })
      );
    },
  });
}

$(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      saveNewUnitMeasurement();
    },
  });

  $("#newUnitMeasurementForm").validate({
    rules: {
      unidadMedida: {
        required: true,
      },
    },
    messages: {
      unidadMedida: {
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
