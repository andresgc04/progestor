function saveNewLaborResources() {
  let newLaborResourcesFormData = new FormData($("#newLaborResourcesForm")[0]);

  $.ajax({
    url: "../../controller/RecursosManosObrasProyectosObrasCivilesController.php?op=registrar_recursos_manos_obras_proyectos_obras_civiles",
    type: "POST",
    data: newLaborResourcesFormData,
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        position: "center",
        icon: "success",
        title: "Recurso De Mano De Obra Del Proyecto Registrado Correctamente",
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
      saveNewLaborResources();
    },
  });

  $("#newLaborResourcesForm").validate({
    rules: {
      faseProyectoIDRecursoManoObra: {
        required: true,
      },
      recursoManoObraID: {
        required: true,
      },
      cantidadRecursosManosObras: {
        required: true,
      },
    },
    messages: {
      faseProyectoIDRecursoManoObra: {
        required: "Por favor seleccione la fase del proyecto.",
      },
      recursoManoObraID: {
        required:
          "Por favor seleccione el recurso de mano de obra del proyecto.",
      },
      cantidadRecursosManosObras: {
        required:
          "Por favor ingrese la cantidad de este recurso de mano de obra a necesitar.",
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
