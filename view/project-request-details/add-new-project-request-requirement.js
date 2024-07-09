function addNewProjectRequestRequirement() {
  let addNewProjectRequestRequirementFormData = new FormData(
    $("#addNewProjectRequestRequirementForm")[0]
  );

  $.ajax({
    url: "../../controller/SolicitudesProyectosController.php?op=agregar_nueva_descripcion_requerimiento_solicitud_proyecto",
    type: "POST",
    data: addNewProjectRequestRequirementFormData,
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        position: "center",
        icon: "success",
        title: "Requerimiento De Solicitud De Proyecto Agregado Correctamente",
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

function validateAddNewProjectRequestRequirement() {
  $("#addNewProjectRequestRequirementForm").validate({
    rules: {
      agregarDescripcionRequerimiento: {
        required: true,
      },
    },
    messages: {
      agregarDescripcionRequerimiento: {
        required: "Por favor ingrese la descripción del requerimiento.",
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
    submitHandler: function () {
      addNewProjectRequestRequirement();
    },
  });

  if ($("#addNewProjectRequestRequirementForm").valid()) {
    $("#addNewProjectRequestRequirementForm").submit();
  }
}
