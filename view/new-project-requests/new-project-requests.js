navLinkPrimary("navLinkHomeProjectRequests");

setContentHeaderTitle("Registrar Nueva Solicitud De Proyecto");

setBreadCrumbContentHeaderTitle(
  "../home-project-requests",
  "Listado De Solicitudes De Proyectos"
);

setBreadCrumbContentHeaderSubTitle("Registrar Nueva Solicitud De Proyecto");

const eliminarRequerimientoProyecto = (projectRequirementIndex) => {
  $(projectRequirementIndex).parent().parent().fadeOut(400).remove();
};

const newProjectRequirements = () => {
  $("#projectRequirementsTable").append(
    `
        <tr>
        <td><div class="form-group"><input type="text" id="newProjectRequimentDescription" name="newProjectRequimentDescription[]" class="form-control" placeholder="Por favor ingrese la descripción del requerimiento"/></div></td>
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
