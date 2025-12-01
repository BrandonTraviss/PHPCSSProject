<?php
$pageTitle = "AracdiaWorks";
$pageDescription = "Explore ArcadiaWorks handcrafted vintage arcade cabinets—authentic retro gaming experiences built with modern precision. Custom designs, premium materials, and timeless nostalgia for collectors and enthusiasts.";
require_once "./inc/classes/Session.php";
require_once "./inc/templates/meta.php";
require_once './inc/classes/crud.php';

if (!Session::isLoggedIn()) {
    require_once "./inc/templates/header.php";
} else {
    require_once "./inc/templates/adminHeader.php";
}

$crud = new Crud();

?>

<body>
    <main>
        <?php if (isset($_GET['ID'])): ?>
            <?php
            $id = intval($_GET['ID']);
            $product = $crud->getProductById($id);
            ?>
            <?php if ($product): ?>
                <article class="featured-product">
                    <div class="featured-left">
                        <h1 class="featured-product-title"><?php echo htmlspecialchars($product['productTitle']) ?></h1>
                        <div class="featured-img-container">
                            <img src="./<?php echo htmlspecialchars($product['imgLink']) ?>" alt="">
                        </div>
                    </div>
                    <div class="featured-right">
                        <h2 class="logo-colour">Description</h2>
                        <p class="featured-description"><?php echo htmlspecialchars($product['productDescription']) ?></p>
                        <h3 class="logo-colour">Condition: <?php echo htmlspecialchars($product['productCondition']) ?></h3>
                        <h4 class="logo-colour underline">Specifications</h4>
                        <div class="inline-container">
                            <p><span class="bold logo-colour-2">Manufacturer: </span>Atari</p>
                        </div>
                        <div class="inline-container">
                            <p><span class="bold logo-colour-2">Dimensions: </span>22.6"D x 68.9"H x 72.5"W</p>
                        </div>
                        <div class="inline-container">
                            <p><span class="bold logo-colour-2">Screen Type: </span> CRT</p>
                        </div>
                        <div class="inline-container">
                            <p><span class="bold logo-colour-2">Screen Size: </span>24"</p>
                        </div>
                        <div class="inline-container">
                            <p><span class="bold logo-colour-2">Weight: </span>68lbs</p>
                        </div>
                        <div class="inline-container">
                            <a href="" class="main-btn">Add To Cart</a>
                            <p class="featured-price">$<?php echo htmlspecialchars($product['productPrice']) ?></p>
                        </div>
                        <a href="shop.php" class="dark-btn">Back To Shop</a>
                    </div>
                </article>
            <?php else: ?>
                <p>Product not found.</p>
            <?php endif; ?>

        <?php else: ?>
            <p>No product ID specified.</p>
        <?php endif; ?>
    </main>
</body>
<?php require_once "./inc/templates/footer.php" ?>