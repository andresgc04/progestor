const getSelectListTypesActivitiesOptions = (urlController, inputFieldID) => {
  $.post(urlController)
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

const getSelectListTypesActivitiesOptionsByTipoActividadID = (
  urlController,
  tipoActividadID,
  inputFieldID
) => {
  $.post(urlController, { tipoActividadID: tipoActividadID })
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
