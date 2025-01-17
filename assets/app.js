import "./styles/app.css";

document.querySelectorAll(".remove-button").forEach((button) => {
  button.addEventListener("click", (e) => {
    const response = prompt("Are you sure you want to delete this item? (y/n)");
    if (!(response[0] === "y")) {
      e.preventDefault();
    }
  });
});
