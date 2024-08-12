function saveNewAssignSystemModuleRole() {
  let newAssignSystemModuleRoleFormData = new FormData(
    $("#newAssignSystemModuleRoleForm")[0]
  );

  $.ajax({
    url: "../../controller/AccesosModulosSistemasController.php?op=registrar_accesos_modulos_sistemas",
    type: "POST",
    data: newAssignSystemModuleRoleFormData,
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        position: "center",
        icon: "success",
        title: "Acceso A Modulo Del Sistema Asignado Correctamente",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
      }).then(
        (willClose = () => {
          getSelectListRolesOptions(
            "../../controller/RolesController.php?op=obtener_listado_opciones_roles",
            "#rolID"
          );

          getSelectListSystemModulesOptions(
            "../../controller/ModulosSistemasController.php?op=obtener_listado_opciones_modulos_sistemas",
            "#moduloSistemaID"
          );

          $("#newAssignSystemModuleRoleFormModal").modal("hide");
          $("#listadoAccesosModulosSistemasDataTable")
            .DataTable()
            .ajax.reload();
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
      saveNewAssignSystemModuleRole();
    },
  });

  $("#newAssignSystemModuleRoleForm").validate({
    rules: {
      rolID: {
        required: true,
      },
      moduloSistemaID: {
        required: true,
      },
    },
    messages: {
      rolID: {
        required: "Por favor seleccione el rol.",
      },
      moduloSistemaID: {
        required: "Por favor seleccione el modulo del sistema.",
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
