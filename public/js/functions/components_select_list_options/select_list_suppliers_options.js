const getSelectListSuppliersOptions = (urlController, inputFieldID) => {
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

const getSelectListSuppliersOptionsByProveedorID = (
  urlController,
  proveedorID,
  inputFieldID
) => {
  $.post(urlController, { proveedorID: proveedorID })
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
