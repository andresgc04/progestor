navLinkPrimary("navLinkMaintenance");

navLinkSecondary("navLinkHomeCountries");

setContentHeaderTitle("Listado De Países");

setBreadCrumbContentHeaderTitle("../dashboard/", "Dashboard");

setBreadCrumbContentHeaderSubTitle("Listado De Países");

const openNewCountryFormModal = () => {
  $("#newCountryFormModal").modal("show");
};

const newCountryButton = document.getElementById("newCountryButton");
newCountryButton.addEventListener("click", () => {
  openNewCountryFormModal();
});
