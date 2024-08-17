const getSelectListMaterialResourcesOptionsByTipoRecursoMaterialID = (
  urlController,
  tipoRecursoMaterialID,
  inputFieldID
) => {
  $.post(urlController, { tipoRecursoMaterialID: tipoRecursoMaterialID })
    .done(function (data, status) {
      $(inputFieldID).html(data);
    })
    .fail(function (data, status) {
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
    });
};
