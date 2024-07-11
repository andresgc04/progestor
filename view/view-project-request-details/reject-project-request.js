function rejectProjectRequest() {
  Swal.fire({
    title: "¿Deseas rechazar esta solicitud de proyecto seleccionado?",
    inputAttributes: {
      autocapitalize: "off",
    },
    showCancelButton: true,
    confirmButtonText: "Rechazar",
    showLoaderOnConfirm: true,
    preConfirm: () => {
      let projectRequestDetailsFormData = new FormData(
        $("#projectRequestDetailsForm")[0]
      );

      $.ajax({
        url: "../../controller/SolicitudesProyectosController.php?op=modificar_solicitud_proyecto_cambiar_estado_pendiente_rechazado_por_solicitud_proyecto_ID",
        type: "POST",
        data: projectRequestDetailsFormData,
        contentType: false,
        processData: false,
        success: function (data) {
          Swal.fire({
            position: "center",
            icon: "success",
            title: "Solicitud De Proyecto Rechazado Correctamente",
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
