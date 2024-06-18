navLinkPrimary("navLinkHomeEmployees");

setContentHeaderTitle("Registrar Nuevo Empleado");

setBreadCrumbContentHeaderTitle("../home-employees/", "Listado De Empleados");

setBreadCrumbContentHeaderSubTitle("Registrar Nuevo Empleado");

(function () {
  //Initialize Select2 Elements:
  initializeSelect2Elements();

  //Initialize InputMask:
  $("[data-mask]").inputmask();

  //Initialize Date picker:
  $("#fechaNacimiento").datetimepicker({
    format: "YYYY/MM/DD",
  });

  $("#fechaContratacion").datetimepicker({
    format: "YYYY/MM/DD",
  });

  getSelectListSexOptions(
    "../../controller/SexosController.php?op=obtener_listado_opciones_sexos",
    "#sexoID"
  );

  getSelectListNationalitiesOptions(
    "../../controller/NacionalidadesController.php?op=obtener_listado_opciones_nacionalidades",
    "#nacionalidadID"
  );

  getSelectListCountriesOptions(
    "../../controller/PaisesController.php?op=obtener_listado_opciones_paises",
    "#paisID"
  );
})();
