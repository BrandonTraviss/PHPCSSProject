<?php
$pageTitle = "AracdiaWorks";
$pageDescription = "Explore ArcadiaWorks handcrafted vintage arcade cabinets—authentic retro gaming experiences built with modern precision. Custom designs, premium materials, and timeless nostalgia for collectors and enthusiasts.";
require_once "./inc/classes/Session.php";
require_once "./inc/templates/meta.php";
if (!Session::isLoggedIn()) {
    require_once "./inc/templates/header.php";
} else {
    require_once "./inc/templates/adminHeader.php";
}
?>

<body>
    <main>

    </main>
</body>
<?php require_once "./inc/templates/footer.php" ?>