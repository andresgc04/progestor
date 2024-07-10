function updateProjectRequestRequirement() {
  let updateProjectRequestRequirementFormData = new FormData(
    $("#updateProjectRequestRequirementForm")[0]
  );

  $.ajax({
    url: "../../controller/SolicitudesProyectosController.php?op=modificar_requerimiento_solicitud_proyecto_por_solicitud_proyecto_ID_requerimiento_solicitud_proyecto_ID",
    type: "POST",
    data: updateProjectRequestRequirementFormData,
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        position: "center",
        icon: "success",
        title:
          "Requerimiento De Solicitud De Proyecto Modificado Correctamente",
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

function validateUpdateProjectRequestRequirement() {
  $("#updateProjectRequestRequirementForm").validate({
    rules: {
      modificarDescripcionRequerimiento: {
        required: true,
      },
    },
    messages: {
      modificarDescripcionRequerimiento: {
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
      updateProjectRequestRequirement();
    },
  });

  if ($("#updateProjectRequestRequirementForm").valid()) {
    $("#updateProjectRequestRequirementForm").submit();
  }
}
