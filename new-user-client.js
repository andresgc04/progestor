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
      nombreCliente: {
        required: true,
      },
      tipoDocumentoID: {
        required: true,
      },
      documentoIdentidad: {
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
      nombreCliente: {
        required: "Por favor ingrese el nombre.",
      },
      tipoDocumentoID: {
        required: "Por favor seleccione el tipo de documento.",
      },
      documentoIdentidad: {
        required: "Por favor ingrese el documento de identidad.",
      },
      paisID: {
        required: "Por favor seleccione el pais.",
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
      nuevoNombreUsuario: {
        required: "Por favor ingrese el nombre de usuario.",
      },
      nuevoPassword: {
        required: "Por favor ingrese el password.",
      },
      confirmarNuevoPassword: {
        required: "Por favor ingrese la confirmación del password.",
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
