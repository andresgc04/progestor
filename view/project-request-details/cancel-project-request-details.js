function cancelProjectRequestDetails() {
  let projectRequestDetailsFormData = new FormData(
    $("#projectRequestDetailsForm")[0]
  );

  $.ajax({
    url: "../../controller/SolicitudesProyectosController.php?op=modificar_solicitudes_proyectos_cambiar_estado_activo_cancelado_por_solicitud_proyecto_ID",
    type: "POST",
    data: projectRequestDetailsFormData,
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        position: "center",
        icon: "success",
        title: "Solicitud De Proyecto Cancelado Correctamente",
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

function validateCancelProjectRequestDetails() {
  $("#projectRequestDetailsForm").validate({
    rules: {
      descripcionProyecto: {
        required: true,
      },
      objetivoProyecto: {
        required: true,
      },
      presupuestoProyecto: {
        required: true,
      },
    },
    messages: {
      descripcionProyecto: {
        required: "Por favor ingrese la descripción del proyecto.",
      },
      objetivoProyecto: {
        required: "Por favor ingrese el objetivo del proyecto.",
      },
      presupuestoProyecto: {
        required: "Por favor ingrese el presupuesto del proyecto.",
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
      cancelProjectRequestDetails();
    },
  });

  if ($("#projectRequestDetailsForm").valid()) {
    $("#projectRequestDetailsForm").submit();
  }
}
