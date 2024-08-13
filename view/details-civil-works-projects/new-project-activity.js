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
          $("#addActivityProyectoObraCivilID").val("");
          $("#tipoActividadID").val("");
          $("#nombreActividad").val("");
          $("#descripcionActividad").val("");
          $("#costoActividad").val("");

          $("#newProjectActivityFormModal").modal("hide");
          $("#listadoActividadesProyectosObrasCivilesDataTable")
            .DataTable()
            .ajax.reload();
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
      tipoActividadID: {
        required: true,
      },
      nombreActividad: {
        required: true,
      },
      descripcionActividad: {
        required: true,
      },
      costoActividad: {
        required: true,
      },
    },
    messages: {
      tipoActividadID: {
        required: "Por favor seleccione el tipo de actividad.",
      },
      nombreActividad: {
        required: "Por favor ingrese el nombre de la actividad.",
      },
      descripcionActividad: {
        required: "Por favor ingrese la descripcion de la actividad.",
      },
      costoActividad: {
        required: "Por favor ingrese el costo de la actividad.",
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
