function saveNewSystemModules() {
  let newSystemModulesFormData = new FormData($("#newSystemModulesForm")[0]);

  $.ajax({
    url: "../../controller/ModulosSistemasController.php?op=registrar_modulos_sistemas",
    type: "POST",
    data: newSystemModulesFormData,
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        position: "center",
        icon: "success",
        title: "Módulo Del Sistema Registrado Correctamente",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
      }).then(
        (willClose = () => {
          $("#nombreModuloSistema").val("");

          $("#newSystemModulesFormModal").modal("hide");
          $("#listadoModulosDelSistemaDataTable").DataTable().ajax.reload();
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
          $("#nombreModuloSistema").val("");

          window.location.reload();
        })
      );
    },
  });
}

$(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      saveNewSystemModules();
    },
  });

  $("#newSystemModulesForm").validate({
    rules: {
      nombreModuloSistema: {
        required: true,
      },
    },
    messages: {
      nombreModuloSistema: {
        required: "Por favor ingrese el nombre del módulo del sistema.",
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
