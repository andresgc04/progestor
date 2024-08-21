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

          getSelectListUnitsMeasurementsOptions(
            "../../controller/UnidadesMedidasController.php?op=obtener_listado_opciones_unidades_medidas",
            "#unidadMedidaID"
          );

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
      unidadMedidaID: {
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
      unidadMedidaID: {
        required: "Por favor seleccione la unidad de medida.",
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
