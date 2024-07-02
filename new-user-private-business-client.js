function saveNewUserPrivateBusinessClient() {
  let newUserPrivateBusinessClientFormData = new FormData(
    $("#newUserPrivateBusinessClientForm")[0]
  );

  $.ajax({
    url: "controller/UsuariosController.php?op=registrar_usuarios_clientes_empresas_privadas",
    type: "POST",
    data: newUserPrivateBusinessClientFormData,
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        position: "center",
        icon: "success",
        title: "Usuario Cliente Empresa Privada Registrada Correctamente",
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
      saveNewUserPrivateBusinessClient();
    },
  });

  $("#newUserPrivateBusinessClientForm").validate({
    rules: {
      nombreEmpresaClienteEmpresa: {
        required: true,
      },
      rncClienteEmpresa: {
        required: true,
      },
      tipoClienteIDClienteEmpresa: {
        required: true,
      },
      sectorClienteEmpresa: {
        required: true,
      },
      nombreContactoClienteEmpresa: {
        required: true,
      },
      cargoContactoClienteEmpresa: {
        required: true,
      },
      telefonoClienteEmpresa: {
        required: true,
      },
      correoElectronicoClienteEmpresa: {
        required: true,
      },
      paisIDClienteEmpresa: {
        required: true,
      },
      provinciaIDClienteEmpresa: {
        required: true,
      },
      ciudadIDClienteEmpresa: {
        required: true,
      },
      direccionClienteEmpresa: {
        required: true,
      },
      nuevoNombreUsuarioClienteEmpresa: {
        required: true,
      },
      nuevoPasswordClienteEmpresa: {
        required: true,
      },
      confirmarNuevoPasswordClienteEmpresa: {
        required: true,
      },
    },
    messages: {
      nombreEmpresaClienteEmpresa: {
        required: "Por favor ingrese el nombre de la empresa.",
      },
      rncClienteEmpresa: {
        required: "Por favor ingrese el rnc de la empresa.",
      },
      tipoClienteIDClienteEmpresa: {
        required: "Por favor seleccione el tipo de cliente.",
      },
      sectorClienteEmpresa: {
        required: "Por favor ingrese el sector a la que pertenece la empresa.",
      },
      nombreContactoClienteEmpresa: {
        required: "Por favor ingrese el nombre del contacto.",
      },
      cargoContactoClienteEmpresa: {
        required: "Por favor ingrese el nombre del cargo de la empresa.",
      },
      telefonoClienteEmpresa: {
        required: "Por favor ingrese el télefono.",
      },
      correoElectronicoClienteEmpresa: {
        required: "Por favor ingrese el correo electronico.",
      },
      paisIDClienteEmpresa: {
        required: "Por favor seleccione el país.",
      },
      provinciaIDClienteEmpresa: {
        required: "Por favor seleccione la provincia.",
      },
      ciudadIDClienteEmpresa: {
        required: "Por favor seleccione la ciudad.",
      },
      direccionClienteEmpresa: {
        required: "Por favor ingrese la dirección.",
      },
      nuevoNombreUsuarioClienteEmpresa: {
        required: "Por favor ingrese el nombre de usuario.",
      },
      nuevoPasswordClienteEmpresa: {
        required: "Por favor ingrese el password.",
      },
      confirmarNuevoPasswordClienteEmpresa: {
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
