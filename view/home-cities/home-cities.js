navLinkPrimary("navLinkMaintenance");

navLinkSecondary("navLinkHomeCities");

setContentHeaderTitle("Listado De Ciudades");

setBreadCrumbContentHeaderTitle("../dashboard/", "Dashboard");

setBreadCrumbContentHeaderSubTitle("Listado De Ciudades");

const openNewCitiesFormModal = () => {
  $("#newCitiesFormModal").modal("show");
};

const newCityButton = document.getElementById("newCityButton");
newCityButton.addEventListener("click", () => {
  openNewCitiesFormModal();
});
