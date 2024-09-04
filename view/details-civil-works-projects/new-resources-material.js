function saveNewResourcesMaterial() {
  let newResourcesMaterialFormData = new FormData(
    $("#newResourcesMaterialForm")[0]
  );

  $.ajax({
    url: "../../controller/RecursosMaterialesProyectosObrasCivilesController.php?op=registrar_recursos_materiales_proyectos_obras_civiles",
    type: "POST",
    data: newResourcesMaterialFormData,
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        position: "center",
        icon: "success",
        title: "Recurso Material Del Proyecto Registrado Correctamente",
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
      saveNewResourcesMaterial();
    },
  });

  $("#newResourcesMaterialForm").validate({
    rules: {
      faseProyectoIDRecursoMaterial: {
        required: true,
      },
      proveedorID: {
        required: true,
      },
      tipoRecursoMaterialID: {
        required: true,
      },
      recursoMaterialID: {
        required: true,
      },
      cantidadRecursosMateriales: {
        required: true,
      },
    },
    messages: {
      faseProyectoIDRecursoMaterial: {
        required: "Por favor seleccione la fase del proyecto.",
      },
      proveedorID: {
        required: "Por favor seleccione el proveedor.",
      },
      tipoRecursoMaterialID: {
        required: "Por favor seleccione el tipo de recurso material.",
      },
      recursoMaterialID: {
        required: "Por favor seleccione el recurso material.",
      },
      cantidadRecursosMateriales: {
        required:
          "Por favor ingrese la cantidad a necesitar de este recurso material.",
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
