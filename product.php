<?php
$pageTitle = "AracdiaWorks";
$pageDescription = "Explore ArcadiaWorks handcrafted vintage arcade cabinets—authentic retro gaming experiences built with modern precision. Custom designs, premium materials, and timeless nostalgia for collectors and enthusiasts.";
require_once "./inc/classes/Session.php";
require_once "./inc/templates/meta.php";
require_once './inc/classes/crud.php';
?>

<body>
    <?php
    if (!Session::isLoggedIn()) {
        require_once "./inc/templates/header.php";
    } else {
        require_once "./inc/templates/adminHeader.php";
    }

    $crud = new Crud();

    ?>

    <main class="product-main">
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
                            <img src="./<?php echo htmlspecialchars($product['imgLink']) ?>"
                                alt="<?php echo htmlspecialchars($product['productTitle']); ?>">
                        </div>
                        <div class="inline-container">
                            <h2>$<?php echo htmlspecialchars($product['productPrice']) ?></h2>
                        </div>
                    </div>
                    <div class="featured-right">
                        <h2 class="logo-colour">Description</h2>
                        <p class="featured-description"><?php echo htmlspecialchars($product['productDescription']) ?></p>
                        <h3 class="logo-colour">Condition: <?php echo htmlspecialchars($product['productCondition']) ?></h3>
                        <h4 class="logo-colour underline">Specifications</h4>
                        <div class="inline-container">
                            <p><span class="bold logo-colour-2">Manufacturer:
                                </span><?php echo htmlspecialchars($product['productManufacturer']) ?></p>
                        </div>
                        <div class="inline-container">
                            <p><span class="bold logo-colour-2">Dimensions: </span>
                                <?php echo htmlspecialchars($product['productDepth']) ?>"D x
                                <?php echo htmlspecialchars($product['productHeight']) ?>"H x
                                <?php echo htmlspecialchars($product['productWidth']) ?>"W
                            </p>
                        </div>
                        <div class="inline-container">
                            <p><span class="bold logo-colour-2">Screen Type: </span>
                                <?php echo htmlspecialchars($product['productScreenType']) ?></p>
                        </div>
                        <div class="inline-container">
                            <p><span class="bold logo-colour-2">Screen Size: </span>
                                <?php echo htmlspecialchars($product['productScreenSize']) ?>"</p>
                        </div>
                        <div class="inline-container">
                            <p><span class="bold logo-colour-2">Weight: </span>
                                <?php echo htmlspecialchars($product['productWeight']) ?>lbs</p>
                        </div>
                        <div class="inline-container">
                            <a href="" class="main-btn">Add To Cart</a>
                            <a href="shop.php" class="dark-btn">Back To Shop</a>
                        </div>
                    </div>
                </article>
            <?php else: ?>
                <p>Product not found.</p>
            <?php endif; ?>

        <?php else: ?>
            <p>No product ID specified.</p>
        <?php endif; ?>
    </main>
<?php require_once "./inc/templates/footer.php" ?>