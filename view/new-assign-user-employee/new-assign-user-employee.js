navLinkPrimary("navLinkUsers");

navLinkSecondary("navLinkHomeAssignUserEmployee");

setContentHeaderTitle("Asignar Usuario A Empleado");

setBreadCrumbContentHeaderTitle(
  "../home-assign-user-employee/",
  "Listado De Usuarios Asignados A Empleados"
);

setBreadCrumbContentHeaderSubTitle("Asignar Usuario A Empleado");

(function () {
  //Initialize Select2 Elements:
  initializeSelect2Elements();

  getSelectListEmployeesOptions(
    "../../controller/EmpleadosController.php?op=obtener_listado_opciones_empleados",
    "#empleadoID"
  );

  getSelectListRolesOptions(
    "../../controller/RolesController.php?op=obtener_listado_opciones_roles",
    "#rolID"
  );
})();

function saveAssignUserEmployee() {
  let newAssignUserEmployeeFormData = new FormData(
    $("#newAssignUserEmployeeForm")[0]
  );

  $.ajax({
    url: "../../controller/UsuariosController.php?op=registrar_usuarios_empleados",
    type: "POST",
    data: newAssignUserEmployeeFormData,
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        position: "center",
        icon: "success",
        title: "Usuario Asignado A Empleado Correctamente",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
      }).then(
        (willClose = () => {
          window.location.href = "../home-assign-user-employee/";
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
      saveAssignUserEmployee();
    },
  });

  $("#newAssignUserEmployeeForm").validate({
    rules: {
      empleadoID: {
        required: true,
      },
      rolID: {
        required: true,
      },
      nombreUsuarioEmpleado: {
        required: true,
      },
      passwordUsuarioEmpleado: {
        required: true,
      },
    },
    messages: {
      empleadoID: {
        required: "Por favor seleccione el empleado.",
      },
      rolID: {
        required: "Por favor seleccione el rol.",
      },
      nombreUsuarioEmpleado: {
        required: "Por favor ingrese el nombre del usuario.",
      },
      passwordUsuarioEmpleado: {
        required: "Por favor ingrese el password del usuario.",
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
