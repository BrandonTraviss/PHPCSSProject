<?php
$pageTitle = "ArcadiaWorks | Create Product";
$pageDescription = "Add products to the database this is for admins only.";
require_once './inc/classes/Crud.php';
require_once './inc/classes/FileHandler.php';
require_once './inc/classes/Validation.php';
require_once "./inc/classes/Session.php";
require_once './inc/templates/meta.php';
if (!Session::isLoggedIn()) {
    require_once "./inc/templates/header.php";
} else {
    require_once "./inc/templates/adminHeader.php";
}
if (!Session::isLoggedIn()) {
    header("Location:login.php");
    exit;
}
$crud = new Crud();
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $deleteId = (int)$_GET['delete'];
    if ($crud->deleteProduct($deleteId)) {
        header("Location: viewproducts.php?deleted=1");
        exit;
    } else {
        echo "<p class='error'>Failed to delete product.</p>";
    }
}
?>

<body>
    <main>
        <section class="product-list">
            <h2>All Products</h2>
            <?php if (isset($_GET['deleted'])): ?>
                <div class="message success">Product deleted successfully.</div>
            <?php endif; ?>
            <div class="products-admin-container">
                <?php
                $products = $crud->getAllProducts();

                if (!empty($products)) {
                    foreach ($products as $product): ?>
                        <article class="product-view">
                            <div class="product-inner-container">
                                <div class="center-product-image">
                                    <div class="product-view-image-container">
                                        <img src="./<?php echo htmlspecialchars($product['imgLink']) ?>" alt="<?php echo htmlspecialchars($product['productTitle']) ?>">
                                    </div>
                                </div>

                                <div class="product-inner-container">
                                    <p><span class="logo-colour-2">Title: </span><?php echo htmlspecialchars($product['productTitle']) ?></p>
                                    <p><span class="logo-colour-2">Manufacturer: </span><?php echo htmlspecialchars($product['productManufacturer']) ?></p>
                                    <p class="view-products-description"><span class="logo-colour-2">Description: </span><?php echo htmlspecialchars($product['productDescription']) ?></p>
                                    <p><span class="logo-colour-2">Dimensions: </span>
                                        <?php echo htmlspecialchars($product['productDepth']) ?>"D x
                                        <?php echo htmlspecialchars($product['productHeight']) ?>"H x
                                        <?php echo htmlspecialchars($product['productWidth']) ?>"W</p>
                                    <p><span class="logo-colour-2">Weight: </span><?php echo htmlspecialchars($product["productWeight"]) ?>lbs</p>
                                    <p><span class="logo-colour-2">Price: </span>$<?php echo number_format($product['productPrice'], 2) ?></p>
                                    <p><span class="logo-colour-2">Condition: </span><?php echo htmlspecialchars($product['productCondition']) ?></p>
                                </div>

                            </div>
                            <div class="product-inner-container-row">
                                <a class="no-dec logo-colour hover-colour-2 bold" href="editproduct.php?id=<?php echo $product['ID'] ?>">Edit</a>
                                <a class="no-dec logo-colour hover-colour-2 bold" href="viewproducts.php?delete=<?php echo $product['ID'] ?>"
                                    onclick="return confirm('Are you sure you want to delete this product?');">
                                    Delete
                                </a>
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

<?php require_once "./inc/templates/footer.php" ?>