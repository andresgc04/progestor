function updateMaterialResources() {
  let updateMaterialResourcesFormData = new FormData(
    $("#updateMaterialResourcesForm")[0]
  );

  $.ajax({
    url: "../../controller/RecursosMaterialesController.php?op=modificar_recursos_materiales",
    type: "POST",
    data: updateMaterialResourcesFormData,
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        position: "center",
        icon: "success",
        title: "Recurso Material Modificado Correctamente",
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

$(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      updateMaterialResources();
    },
  });

  $("#updateMaterialResourcesForm").validate({
    rules: {
      modificarTipoRecursoMaterialID: {
        required: true,
      },
      modificarNombreRecursoMaterial: {
        required: true,
      },
      modificarUnidadMedidaID: {
        required: true,
      },
    },
    messages: {
      modificarTipoRecursoMaterialID: {
        required: "Por favor seleccione el tipo de recurso material.",
      },
      modificarNombreRecursoMaterial: {
        required: "Por favor ingrese el nombre del recurso material.",
      },
      modificarUnidadMedidaID: {
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
