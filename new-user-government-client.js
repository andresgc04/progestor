function saveNewUserGovernmentClient() {
  let newUserGovernmentClientFormData = new FormData(
    $("#newUserGovernmentClientForm")[0]
  );

  $.ajax({
    url: "controller/UsuariosController.php?op=registrar_usuarios_clientes_empresas_gubernamentales",
    type: "POST",
    data: newUserGovernmentClientFormData,
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        position: "center",
        icon: "success",
        title: "Usuario Cliente Empresa Gubernamental Registrada Correctamente",
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
      saveNewUserGovernmentClient();
    },
  });

  $("#newUserGovernmentClientForm").validate({
    rules: {
      nombreEmpresaClienteEmpresaGubernamental: {
        required: true,
      },
      rncClienteEmpresaGubernamental: {
        required: true,
      },
      tipoClienteIDClienteEmpresaGubernamental: {
        required: true,
      },
      sectorClienteEmpresaGubernamental: {
        required: true,
      },
      nombreContactoClienteEmpresaGubernamental: {
        required: true,
      },
      cargoContactoClienteEmpresaGubernamental: {
        required: true,
      },
      telefonoClienteEmpresaGubernamental: {
        required: true,
      },
      correoElectronicoClienteEmpresaGubernamental: {
        required: true,
      },
      paisIDClienteEmpresaGubernamental: {
        required: true,
      },
      provinciaIDClienteEmpresaGubernamental: {
        required: true,
      },
      ciudadIDClienteEmpresaGubernamental: {
        required: true,
      },
      direccionClienteEmpresaGubernamental: {
        required: true,
      },
      nuevoNombreUsuarioClienteEmpresaGubernamental: {
        required: true,
      },
      nuevoPasswordClienteEmpresaGubernamental: {
        required: true,
      },
      confirmarNuevoPasswordClienteEmpresaGubernamental: {
        required: true,
      },
    },
    messages: {
      nombreEmpresaClienteEmpresaGubernamental: {
        required: "Por favor ingrese el nombre de la empresa.",
      },
      rncClienteEmpresaGubernamental: {
        required: "Por favor ingrese el rnc de la empresa.",
      },
      tipoClienteIDClienteEmpresaGubernamental: {
        required: "Por favor seleccione el tipo de cliente.",
      },
      sectorClienteEmpresaGubernamental: {
        required: "Por favor ingrese el sector a la que pertenece la empresa.",
      },
      nombreContactoClienteEmpresaGubernamental: {
        required: "Por favor ingrese el nombre del contacto.",
      },
      cargoContactoClienteEmpresaGubernamental: {
        required: "Por favor ingrese el nombre del cargo de la empresa.",
      },
      telefonoClienteEmpresaGubernamental: {
        required: "Por favor ingrese el télefono.",
      },
      correoElectronicoClienteEmpresaGubernamental: {
        required: "Por favor ingrese el correo electronico.",
      },
      paisIDClienteEmpresaGubernamental: {
        required: "Por favor seleccione el país.",
      },
      provinciaIDClienteEmpresaGubernamental: {
        required: "Por favor seleccione la provincia.",
      },
      ciudadIDClienteEmpresaGubernamental: {
        required: "Por favor seleccione la ciudad.",
      },
      direccionClienteEmpresaGubernamental: {
        required: "Por favor ingrese la dirección.",
      },
      nuevoNombreUsuarioClienteEmpresaGubernamental: {
        required: "Por favor ingrese el nombre de usuario.",
      },
      nuevoPasswordClienteEmpresaGubernamental: {
        required: "Por favor ingrese el password.",
      },
      confirmarNuevoPasswordClienteEmpresaGubernamental: {
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
