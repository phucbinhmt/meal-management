const dateInput = document.querySelector('input[type="date"]');
dateInput.addEventListener("change", (e) => {
  let dateSelected = dateInput.value;
  let currentURL = window.location.href;
  let newURL = currentURL.match(/(.*\/search\/)/)[0] + dateSelected + "/1";
  window.location.href = newURL;
});

const sessionSelect = document.querySelector('select[name="session"]');
sessionSelect.addEventListener("change", () => {
  let dateSelected = dateInput.value;
  let currentURL = window.location.href;
  let newURL =
    currentURL.match(/(.*\/search\/)/)[0] +
    dateSelected +
    "/" +
    sessionSelect.value;
  window.location.href = newURL;
});
