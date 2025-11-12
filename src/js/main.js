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

    const imageInput = document.getElementById('productImage');
    const preview = document.getElementById('imagePreview');

    if (imageInput && preview) {
        const originalSrc = preview.getAttribute('data-original') || preview.src;

        imageInput.addEventListener('change', function (event) {
            const file = event.target.files[0];

            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = originalSrc;
            }
        });
    }


});
