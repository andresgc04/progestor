function approveProjectRequest() {
  Swal.fire({
    title: "¿Deseas aprobar esta solicitud de proyecto seleccionado?",
    inputAttributes: {
      autocapitalize: "off",
    },
    showCancelButton: true,
    confirmButtonText: "Aprobar",
    showLoaderOnConfirm: true,
    preConfirm: () => {
      let projectRequestDetailsFormData = new FormData(
        $("#projectRequestDetailsForm")[0]
      );

      $.ajax({
        url: "../../controller/SolicitudesProyectosController.php?op=modificar_solicitud_proyecto_cambiar_estado_pendiente_aprobado_por_solicitud_proyecto_ID",
        type: "POST",
        data: projectRequestDetailsFormData,
        contentType: false,
        processData: false,
        success: function (data) {
          Swal.fire({
            position: "center",
            icon: "success",
            title: "Solicitud De Proyecto Aprobado Correctamente",
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
    },
  });
}
