function saveNewTypesSuppliers() {
  let newTypesSuppliersFormData = new FormData($("#newTypesSuppliersForm")[0]);

  $.ajax({
    url: "../../controller/TiposProveedoresController.php?op=registrar_tipos_proveedores",
    type: "POST",
    data: newTypesSuppliersFormData,
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        position: "center",
        icon: "success",
        title: "Tipo De Proveedor Registrado Correctamente",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
      }).then(
        (willClose = () => {
          $("#tipoProveedor").val("");

          $("#newTypesSuppliersFormModal").modal("hide");
          $("#listadoTiposProveedoresDataTable").DataTable().ajax.reload();
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
      saveNewTypesSuppliers();
    },
  });

  $("#newTypesSuppliersForm").validate({
    rules: {
      tipoProveedor: {
        required: true,
      },
    },
    messages: {
      tipoProveedor: {
        required: "Por favor ingrese el tipo de proveedor.",
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
