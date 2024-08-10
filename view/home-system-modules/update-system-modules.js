function updateSystemModules() {
  let updateSystemModulesFormData = new FormData(
    $("#updateSystemModulesForm")[0]
  );

  $.ajax({
    url: "../../controller/ModulosSistemasController.php?op=modificar_modulos_sistemas_por_modulo_sistema_ID",
    type: "POST",
    data: updateSystemModulesFormData,
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        position: "center",
        icon: "success",
        title: "Módulo Del Sistema Modificado Correctamente",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
      }).then(
        (willClose = () => {
          $("#moduloSistemaID").val("");
          $("#modificarNombreModuloSistema").val("");

          $("#updateSystemModulesFormModal").modal("hide");
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
          $("#moduloSistemaID").val("");
          $("#modificarNombreModuloSistema").val("");

          window.location.reload();
        })
      );
    },
  });
}

$(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      updateSystemModules();
    },
  });

  $("#updateSystemModulesForm").validate({
    rules: {
      modificarNombreModuloSistema: {
        required: true,
      },
    },
    messages: {
      modificarNombreModuloSistema: {
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
