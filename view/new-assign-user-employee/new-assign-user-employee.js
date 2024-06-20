navLinkPrimary("navLinkUsers");

navLinkSecondary("navLinkHomeAssignUserEmployee");

setContentHeaderTitle("Asignar Usuario A Empleado");

setBreadCrumbContentHeaderTitle(
  "../home-assign-user-employee/",
  "Listado De Usuarios Asignados A Empleados"
);

setBreadCrumbContentHeaderSubTitle("Asignar Usuario A Empleado");

(function () {
  //Initialize Select2 Elements:
  initializeSelect2Elements();

  getSelectListEmployeesOptions(
    "../../controller/EmpleadosController.php?op=obtener_listado_opciones_empleados",
    "#empleadoID"
  );

  getSelectListRolesOptions(
    "../../controller/RolesController.php?op=obtener_listado_opciones_roles",
    "#rolID"
  );
})();
