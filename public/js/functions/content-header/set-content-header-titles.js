const setContentHeaderTitle = (contentHeaderTitleValue) => {
  const getContentHeaderTitle = document.getElementById("contentHeaderTitle");
  getContentHeaderTitle.innerHTML = contentHeaderTitleValue;
};

const setBreadCrumbContentHeaderTitle = (
  pathValue = "#",
  breadCrumbContentHeaderTitleValue
) => {
  const getBreadCrumbContentHeaderTitle = document.getElementById(
    "breadCrumbContentHeaderTitle"
  );
  getBreadCrumbContentHeaderTitle.setAttribute("href", `${pathValue}`);
  getBreadCrumbContentHeaderTitle.innerHTML = breadCrumbContentHeaderTitleValue;
};

const setBreadCrumbContentHeaderSubTitle = (
  breadCrumbContentHeaderSubTitleValue
) => {
  const getBreadCrumbContentHeaderSubTitle = document.getElementById(
    "breadCrumbContentHeaderSubTitle"
  );
  getBreadCrumbContentHeaderSubTitle.innerHTML =
    breadCrumbContentHeaderSubTitleValue;
};
