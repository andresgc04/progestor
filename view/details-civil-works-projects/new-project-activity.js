function saveNewProjectActivity() {
  let newProjectActivityFormData = new FormData(
    $("#newProjectActivityForm")[0]
  );

  $.ajax({
    url: "../../controller/ActividadesProyectosObrasCivilesController.php?op=registrar_actividades_proyectos_obras_civiles",
    type: "POST",
    data: newProjectActivityFormData,
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        position: "center",
        icon: "success",
        title: "Actividad Del Proyecto Registrado Correctamente",
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
      saveNewProjectActivity();
    },
  });

  $("#newProjectActivityForm").validate({
    rules: {
      faseProyectoID: {
        required: true,
      },
      tipoActividadID: {
        required: true,
      },
      actividadProyectoID: {
        required: true,
      },
      cantidadActividades: {
        required: true,
      },
    },
    messages: {
      faseProyectoID: {
        required: "Por favor seleccione la fase del proyecto.",
      },
      tipoActividadID: {
        required: "Por favor seleccione el tipo de actividad del proyecto.",
      },
      actividadProyectoID: {
        required: "Por favor seleccione la actividad del proyecto.",
      },
      cantidadActividades: {
        required: "Por favor ingrese la cantidad de esta actvidad a necesitar.",
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
