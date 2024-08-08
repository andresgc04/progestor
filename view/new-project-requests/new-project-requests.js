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
      fechaEstimadaDeseada: {
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
      fechaEstimadaDeseada: {
        required:
          "Por favor seleccione la fecha estimada deseada del proyecto.",
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
