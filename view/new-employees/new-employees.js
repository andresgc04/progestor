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

function calculateAge(fechaNacimientoValue) {
  console.log(fechaNacimientoValue);
  const ageDifference = Date.now() - fechaNacimientoValue;

  const ageDate = new Date(ageDifference);

  return Math.abs(ageDate.getUTCFullYear() - 1970);
}

const fechaNacimientoInput = document.getElementById("fechaNacimiento");
fechaNacimientoInput.onchange = function () {
  const fechaNacimientoInput = document.getElementById("fechaNacimiento");

  const fechaNacimientoValue = new Date(fechaNacimientoInput.value);

  const age = calculateAge(fechaNacimientoValue);

  const newEmployeeButton = document.getElementById("newEmployeeButton");

  if (age < 18) {
    Swal.fire({
      position: "center",
      icon: "warning",
      title: "El empleado es menor de edad!!",
      text: "Por favor intentelo de nuevo, con un empleado que no sea menor de edad.",
      showConfirmButton: false,
      timer: 2000,
      timerProgressBar: true,
    }).then(
      (willClose = () => {
        newEmployeeButton.style.display = "none";
      })
    );
  } else {
    newEmployeeButton.style.display = "block";
  }
};

function saveNewEmployee() {
  let newEmployeesFormData = new FormData($("#newEmployeesForm")[0]);

  $.ajax({
    url: "../../controller/EmpleadosController.php?op=registrar_empleado",
    type: "POST",
    data: newEmployeesFormData,
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        position: "center",
        icon: "success",
        title: "Empleado Registrado Correctamente",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
      }).then(
        (willClose = () => {
          window.location.href = "../home-employees/";
        })
      );
    },
    error: function (data) {
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
    },
  });
}

$(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      saveNewEmployee();
    },
  });

  $("#newEmployeesForm").validate({
    rules: {
      primerNombre: {
        required: true,
      },
      primerApellido: {
        required: true,
      },
      sexoID: {
        required: true,
      },
      estadoCivilID: {
        required: true,
      },
      cedula: {
        required: true,
      },
      fechaNacimiento: {
        required: true,
      },
      nacionalidadID: {
        required: true,
      },
      paisID: {
        required: true,
      },
      provinciaID: {
        required: true,
      },
      ciudadID: {
        required: true,
      },
      direccion: {
        required: true,
      },
      telefonoResidencial: {
        required: true,
      },
      telefonoCelular: {
        required: true,
      },
      correoElectronico: {
        required: true,
      },
      puestoID: {
        required: true,
      },
      departamentoID: {
        required: true,
      },
      salario: {
        required: true,
      },
      numeroSeguridadSocial: {
        required: true,
      },
      fechaContratacion: {
        required: true,
      },
    },
    messages: {
      primerNombre: {
        required: "Por favor ingrese el primer nombre.",
      },
      primerApellido: {
        required: "Por favor ingrese el primer apellido.",
      },
      sexoID: {
        required: "Por favor seleccione el sexo.",
      },
      estadoCivilID: {
        required: "Por favor seleccione el estado civil.",
      },
      cedula: {
        required: "Por favor ingrese la cedula.",
      },
      fechaNacimiento: {
        required: "Por favor seleccione la fecha de nacimiento.",
      },
      nacionalidadID: {
        required: "Por favor seleccione la nacionalidad.",
      },
      paisID: {
        required: "Por favor seleccione el país.",
      },
      provinciaID: {
        required: "Por favor seleccione la provincia.",
      },
      ciudadID: {
        required: "Por favor seleccione la ciudad.",
      },
      direccion: {
        required: "Por favor ingrese la dirección.",
      },
      telefonoResidencial: {
        required: "Por favor ingrese el télefono residencial.",
      },
      telefonoCelular: {
        required: "Por favor ingrese el télefono celular.",
      },
      correoElectronico: {
        required: "Por favor ingrese el correo electrónico.",
      },
      puestoID: {
        required: "Por favor seleccione el puesto.",
      },
      departamentoID: {
        required: "Por favor seleccione el departamento.",
      },
      salario: {
        required: "Por favor ingrese el salario del empleado.",
      },
      numeroSeguridadSocial: {
        required: "Por favor ingrese el número social del empleado.",
      },
      fechaContratacion: {
        required: "Por favor seleccione la fecha de contratación.",
      },
    },
    errorElement: "span",
    errorPlacement: function (error, element) {
      error.addClass("invalid-feedback");
      element.closest(".form-group").append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass("is-invalid");
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass("is-invalid");
    },
  });
});
