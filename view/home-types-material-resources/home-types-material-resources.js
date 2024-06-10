navLinkPrimary("navLinkMaintenance");

navLinkSecondary("navLinkHomeTypesMaterialResources");

setContentHeaderTitle("Listado De Tipos De Recursos Materiales");

setBreadCrumbContentHeaderTitle("../dashboard/", "Dashboard");

setBreadCrumbContentHeaderSubTitle("Listado De Tipos De Recursos Materiales");

const openNewTypesMaterialResourcesFormModal = () => {
  $("#newTypesMaterialResourcesFormModal").modal("show");
};

const newTypesMaterialResourcesButton = document.getElementById(
  "newTypesMaterialResourcesButton"
);
newTypesMaterialResourcesButton.addEventListener("click", () => {
  openNewTypesMaterialResourcesFormModal();
});
