import "./bootstrap";

// Import bootstrap JS
import * as bootstrap from "bootstrap";

const body = document.querySelector("body");
const sidebar = document.querySelector("#sidebar");
const toggle = document.querySelector(".toggle");
const modeSwitch = document.querySelector(".toggle-switch");
const modeText = document.querySelector(".mode-text");

const sendMode = (mode) => {
  fetch("/mode", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
    },
    body: JSON.stringify({ mode }),
  })
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      console.log("Data received from server:", data);
    })
    .catch((error) => {
      console.error("There was a problem with the fetch operation:", error);
    });
};

if (!localStorage.getItem("mode")) {
  localStorage.setItem("mode", "");
}

toggle.addEventListener("click", () => {
  sidebar.classList.toggle("close");
});

modeSwitch.addEventListener("click", () => {
  if (body.classList.contains("dark")) {
    modeText.innerText = "Light Mode";
    localStorage.setItem("mode", "");
    body.classList.remove("dark");
    sendMode("");
  } else {
    modeText.innerText = "Dark Mode";
    localStorage.setItem("mode", "dark");
    body.classList.add("dark");
    sendMode("dark");
  }
});

// Notify

if (document.querySelector(".notify")) {
  const notify = document.querySelector(".notify");
  const progressNotify = document.querySelector(".notify .progress");
  const closeNotify = document.querySelector(".notify .close");

  const timerNofity = setTimeout(() => {
    notify.classList.remove("active");
  }, 5000);

  closeNotify.addEventListener("click", () => {
    notify.classList.remove("active");
    progressNotify.classList.add("d-none");
    clearTimeout(timerNofity);
  });
}
