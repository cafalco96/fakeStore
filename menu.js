const toggleBtn = document.getElementById("menu-toggle");
const navMenu = document.getElementById("nav-menu");
let menuOpen = false;

toggleBtn.addEventListener("click", () => {
  menuOpen = !menuOpen;
  navMenu.classList.toggle("hidden");
  toggleBtn.textContent = menuOpen ? "✕" : "☰";
});

const main = document.querySelector("main");

if (localStorage.getItem("token")) {
  const subnav = document.getElementById("subnav-public");
  if (subnav) subnav.remove();

  // Verifica si el botón de cerrar sesión ya existe
  if (!document.getElementById("logout-btn")) {
    // Si el usuario es admin, muestra el botón de agregar producto
    fetch("http://127.0.0.1:8000/api/me", {
      headers: {
        Authorization: "Bearer " + localStorage.getItem("token"),
      },
    })
      .then((res) => res.json())
      .then((user) => {
        if (user && user.rol === "admin") {
          if (!document.getElementById("add-product-btn")) {
            const addProductBtn = document.createElement("a");
            addProductBtn.id = "add-product-btn";
            addProductBtn.href = "crea-producto.html";
            addProductBtn.textContent = "Agregar producto";
            addProductBtn.className =
              "block bg-green-600 text-white px-4 py-2 rounded mt-4 hover:bg-green-700 text-center";
            const logOutBtn = document.getElementById("logout-btn");
            if (logOutBtn) {
              navMenu.insertBefore(addProductBtn, logOutBtn);
            } else {
              navMenu.appendChild(addProductBtn);
            }
          }
        }
      });

    const logOutBtn = document.createElement("button");
    logOutBtn.id = "logout-btn";
    logOutBtn.textContent = "Cerrar sesión";
    logOutBtn.className =
      "bg-red-500 text-white px-4 py-2 rounded mt-4 hover:bg-red-600 cursor-pointer";
    logOutBtn.addEventListener("click", () => {
      localStorage.removeItem("token");
      window.location.reload();
    });
    navMenu.appendChild(logOutBtn);
  }
} else {
  if (main && !document.getElementById("subnav-public")) {
    const subnav = document.createElement("div");
    subnav.id = "subnav-public";
    subnav.className = "w-full flex justify-center gap-4 py-2";
    subnav.innerHTML = `
      <a href="login.html" class="text-[#F5F5F5] bg-[#1E1E1E] px-4 py-2 rounded hover:bg-[#333] transition">Login</a>
      <a href="register.html" class="text-[#1E1E1E] bg-[#F5F5F5] px-4 py-2 rounded hover:bg-[#e5e5e5] transition">Registrarse</a>
    `;
    main.insertAdjacentElement("afterbegin", subnav);
  }
  const logOutBtn = document.getElementById("logout-btn");
  if (logOutBtn) logOutBtn.remove();
}
