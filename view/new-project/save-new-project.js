function saveNewProject() {
  let newProjectFormData = new FormData($("#newProjectForm")[0]);

  $.ajax({
    url: "../../controller/ProyectosObrasCivilesController.php?op=registrar_proyectos_obras_civiles",
    type: "POST",
    data: newProjectFormData,
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        position: "center",
        icon: "success",
        title: "Proyecto Registrado Correctamente",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
      }).then(
        (willClose = () => {
          window.location.href = "../home-civil-works-projects/";
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
      saveNewProject();
    },
  });

  $("#newProjectForm").validate({
    rules: {
      tipoProyectoObraCivilID: {
        required: true,
      },
      categoriaTipoProyectoObraCivilID: {
        required: true,
      },
      responsableID: {
        required: true,
      },
      fechaInicioProyecto: {
        required: true,
      },
    },
    messages: {
      tipoProyectoObraCivilID: {
        required: "Por favor seleccione el tipo de proyecto.",
      },
      categoriaTipoProyectoObraCivilID: {
        required: "Por favor seleccione la categoría del tipo de proyecto.",
      },
      responsableID: {
        required: "Por favor seleccione al responsable correspondiente.",
      },
      fechaInicioProyecto: {
        required: "Por favor seleccione la fecha de inicio del proyecto",
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
