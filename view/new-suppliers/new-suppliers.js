navLinkSecondary("navLinkHomeSuppliers");

setContentHeaderTitle("Registrar Nuevo Proveedor");

setBreadCrumbContentHeaderTitle("../home-suppliers/", "Listado De Proveedores");

setBreadCrumbContentHeaderSubTitle("Registrar Nuevo proveedor");

(function () {
  //Initialize Select2 Elements:
  initializeSelect2Elements();

  //Initialize InputMask:
  $("[data-mask]").inputmask();

  getSelectListTypesSuppliersOptions(
    "../../controller/TiposProveedoresController.php?op=obtener_listado_opciones_tipos_proveedores",
    "#tipoProveedorID"
  );

  getSelectListPaymentConditionsOptions(
    "../../controller/CondicionesPagosController.php?op=obtener_listado_opciones_condiciones_pagos",
    "#condicionPagoID"
  );

  getSelectListCountriesOptions(
    "../../controller/PaisesController.php?op=obtener_listado_opciones_paises",
    "#paisID"
  );
})();

const paisSelectInput = document.getElementById("paisID");
paisSelectInput.onchange = (event) => {
  const paisID = event.target.value;

  getSelectListProvincesOptionsByPaisID(
    "../../controller/ProvinciasController.php?op=obtener_listado_opciones_provincias_por_paisID",
    paisID,
    "#provinciaID"
  );
};

const provinciaSelectInput = document.getElementById("provinciaID");
provinciaSelectInput.onchange = (event) => {
  const paisID = document.getElementById("paisID").value;
  const provinciaID = event.target.value;

  getSelectListCitiesOptionsByPaisIDAndProvinciaID(
    "../../controller/CiudadesController.php?op=obtener_listado_opciones_ciudades_por_paisID_provinciaID",
    paisID,
    provinciaID,
    "#ciudadID"
  );
};
