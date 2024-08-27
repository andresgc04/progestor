function saveNewResourcesMaterial() {
  let newResourcesMaterialFormData = new FormData(
    $("#newResourcesMaterialForm")[0]
  );

  $.ajax({
    url: "../../controller/RecursosMaterialesProyectosObrasCivilesController.php?op=registrar_recursos_materiales_proyectos_obras_civiles",
    type: "POST",
    data: newResourcesMaterialFormData,
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        position: "center",
        icon: "success",
        title: "Recurso Material Del Proyecto Registrado Correctamente",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
      }).then(
        (willClose = () => {
          $("#addResourceMaterialProyectoObraCivilID").val("");

          getSelectListProjectPhasesOptions(
            "../../controller/FasesProyectosController.php?op=obtener_listado_opciones_fases_proyectos",
            "#faseProyectoIDRecursoMaterial"
          );

          getSelectListSuppliersOptions(
            "../../controller/ProveedoresController.php?op=obtener_listado_opciones_proveedores",
            "#proveedorID"
          );

          getSelectListTypesMaterialResourcesOptions(
            "../../controller/TiposRecursosMaterialesController.php?op=obtener_listado_opciones_tipos_recursos_materiales",
            "#tipoRecursoMaterialID"
          );

          const tipoRecursoMaterialIDInput = document.getElementById(
            "tipoRecursoMaterialID"
          );
          tipoRecursoMaterialIDInput.onchange = function (event) {
            const proveedorID = document.getElementById("proveedorID").value;
            const tipoRecursoMaterialID = event.target.value;

            getSelectListMaterialResourcesSuppliersOptionsByProveedorIDAndTipoRecursoMaterialID(
              "../../controller/RecursosMaterialesProveedoresController.php?op=obtener_listado_opciones_recursos_materiales_proveedores_por_proveedor_ID_tipo_recurso_material_ID",
              proveedorID,
              tipoRecursoMaterialID,
              "#recursoMaterialID"
            );
          };

          $("#unidadMedidaRecursoMaterial").val("");
          $("#cantidadRecursosMateriales").val("");
          $("#costoRecursoMaterial").val("");
          $("#subTotalRecursoMaterial").val("");
          $("#itbisRecursoMaterial").val("");
          $("#costoTotalRecursoMaterial").val("");

          $("#newResourcesMaterialFormModal").modal("hide");
          $("#listadoRecursosMaterialesProyectosObrasCivilesDataTable")
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
      saveNewResourcesMaterial();
    },
  });

  $("#newResourcesMaterialForm").validate({
    rules: {
      faseProyectoIDRecursoMaterial: {
        required: true,
      },
      proveedorID: {
        required: true,
      },
      tipoRecursoMaterialID: {
        required: true,
      },
      recursoMaterialID: {
        required: true,
      },
      cantidadRecursosMateriales: {
        required: true,
      },
    },
    messages: {
      faseProyectoIDRecursoMaterial: {
        required: "Por favor seleccione la fase del proyecto.",
      },
      proveedorID: {
        required: "Por favor seleccione el proveedor.",
      },
      tipoRecursoMaterialID: {
        required: "Por favor seleccione el tipo de recurso material.",
      },
      recursoMaterialID: {
        required: "Por favor seleccione el recurso material.",
      },
      cantidadRecursosMateriales: {
        required:
          "Por favor ingrese la cantidad a necesitar de este recurso material.",
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
