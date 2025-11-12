<?php
$pageTitle = "AracdiaWorks";
$pageDescription = "Explore ArcadiaWorks handcrafted vintage arcade cabinets—authentic retro gaming experiences built with modern precision. Custom designs, premium materials, and timeless nostalgia for collectors and enthusiasts.";
include_once "./inc/templates/meta.php";
include_once "./inc/templates/header.php";
require_once './inc/classes/Crud.php';
$crud = new Crud();
$products = $crud->getAllProducts();

if (!empty($products)) {
    $randomKey = array_rand($products);
    $featuredProduct = $products[$randomKey];
    unset($products[$randomKey]);
    $products = array_values($products);
}
?>

<body>
    <main>
        <section class="featured-section fade-in">
        <h1 class="featured-title">F<span class="logo-colour-2">eatured</span> A<span class="logo-colour-2">rcade</span> M<span class="logo-colour-2">achine</span></h1>
            <?php if (isset($featuredProduct)):
                ?>
                <article class="featured-product">
                    <div class="featured-left">
                        <h1 class="featured-product-title"><?php echo htmlspecialchars($featuredProduct['productTitle']) ?></h1>
                        <div class="featured-img-container">
                            <img src="./<?php echo htmlspecialchars($featuredProduct['imgLink']) ?>" alt="">
                        </div>
                    </div>
                    <div class="featured-right">
                        <h2 class="logo-colour">Description</h2>
                        <p class="featured-description"><?php echo htmlspecialchars($featuredProduct['productDescription']) ?></p>
                        <h3 class="logo-colour-2">Condition: <?php echo htmlspecialchars($featuredProduct['productCondition']) ?></h3>
                        <div class="featured-cart-price">
                            <a href="" class="main-btn">Add To Cart</a>
                            <p class="featured-price">$<?php echo htmlspecialchars($featuredProduct['productPrice']) ?></p>
                        </div>
                    </div>
                </article>
            <?php else: ?>
                <p class="no-featured-product text-centre">No Featured Product</p>
            <?php endif; ?>
        </section>

        <section class="products-list">
            <h2 class="products-header">A<span class="logo-colour-2">rcade</span> M<span class="logo-colour-2">achines</span></h2>
            <div class="products-container">
                <?php if (!empty($products)) {
                    foreach ($products as $product): ?>
                        <article class="product-card">
                            <h2 class="logo-colour-2"><?php echo htmlspecialchars($product['productTitle']) ?></h2>
                            <div class="product-card-img-container">
                                <img src="./<?php echo htmlspecialchars($product['imgLink']) ?>" alt="">
                            </div>
                            <p class="logo-colour-2">Condition: <?php echo htmlspecialchars($product['productCondition']) ?></p>
                            <p class="product-card-price">$<?php echo htmlspecialchars($product['productPrice']) ?></p>
                            <div class="product-card-links">
                                <a href="./product.php?ID=<?php echo htmlspecialchars($product['ID']) ?>" class="dark-btn">More Details</a>
                                <a href="" class="main-btn">Add To Cart</a>
                            </div>
                        </article>
                <?php endforeach;
                } else {
                    echo "<p>No products found.</p>";
                }
                ?>

            </div>
        </section>
    </main>
</body>
<?php include_once "./inc/templates/footer.php" ?>