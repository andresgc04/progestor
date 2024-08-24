navLinkPrimary("navLinkHomeProjectRequests");

setContentHeaderTitle("Registrar Nueva Solicitud De Proyecto");

setBreadCrumbContentHeaderTitle(
  "../home-project-requests",
  "Listado De Solicitudes De Proyectos"
);

setBreadCrumbContentHeaderSubTitle("Registrar Nueva Solicitud De Proyecto");

(function () {
  //Initialize Date picker:
  $("#fechaEstimadaDeseada").datetimepicker({
    format: "YYYY/MM/DD",
  });

  initializeSelect2Elements();

  bsCustomFileInput.init();
})();

const eliminarRequerimientoProyecto = (projectRequirementIndex) => {
  $(projectRequirementIndex).parent().parent().fadeOut(400).remove();
};

const newProjectRequirements = () => {
  $("#projectRequirementsTable").append(
    `
        <tr>
        <td><div class="form-group"><input type="text" id="requerimientoSolicitudProyecto" name="requerimientoSolicitudProyecto[]" class="form-control" placeholder="Por favor ingrese la descripción del requerimiento"/></div></td>
        <td class="d-flex justify-content-center">
            <button type="button" class="btn btn-danger" onclick="eliminarRequerimientoProyecto(this)"><i class="fas fa-minus"></i></button>
        </td>
        </tr>
        `
  );
};

const addProjectRequirementsButton = document.getElementById(
  "addProjectRequirementsButton"
);
addProjectRequirementsButton.onclick = function () {
  newProjectRequirements();
};

// Función para multiplicar los valores de los inputs:
const calcularAreaTotaTerreno = () => {
  // Obtener los valores de los inputs:
  const dimensionMetroLargoTerrenoValue =
    parseFloat(document.getElementById("dimensionMetroLargoTerreno").value) ||
    0;

  const dimensionMetroAnchoTerrenoValue =
    parseFloat(document.getElementById("dimensionMetroAnchoTerreno").value) ||
    0;

  // Multiplicar los valores:
  const resultadoAreaTotalTerreno =
    dimensionMetroLargoTerrenoValue * dimensionMetroAnchoTerrenoValue;

  document.getElementById("areaTotalTerreno").value = resultadoAreaTotalTerreno;
};

// Agregar eventos de 'input' a los campos de entrada:
document
  .getElementById("dimensionMetroLargoTerreno")
  .addEventListener("input", calcularAreaTotaTerreno);

document
  .getElementById("dimensionMetroAnchoTerreno")
  .addEventListener("input", calcularAreaTotaTerreno);

const verificarClienteTieneTitulo = (event) => {
  const verificacionTituloValue = event.target.value;

  const sectionDocumento = document.getElementById("sectionDocumento");

  const saveNewProjectRequestsButton = document.getElementById(
    "saveNewProjectRequestsButton"
  );

  if (verificacionTituloValue == "SI") {
    sectionDocumento.style.display = "block";

    saveNewProjectRequestsButton.style.display = "block";
  } else {
    Swal.fire({
      position: "center",
      icon: "warning",
      title:
        "Debe de tener el titulo de la propiedad para continuar con el proceso.",
      showConfirmButton: false,
      timer: 2000,
      timerProgressBar: true,
    }).then(
      (willClose = () => {
        sectionDocumento.style.display = "none";

        saveNewProjectRequestsButton.style.display = "none";
      })
    );
  }
};

const verificacionTituloInput = document.getElementById("verificacionTitulo");
verificacionTituloInput.onchange = verificarClienteTieneTitulo;

const cancelSaveNewProjectRequestsButton = document.getElementById(
  "cancelSaveNewProjectRequestsButton"
);
cancelSaveNewProjectRequestsButton.onclick = () =>
  (window.location.href = "../home-project-requests/");

function saveNewProjectRequests() {
  let newProjectRequestsFormData = new FormData(
    $("#newProjectRequestsForm")[0]
  );

  $.ajax({
    url: "../../controller/SolicitudesProyectosController.php?op=registrar_solicitudes_proyectos",
    type: "POST",
    data: newProjectRequestsFormData,
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        position: "center",
        icon: "success",
        title: "Solicitud Proyecto Registrado Correctamente",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
      }).then(
        (willClose = () => {
          window.location.href = "../home-project-requests/";
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
      saveNewProjectRequests();
    },
  });

  $("#newProjectRequestsForm").validate({
    rules: {
      nombreProyecto: {
        required: true,
      },
      objetivoProyecto: {
        required: true,
      },
      descripcionProyecto: {
        required: true,
      },
      areaTotalTerreno: {
        required: true,
      },
      dimensionMetroLargoTerreno: {
        required: true,
      },
      dimensionMetroAnchoTerreno: {
        required: true,
      },
      ubicacion: {
        required: true,
      },
      presupuestoEstimadoProyecto: {
        required: true,
      },
      fechaEstimadaDeseada: {
        required: true,
      },
      verificacionTitulo: {
        required: true,
      },
    },
    messages: {
      nombreProyecto: {
        required: "Por favor ingrese el nombre del proyecto.",
      },
      objetivoProyecto: {
        required: "Por favor ingrese el objetivo del proyecto.",
      },
      descripcionProyecto: {
        required: "Por favor ingrese la descripcion del proyecto.",
      },
      areaTotalTerreno: {
        required: "Por favor ingrese el area total del terreno (m2).",
      },
      dimensionMetroLargoTerreno: {
        required: "Por favor ingrese la dimension del largo del terreno (m).",
      },
      dimensionMetroAnchoTerreno: {
        required: "Por favor ingrese la dimension del largo del terreno (m).",
      },
      ubicacion: {
        required: "Por favor ingrese la ubicacion.",
      },
      presupuestoEstimadoProyecto: {
        required:
          "Por favor ingrese el presupuesto estimado para este proyecto.",
      },
      fechaEstimadaDeseada: {
        required:
          "Por favor seleccione la fecha estimada deseada del proyecto.",
      },
      verificacionTitulo: {
        required: "Por favor confirme si tiene el titulo de la propiedad.",
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
