function updateRoles() {
  let updateRolFormData = new FormData($("#updateRolForm")[0]);

  $.ajax({
    url: "../../controller/RolesController.php?op=modificar_roles_por_rol_ID",
    type: "POST",
    data: updateRolFormData,
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        position: "center",
        icon: "success",
        title: "Rol Modificado Correctamente",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
      }).then(
        (willClose = () => {
          $("#modificarRol").val("");

          $("#updateRolFormModal").modal("hide");
          $("#listadoRolesDataTable").DataTable().ajax.reload();
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
      updateRoles();
    },
  });

  $("#updateRolForm").validate({
    rules: {
      modificarRol: {
        required: true,
      },
    },
    messages: {
      modificarRol: {
        required: "Por favor ingrese el nombre del rol.",
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
