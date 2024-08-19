function updateMaterialResourcesSuppliers() {
  let updateMaterialResourcesSuppliersFormData = new FormData(
    $("#updateMaterialResourcesSuppliersForm")[0]
  );

  $.ajax({
    url: "../../controller/RecursosMaterialesProveedoresController.php?op=modificar_recursos_materiales_proveedores",
    type: "POST",
    data: updateMaterialResourcesSuppliersFormData,
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        position: "center",
        icon: "success",
        title: "Recurso Material Por Proveedores Modificado Correctamente",
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
      updateMaterialResourcesSuppliers();
    },
  });

  $("#updateMaterialResourcesSuppliersForm").validate({
    rules: {
      modificarTipoRecursoMaterialID: {
        required: true,
      },
      modificarRecursoMaterialID: {
        required: true,
      },
      modificarProveedorID: {
        required: true,
      },
      modificarCostoRecursoMaterial: {
        required: true,
      },
    },
    messages: {
      modificarTipoRecursoMaterialID: {
        required: "Por favor seleccione el tipo de recurso material.",
      },
      modificarRecursoMaterialID: {
        required: "Por favor seleccione el recurso material.",
      },
      modificarProveedorID: {
        required: "Por favor seleccione el proveedor.",
      },
      modificarCostoRecursoMaterial: {
        required: "Por favor ingrese el costo del recurso material.",
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
