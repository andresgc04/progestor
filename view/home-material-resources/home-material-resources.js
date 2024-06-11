navLinkPrimary("navLinkMaterialResources");

navLinkSecondary("navLinkHomeMaterialResources");

setContentHeaderTitle("Listado De Recursos Materiales");

setBreadCrumbContentHeaderTitle("../dashboard/", "Dashboard");

setBreadCrumbContentHeaderSubTitle("Listado De Recursos Materiales");

const openNewMaterialResourcesFormModal = () => {
  $("#newMaterialResourcesFormModal").modal("show");
};

const newMaterialResourcesButton = document.getElementById(
  "newMaterialResourcesButton"
);
newMaterialResourcesButton.addEventListener("click", () => {
  openNewMaterialResourcesFormModal();
});

(function () {
  //Initialize Select2 Elements:
  initializeSelect2Elements();

  getSelectListTypesMaterialResourcesOptions(
    "../../controller/TiposRecursosMaterialesController.php?op=obtener_listado_opciones_tipos_recursos_materiales",
    "#tipoRecursoMaterialID"
  );
})();
