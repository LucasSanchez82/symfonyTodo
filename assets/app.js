import "./styles/app.css";

//  prevent behavior of the remove button
document.querySelectorAll(".remove-button").forEach((button) => {
  button.addEventListener("click", (e) => {
    const response = prompt("Are you sure you want to delete this item? (y/n)");
    if (!(response[0] === "y")) {
      e.preventDefault();
    }
  });
});

// button to filter checked items
const urlParams = new URLSearchParams(window.location.search);
const select = document.querySelector("#select");
const selectSort = document.querySelector("#selectSort");
const options = [
  { value: "all", innerText: "Tous" },
  { value: "checked", innerText: "Fait" },
  { value: "unchecked", innerText: "A faire" },
];

const optionSort = [
  { value: "ASC", innerText: "Croissant" },
  { value: "DESC", innerText: "Décroissant" },
];
options.forEach((option) => {
  const optionElement = document.createElement("option");
  optionElement.value = option.value;
  optionElement.innerText = option.innerText;
  optionElement.selected = option.value === urlParams.get("filter");

  select.appendChild(optionElement);
});

optionSort.forEach((option) => {
  const optionElement = document.createElement("option");
  optionElement.value = option.value;
  optionElement.innerText = option.innerText;
  optionElement.selected = option.value === urlParams.get("sort");

  selectSort.appendChild(optionElement);
});

select.addEventListener("change", (e) => {
  console.log(e.target.value);
  urlParams.set("filter", e.target.value);
  window.location.search = urlParams;
});
selectSort.addEventListener("change", (e) => {
  console.log(e.target.value);
  urlParams.set("sort", e.target.value);
  window.location.search = urlParams;
});
