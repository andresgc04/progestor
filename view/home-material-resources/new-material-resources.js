function saveNewMaterialResources() {
  let newMaterialResourcesFormData = new FormData(
    $("#newMaterialResourcesForm")[0]
  );

  $.ajax({
    url: "../../controller/RecursosMaterialesController.php?op=registrar_recursos_materiales",
    type: "POST",
    data: newMaterialResourcesFormData,
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        position: "center",
        icon: "success",
        title: "Recurso Material Registrado Correctamente",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
      }).then(
        (willClose = () => {
          getSelectListTypesMaterialResourcesOptions(
            "../../controller/TiposRecursosMaterialesController.php?op=obtener_listado_opciones_tipos_recursos_materiales",
            "#tipoRecursoMaterialID"
          );

          $("#nombreRecursoMaterial").val("");

          $("#newMaterialResourcesFormModal").modal("hide");
          $("#listadoRecursosMaterialesDataTable").DataTable().ajax.reload();
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
          $("#tipoRecursoMaterialID").html("");
          $("#nombreRecursoMaterial").val("");

          window.location.reload();
        })
      );
    },
  });
}

$(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      saveNewMaterialResources();
    },
  });

  $("#newMaterialResourcesForm").validate({
    rules: {
      tipoRecursoMaterialID: {
        required: true,
      },
      nombreRecursoMaterial: {
        required: true,
      },
    },
    messages: {
      tipoRecursoMaterialID: {
        required: "Por favor seleccione el tipo de recurso material.",
      },
      nombreRecursoMaterial: {
        required: "Por favor ingrese el nombre del recurso material.",
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
