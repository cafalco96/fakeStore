const toggleBtn = document.getElementById("menu-toggle");
const navMenu = document.getElementById("nav-menu");
let menuOpen = false;

toggleBtn.addEventListener("click", () => {
  menuOpen = !menuOpen;
  navMenu.classList.toggle("hidden");
  toggleBtn.textContent = menuOpen ? "✕" : "☰";
});
if (!localStorage.getItem("token")) {
  window.location.href = "login.html";
} else {
  const logOutBtn = document.createElement("button");
  logOutBtn.textContent = "Cerrar sesión";
  logOutBtn.className =
    "bg-red-500 text-white px-4 py-2 rounded mt-4 hover:bg-red-600";
  logOutBtn.addEventListener("click", () => {
    localStorage.removeItem("token");
    window.location.href = "login.html";
  });
  navMenu.appendChild(logOutBtn);
}
