function saveNewLaborResources() {
  let newLaborResourcesFormData = new FormData($("#newLaborResourcesForm")[0]);

  $.ajax({
    url: "../../controller/RecursosManosObrasController.php?op=registrar_recursos_manos_obras",
    type: "POST",
    data: newLaborResourcesFormData,
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        position: "center",
        icon: "success",
        title: "Recurso De Mano De Obra Registrado Correctamente",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
      }).then(
        (willClose = () => {
          $("#recursoManoObra").val("");

          getSelectListTypesPaymentsOptions(
            "../../controller/TiposPagosController.php?op=obtener_listado_opciones_tipos_pagos",
            "#tipoPagoID"
          );

          $("#costoPagoRecursoManoObra").val("");

          $("#newLaborResourcesFormModal").modal("hide");
          $("#listadoRecursosManosObrasDataTable").DataTable().ajax.reload();
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
      saveNewLaborResources();
    },
  });

  $("#newLaborResourcesForm").validate({
    rules: {
      recursoManoObra: {
        required: true,
      },
      tipoPagoID: {
        required: true,
      },
      costoPagoRecursoManoObra: {
        required: true,
      },
    },
    messages: {
      recursoManoObra: {
        required: "Por favor ingrese el nombre del recurso de mano de obra.",
      },
      tipoPagoID: {
        required: "Por favor seleccione el tipo de pago.",
      },
      costoPagoRecursoManoObra: {
        required: "Por favor ingrese el costo del pago del recurso mano de obra.",
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
