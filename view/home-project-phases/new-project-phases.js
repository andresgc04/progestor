function saveNewProjectPhases() {
  let newProjectPhasesFormData = new FormData($("#newProjectPhasesForm")[0]);

  $.ajax({
    url: "../../controller/FasesProyectosController.php?op=registrar_fases_proyectos",
    type: "POST",
    data: newProjectPhasesFormData,
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        position: "center",
        icon: "success",
        title: "Fase De Proyectos Registrado Correctamente",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
      }).then(
        (willClose = () => {
          $("#faseProyecto").val("");

          $("#newProjectPhasesFormModal").modal("hide");
          $("#listadoFasesProyectosDataTable").DataTable().ajax.reload();
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
      saveNewProjectPhases();
    },
  });

  $("#newProjectPhasesForm").validate({
    rules: {
      faseProyecto: {
        required: true,
      },
    },
    messages: {
      faseProyecto: {
        required: "Por favor ingrese el nombre de la fase de proyectos.",
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
