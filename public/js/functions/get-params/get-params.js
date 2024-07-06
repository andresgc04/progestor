function getParams(params) {
  const getParams = new URLSearchParams(window.location.search);
  return getParams.get(params);
}
