const openNewUserClientFormModal = () => {
  $("#newUserClientFormModal").modal("show");
};

const newUserClientButton = document.getElementById("newUserClientButton");
newUserClientButton.addEventListener("click", () => {
  openNewUserClientFormModal();
});
