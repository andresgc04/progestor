function saveNewProvince() {
  let newProvinceFormData = new FormData($("#newProvinceForm")[0]);

  $.ajax({
    url: "../../controller/ProvinciasController.php?op=registrar_provincia",
    type: "POST",
    data: newProvinceFormData,
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        position: "center",
        icon: "success",
        title: "Provincia Registrada Correctamente",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
      }).then(
        (willClose = () => {
          getSelectListProvincesOptions(
            "../../controller/PaisesController.php?op=obtener_listado_opciones_paises",
            "#paisID"
          );

          $("#nombreProvincia").val("");

          $("#newProvinceFormModal").modal("hide");
          $("#listadoProvinciasDataTable").DataTable().ajax.reload();
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
          $("#nombreProvincia").val("");

          window.location.reload();
        })
      );
    },
  });
}

$(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      saveNewProvince();
    },
  });

  $("#newProvinceForm").validate({
    rules: {
      paisID: {
        required: true,
      },
      nombreProvincia: {
        required: true,
      },
    },
    messages: {
      paisID: {
        required: "Por favor seleccione el país.",
      },
      nombreProvincia: {
        required: "Por favor ingrese el nombre de la provincia.",
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
