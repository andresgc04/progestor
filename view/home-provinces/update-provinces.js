function updateProvince() {
  let updateProvinceFormData = new FormData($("#updateProvinceForm")[0]);

  $.ajax({
    url: "../../controller/ProvinciasController.php?op=modificar_provincias_por_pais_ID_provincia_ID",
    type: "POST",
    data: updateProvinceFormData,
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        position: "center",
        icon: "success",
        title: "Provincia Modificada Correctamente",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
      }).then(
        (willClose = () => {
          getSelectListCountriesOptions(
            "../../controller/PaisesController.php?op=obtener_listado_opciones_paises",
            "#paisID"
          );

          $("#modificarNombreProvincia").val("");

          $("#updateProvinceFormModal").modal("hide");
          $("#listadoProvinciasDataTable").DataTable().ajax.reload();
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
      updateProvince();
    },
  });

  $("#updateProvinceForm").validate({
    rules: {
      modificarPaisID: {
        required: true,
      },
      modificarNombreProvincia: {
        required: true,
      },
    },
    messages: {
      modificarPaisID: {
        required: "Por favor seleccione el país.",
      },
      modificarNombreProvincia: {
        required: "Por favor ingrese el nombre de la provincia.",
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
