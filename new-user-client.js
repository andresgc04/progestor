function saveNewUserClient() {
  let newUserClientFormData = new FormData($("#newUserClientForm")[0]);

  $.ajax({
    url: "controller/UsuariosController.php?op=registrar_usuarios_clientes",
    type: "POST",
    data: newUserClientFormData,
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        position: "center",
        icon: "success",
        title: "Usuario Cliente Registrado Correctamente",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
      }).then(
        (willClose = () => {
          window.location.reload();
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
      saveNewUserClient();
    },
  });

  $("#newUserClientForm").validate({
    rules: {
      tipoClienteID: {
        required: true,
      },
      primerNombre: {
        required: true,
      },
      primerApellido: {
        required: true,
      },
      segundoApellido: {
        required: true,
      },
      sexoID: {
        required: true,
      },
      cedula: {
        required: true,
      },
      fechaNacimiento: {
        required: true,
      },
      nacionalidadID: {
        required: true,
      },
      paisID: {
        required: true,
      },
      provinciaID: {
        required: true,
      },
      ciudadID: {
        required: true,
      },
      direccion: {
        required: true,
      },
      telefonoResidencial: {
        required: true,
      },
      telefonoCelular: {
        required: true,
      },
      correoElectronico: {
        required: true,
      },
      nuevoNombreUsuario: {
        required: true,
      },
      nuevoPassword: {
        required: true,
      },
      confirmarNuevoPassword: {
        required: true,
      },
    },
    messages: {
      tipoClienteID: {
        required: "Por favor seleccione el tipo de cliente.",
      },
      primerNombre: {
        required: "Por favor ingrese el primer nombre.",
      },
      primerApellido: {
        required: "Por favor ingrese el primer apellido.",
      },
      segundoApellido: {
        required: "Por favor ingrese el segundo apellido.",
      },
      sexoID: {
        required: "Por favor seleccione el sexo.",
      },
      cedula: {
        required: "Por favor ingrese la cedula.",
      },
      fechaNacimiento: {
        required: "Por favor seleccione la fecha de nacimiento.",
      },
      nacionalidadID: {
        required: "Por favor seleccione la nacionalidad.",
      },
      paisID: {
        required: "Por favor seleccione el país.",
      },
      provinciaID: {
        required: "Por favor seleccione la provincia.",
      },
      ciudadID: {
        required: "Por favor seleccione la ciudad.",
      },
      direccion: {
        required: "Por favor ingrese la dirección.",
      },
      telefonoResidencial: {
        required: "Por favor ingrese el télefono residencial.",
      },
      telefonoCelular: {
        required: "Por favor ingrese el télefono celular.",
      },
      correoElectronico: {
        required: "Por favor ingrese el correo electrónico.",
      },
      nuevoNombreUsuario: {
        required: "Por favor ingrese el nombre de usuario.",
      },
      nuevoPassword: {
        required: "Por favor ingrese el password.",
      },
      confirmarNuevoPassword: {
        required: "Por favor confirme el password.",
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
