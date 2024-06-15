const openNewUserClientFormModal = () => {
  $("#newUserClientFormModal").modal("show");
};

const newUserClientButton = document.getElementById("newUserClientButton");
newUserClientButton.addEventListener("click", () => {
  openNewUserClientFormModal();
});

(function () {
  //Initialize Select2 Elements:
  initializeSelect2Elements();

  getSelectListCountriesOptions(
    "controller/PaisesController.php?op=obtener_listado_opciones_paises",
    "#paisID"
  );

  $("[data-mask]").inputmask();

  //Date picker
  $("#fechaNacimiento").datetimepicker({
    format: "L",
  });
})();

const paisSelectInput = document.getElementById("paisID");
paisSelectInput.onchange = (event) => {
  const paisID = event.target.value;

  getSelectListProvincesOptionsByPaisID(
    "controller/ProvinciasController.php?op=obtener_listado_opciones_provincias_por_paisID",
    paisID,
    "#provinciaID"
  );
};
