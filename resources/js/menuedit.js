const updateTotal = () => {
  let total = listSelected.querySelectorAll(".card-dish-small").length;
  document.querySelector("#total_message span").innerText = total;
};

const selectBox = document.querySelector("#dish_types");
selectBox.addEventListener("change", () => {
  let allTab = document.querySelectorAll('[id^="list_dish_"]');
  allTab.forEach((tab) => {
    tab.classList.add("d-none");
  });

  let tabSelected = document.querySelector("#list_dish_" + selectBox.value);
  tabSelected.classList.remove("d-none");
});

let eventChange = new Event("change");
selectBox.dispatchEvent(eventChange);

const creatNodeDish = (dishID, dishImg, dishName, dishPrice) => {
  let divCol = document.createElement("div");
  divCol.classList.add("col-12");
  divCol.innerHTML = `
      <div class="card card-dish-small border-1 d-flex flex-row align-items-center" data-dish-id="${dishID}">
          <div class="card-header">
              <img class="img-fluid rounded" src="${dishImg}" alt="image">
          </div>
          <div class="card-body text-start p-2">
              <h6 class="card-title fw-semibold mb-0">${dishName}</h6>
              <p class="card-text">${dishPrice}</p>
          </div>
          <div class="card-img-overlay text-end p-0">
              <i class="close fa-solid fa-xmark fa-fw"></i>
          </div>
      </div>
  `;
  return divCol;
};

const allCardDish = document.querySelectorAll(".card-dish");
const listSelected = document.querySelector("#list_selected");

allCardDish.forEach((cardDish) => {
  cardDish.addEventListener("click", () => {
    if (cardDish.classList.contains("selected")) {
      cardDish.classList.remove("selected");
      let idCardDish = cardDish.getAttribute("data-dish-id");
      let cardDishSelected = document.querySelector(
        `.card-dish-small[data-dish-id="${idCardDish}"]`
      );
      if (cardDishSelected) {
        cardDishSelected.parentNode.remove();
      }
    } else {
      cardDish.classList.add("selected");
      let idSelected = cardDish.getAttribute("data-dish-id");
      let imgSelected = cardDish.querySelector("img").src;
      let nameSelected = cardDish.querySelector(".card-body .card-title")
        .innerText;
      let priceSelected = cardDish.querySelector(".card-body .card-text")
        .innerText;

      let newDishNode = creatNodeDish(
        idSelected,
        imgSelected,
        nameSelected,
        priceSelected
      );

      let closeButton = newDishNode.querySelector(".close");
      closeButton.addEventListener("click", () => {
        cardDish.classList.remove("selected");
        newDishNode.remove();
        updateTotal();
      });

      listSelected.append(newDishNode);
    }
    updateTotal();
  });
});

const dishForm = document.querySelector("#dishForm");
dishForm.addEventListener("submit", () => {
  let idSelecteds = [];
  let cardSelecteds = listSelected.querySelectorAll(".card-dish-small");
  cardSelecteds.forEach((cardSelected) => {
    let dataID = cardSelected.getAttribute("data-dish-id");
    idSelecteds.push({ dish_id: dataID });
  });
  document.querySelector('input[name="dishes"]').value = JSON.stringify(
    idSelecteds
  );
});

let eventClick = new Event("click");
const inputDishes = document.querySelector('input[name="dishes"]');
if (inputDishes.value) {
  let allDishInit = JSON.parse(inputDishes.value);
  allDishInit.forEach((dish) => {
    let dishEle = document.querySelector(
      `.card-dish[data-dish-id="${dish.dish_id}"]`
    );
    dishEle.dispatchEvent(eventClick);
  });
  updateTotal();
}

const deleteAllButton = document.querySelector("#deleteAll");
deleteAllButton.addEventListener("click", () => {
  allCardDish.forEach((cardDish) => {
    if (cardDish.classList.contains("selected")) {
      cardDish.dispatchEvent(eventClick);
    }
  });
});
