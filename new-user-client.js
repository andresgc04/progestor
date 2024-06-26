function saveNewUserIndividualClient() {
  let newUserIndividualClientFormData = new FormData(
    $("#newUserIndividualClientForm")[0]
  );

  $.ajax({
    url: "controller/UsuariosController.php?op=registrar_usuarios_clientes_individuales",
    type: "POST",
    data: newUserIndividualClientFormData,
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        position: "center",
        icon: "success",
        title: "Usuario Cliente Individual Registrado Correctamente",
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
      saveNewUserIndividualClient();
    },
  });

  $("#newUserIndividualClientForm").validate({
    rules: {
      nombreClienteClienteIndividual: {
        required: true,
      },
      apellidoClienteClienteIndividual: {
        required: true,
      },
      sexoIDClienteIndividual: {
        required: true,
      },
      cedulaClienteIndividual: {
        required: true,
      },
      fechaNacimientoClienteIndividual: {
        required: true,
      },
      nacionalidadIDClienteIndividual: {
        required: true,
      },
      telefonoClienteIndividual: {
        required: true,
      },
      correoElectronicoClienteIndividual: {
        required: true,
      },
      paisIDClienteIndividual: {
        required: true,
      },
      provinciaIDClienteIndividual: {
        required: true,
      },
      ciudadIDClienteIndividual: {
        required: true,
      },
      direccionClienteIndividual: {
        required: true,
      },
      nuevoNombreUsuarioClienteIndividual: {
        required: true,
      },
      nuevoPasswordClienteIndividual: {
        required: true,
      },
      confirmarNuevoPasswordClienteIndividual: {
        required: true,
      },
    },
    messages: {
      nombreClienteClienteIndividual: {
        required: "Por favor ingrese el nombre.",
      },
      apellidoClienteClienteIndividual: {
        required: "Por favor ingrese el apellido.",
      },
      sexoIDClienteIndividual: {
        required: "Por favor seleccione el sexo.",
      },
      cedulaClienteIndividual: {
        required: "Por favor ingrese la cedula.",
      },
      fechaNacimientoClienteIndividual: {
        required: "Por favor seleccione la fecha de nacimiento.",
      },
      nacionalidadIDClienteIndividual: {
        required: "Por favor seleccione la nacionalidad.",
      },
      telefonoClienteIndividual: {
        required: "Por favor ingrese el télefono.",
      },
      correoElectronicoClienteIndividual: {
        required: "Por favor ingrese el correo electronico.",
      },
      paisIDClienteIndividual: {
        required: "Por favor seleccione el país.",
      },
      provinciaIDClienteIndividual: {
        required: "Por favor seleccione la provincia.",
      },
      ciudadIDClienteIndividual: {
        required: "Por favor seleccione la ciudad.",
      },
      direccionClienteIndividual: {
        required: "Por favor ingrese la dirección.",
      },
      nuevoNombreUsuarioClienteIndividual: {
        required: "Por favor ingrese el nombre de usuario.",
      },
      nuevoPasswordClienteIndividual: {
        required: "Por favor ingrese el password.",
      },
      confirmarNuevoPasswordClienteIndividual: {
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
