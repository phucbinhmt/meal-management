const dateInput = document.querySelector('input[type="date"]');
dateInput.addEventListener("change", (e) => {
  let dateSelected = dateInput.value;
  let currentURL = window.location.href;
  let newURL = currentURL.match(/(.*\/menus\/)/)[0] + dateSelected;
  window.location.href = newURL;
});
