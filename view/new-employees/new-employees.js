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

  getSelectListMaritalStatusesOptions(
    "../../controller/EstadosCivilesController.php?op=obtener_listado_opciones_estados_civiles",
    "#estadoCivilID"
  );

  getSelectListNationalitiesOptions(
    "../../controller/NacionalidadesController.php?op=obtener_listado_opciones_nacionalidades",
    "#nacionalidadID"
  );

  getSelectListCountriesOptions(
    "../../controller/PaisesController.php?op=obtener_listado_opciones_paises",
    "#paisID"
  );

  getSelectListPositionsOptions(
    "../../controller/PuestosController.php?op=obtener_listado_opciones_puestos",
    "#puestoID"
  );

  getSelectListDepartmentOptions(
    "../../controller/DepartamentosController.php?op=obtener_listado_opciones_departamentos",
    "#departamentoID"
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

const departamentoSelectInput = document.getElementById("departamentoID");
departamentoSelectInput.onchange = (event) => {
  const departamentoID = event.target.value;

  console.log(departamentoID);

  getSelectListSupervisorsOptionsByDepartamentoID(
    "../../controller/EmpleadosController.php?op=obtener_listado_opciones_supervisores_por_departamentoID",
    departamentoID,
    "#supervisorID"
  );
};
