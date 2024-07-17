const getSelectListCategoriesTypesProjectsCivilWorksOptionsByTipoProyectoObraCivilID =
  (urlController, tipoProyectoObraCivilID, inputFieldID) => {
    $.post(urlController, { tipoProyectoObraCivilID: tipoProyectoObraCivilID })
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

const getSelectListCategoriesTypesProjectsCivilWorksOptionsByCategoriaTipoProyectoObraCivilIDAndTipoProyectoObraCivilID =
  (
    urlController,
    categoriaTipoProyectoObraCivilID,
    tipoProyectoObraCivilID,
    inputFieldID
  ) => {
    $.post(urlController, {
      categoriaTipoProyectoObraCivilID: categoriaTipoProyectoObraCivilID,
      tipoProyectoObraCivilID: tipoProyectoObraCivilID,
    })
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
