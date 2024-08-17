function saveNewMaterialResourcesSuppliers() {
  let newMaterialResourcesSuppliersFormData = new FormData(
    $("#newMaterialResourcesSuppliersForm")[0]
  );

  $.ajax({
    url: "../../controller/RecursosMaterialesProveedoresController.php?op=registrar_recursos_materiales_proveedores",
    type: "POST",
    data: newMaterialResourcesSuppliersFormData,
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        position: "center",
        icon: "success",
        title: "Recurso Material Por Proveedores Registrado Correctamente",
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
      saveNewMaterialResourcesSuppliers();
    },
  });

  $("#newMaterialResourcesSuppliersForm").validate({
    rules: {
      tipoRecursoMaterialID: {
        required: true,
      },
      recursoMaterialID: {
        required: true,
      },
      proveedorID: {
        required: true,
      },
      costoRecursoMaterial: {
        required: true,
      },
    },
    messages: {
      tipoRecursoMaterialID: {
        required: "Por favor seleccione el tipo de recurso material.",
      },
      recursoMaterialID: {
        required: "Por favor seleccione el recurso material.",
      },
      proveedorID: {
        required: "Por favor seleccione el proveedor.",
      },
      costoRecursoMaterial: {
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
