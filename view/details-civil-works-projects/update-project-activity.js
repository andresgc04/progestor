function updateProjectActivity() {
  let updateProjectActivityFormData = new FormData(
    $("#updateProjectActivityForm")[0]
  );

  $.ajax({
    url: "../../controller/ActividadesProyectosObrasCivilesController.php?op=modificar_actividades_proyectos_obras_civiles_por_actividad_proyecto_obra_civil_ID_proyecto_obra_civil_ID",
    type: "POST",
    data: updateProjectActivityFormData,
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        position: "center",
        icon: "success",
        title: "Actividad Del Proyecto Modificado Correctamente",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
      }).then(
        (willClose = () => {
          windows.location.reload();
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
      updateProjectActivity();
    },
  });

  $("#updateProjectActivityForm").validate({
    rules: {
      modifyTipoActividadID: {
        required: true,
      },
      modifyNombreActividad: {
        required: true,
      },
      modifyDescripcionActividad: {
        required: true,
      },
      modifyCostoActividad: {
        required: true,
      },
    },
    messages: {
      modifyTipoActividadID: {
        required: "Por favor seleccione el tipo de actividad.",
      },
      modifyNombreActividad: {
        required: "Por favor ingrese el nombre de la actividad.",
      },
      modifyDescripcionActividad: {
        required: "Por favor ingrese la descripcion de la actividad.",
      },
      modifyCostoActividad: {
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
