function updateTypesSuppliers() {
  let updateTypesSuppliersFormData = new FormData(
    $("#updateTypesSuppliersForm")[0]
  );

  $.ajax({
    url: "../../controller/TiposProveedoresController.php?op=modificar_tipos_proveedores_por_tipo_proveedor_ID",
    type: "POST",
    data: updateTypesSuppliersFormData,
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        position: "center",
        icon: "success",
        title: "Tipo De Proveedor Modificado Correctamente",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
      }).then(
        (willClose = () => {
          $("#tipoProveedorID").val("");
          $("#modificarTipoProveedor").val("");

          $("#updateTypesSuppliersFormModal").modal("hide");

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
      updateTypesSuppliers();
    },
  });

  $("#updateTypesSuppliersForm").validate({
    rules: {
      modificarTipoProveedor: {
        required: true,
      },
    },
    messages: {
      modificarTipoProveedor: {
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
