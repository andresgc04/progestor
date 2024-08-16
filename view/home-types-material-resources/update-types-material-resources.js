function updateTypesMaterialResources() {
  let updateTypesMaterialResourcesFormData = new FormData(
    $("#updateTypesMaterialResourcesForm")[0]
  );

  $.ajax({
    url: "../../controller/TiposRecursosMaterialesController.php?op=modificar_tipos_recursos_materiales",
    type: "POST",
    data: updateTypesMaterialResourcesFormData,
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        position: "center",
        icon: "success",
        title: "Tipo De Recurso Material Modificado Correctamente",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
      }).then(
        (willClose = () => {
          $("#modificarNombreTipoRecursoMaterial").val("");

          $("#updateTypesMaterialResourcesFormModal").modal("hide");

          $("#listadoTiposRecursosMaterialesDataTable")
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
      updateTypesMaterialResources();
    },
  });

  $("#updateTypesMaterialResourcesForm").validate({
    rules: {
      modificarNombreTipoRecursoMaterial: {
        required: true,
      },
    },
    messages: {
      modificarNombreTipoRecursoMaterial: {
        required: "Por favor ingrese el nombre del tipo de recurso material.",
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
