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

const paisSelectIDInput = document.getElementById("paisID");
paisSelectIDInput.onchange = (event) => {
  const paisID = event.target.value;

  getSelectListProvincesOptionsByPaisID(
    "controller/ProvinciasController.php?op=obtener_listado_opciones_provincias_por_paisID",
    paisID,
    "#provinciaID"
  );
};

const provinciaSelectIDInput = document.getElementById("provinciaID");
provinciaSelectIDInput.onchange = (event) => {
  const paisID = document.getElementById("paisID").value;
  const provinciaID = event.target.value;

  getSelectListCitiesOptionsByPaisIDAndProvinciaID(
    "controller/CiudadesController.php?op=obtener_listado_opciones_ciudades_por_paisID_provinciaID",
    paisID,
    provinciaID,
    "#ciudadID"
  );
};

document
  .getElementById("confirmarNuevoPassword")
  .addEventListener("change", function (event) {
    const nuevoPasswordInput = document.getElementById("nuevoPassword");
    const confirmarNuevoPasswordInput = event.target;

    const nuevoPassword = nuevoPasswordInput.value;
    const confirmarNuevoPassword = confirmarNuevoPasswordInput.value;

    // Función para mostrar alertas con SweetAlert2
    function mostrarAlertaError() {
      Swal.fire({
        position: "center",
        icon: "error",
        title: "¡Las contraseñas no coinciden!",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
      }).then(() => {
        nuevoPasswordInput.classList.add("is-invalid");
        confirmarNuevoPasswordInput.classList.add("is-invalid");
      });
    }

    // Función para agregar y remover clases de validación
    function actualizarClases(esValido) {
      if (esValido) {
        nuevoPasswordInput.classList.remove("is-invalid");
        confirmarNuevoPasswordInput.classList.remove("is-invalid");
        nuevoPasswordInput.classList.add("is-valid");
        confirmarNuevoPasswordInput.classList.add("is-valid");
      } else {
        nuevoPasswordInput.classList.remove("is-valid");
        confirmarNuevoPasswordInput.classList.remove("is-valid");
        mostrarAlertaError();
      }
    }

    // Verifica si las contraseñas coinciden
    const contraseñasCoinciden = nuevoPassword === confirmarNuevoPassword;
    actualizarClases(contraseñasCoinciden);
  });

const tipoClienteIDInput = document.getElementById("tipoClienteID");
tipoClienteIDInput.onchange = function () {
  const tipoClienteIDValue = document.getElementById("tipoClienteID").value;

  let tipoClienteSection = document.getElementById("tipoClienteSection");

  let nombreClienteSection = document.getElementById("nombreClienteSection");

  let sexoSection = document.getElementById("sexoSection");

  let tipoDocumentoSection = document.getElementById("tipoDocumentoSection");

  let documentoIdentidadSection = document.getElementById(
    "documentoIdentidadSection"
  );

  let nacionalidadSection = document.getElementById("nacionalidadSection");

  if (tipoClienteIDValue != 5) {
    tipoClienteSection.classList.remove("col-xl-4");

    nombreClienteSection.classList.remove("col-xl-4");

    tipoClienteSection.classList.add("col-xl-6");

    nombreClienteSection.classList.add("col-xl-6");

    sexoSection.style.display = "none";

    tipoDocumentoSection.classList.remove("col-xl-4");

    documentoIdentidadSection.classList.remove("col-xl-4");

    tipoDocumentoSection.classList.add("col-xl-6");

    documentoIdentidadSection.classList.add("col-xl-6");

    nacionalidadSection.style.display = "none";
  } else {
    tipoClienteSection.classList.remove("col-xl-6");

    nombreClienteSection.classList.remove("col-xl-6");

    tipoClienteSection.classList.add("col-xl-4");

    nombreClienteSection.classList.add("col-xl-4");

    sexoSection.style.display = "block";

    tipoDocumentoSection.classList.remove("col-xl-6");

    documentoIdentidadSection.classList.remove("col-xl-6");

    tipoDocumentoSection.classList.add("col-xl-4");

    documentoIdentidadSection.classList.add("col-xl-4");

    nacionalidadSection.style.display = "block";
  }
};
