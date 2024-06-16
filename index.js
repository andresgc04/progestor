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

  //Initialize InputMask:
  $("[data-mask]").inputmask();

  //Initialize Date picker:
  $("#fechaNacimiento").datetimepicker({
    format: "L",
  });

  getSelectListTypesClientsOptions(
    "controller/TiposClientesController.php?op=obtener_listado_opciones_tipos_clientes",
    "#tipoClienteID"
  );

  getSelectListSexOptions(
    "controller/SexosController.php?op=obtener_listado_opciones_sexos",
    "#sexoID"
  );

  getSelectListNationalitiesOptions(
    "controller/NacionalidadesController.php?op=obtener_listado_opciones_nacionalidades",
    "#nacionalidadID"
  );

  getSelectListCountriesOptions(
    "controller/PaisesController.php?op=obtener_listado_opciones_paises",
    "#paisID"
  );
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
