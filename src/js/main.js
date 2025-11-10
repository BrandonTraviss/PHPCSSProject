let open = false;
document.addEventListener("DOMContentLoaded", () => {
    const menuIcon = document.getElementById("menuIcon");
    const mobileMenu = document.querySelector(".mobile-menu");
    menuIcon.addEventListener("click", () => {
        open = !open;
        if (open) {
            mobileMenu.classList.remove("hidden");
            mobileMenu.classList.add("active");
            menuIcon.src = "./src/img/close.svg";
        } else {
            mobileMenu.classList.add("hidden");
            mobileMenu.classList.remove("active");
            menuIcon.src = "./src/img/hamburger.svg";
        }
    });
});
