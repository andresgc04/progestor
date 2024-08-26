function saveNewProjectActivities() {
  let newProjectActivitiesFormData = new FormData(
    $("#newProjectActivitiesForm")[0]
  );

  $.ajax({
    url: "../../controller/ActividadesProyectosController.php?op=registrar_actividades_proyectos",
    type: "POST",
    data: newProjectActivitiesFormData,
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        position: "center",
        icon: "success",
        title: "Actividad De Proyectos Registrada Correctamente",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
      }).then(
        (willClose = () => {
          getSelectListTypesActivitiesOptions(
            "../../controller/TiposActividadesController.php?op=obtener_listado_opciones_tipos_actividades",
            "#tipoActividadID"
          );

          getSelectListUnitsMeasurementsOptions(
            "../../controller/UnidadesMedidasController.php?op=obtener_listado_opciones_unidades_medidas",
            "#unidadMedidaID"
          );

          $("#actividadProyecto").val("");

          $("#costoActividadProyecto").val("");

          $("#newProjectActivitiesFormModal").modal("hide");

          $("#listadoActividadesProyectosDataTable").DataTable().ajax.reload();
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
      saveNewProjectActivities();
    },
  });

  $("#newProjectActivitiesForm").validate({
    rules: {
      tipoActividadID: {
        required: true,
      },
      actividadProyecto: {
        required: true,
      },
      unidadMedidaID: {
        required: true,
      },
      costoActividadProyecto: {
        required: true,
      },
    },
    messages: {
      tipoActividadID: {
        required: "Por favor seleccione el tipo de actividad.",
      },
      actividadProyecto: {
        required:
          "Por favor ingrese el nombre de la actividad de los proyectos.",
      },
      unidadMedidaID: {
        required: "Por favor seleccione la unidad de medida.",
      },
      costoActividadProyecto: {
        required:
          "Por favor ingrese el costo de la actividad de los proyectos.",
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
