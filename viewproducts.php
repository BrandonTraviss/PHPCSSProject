<?php
require_once './inc/classes/Crud.php';
require_once './inc/classes/FileHandler.php';
require_once './inc/classes/Validation.php';
$pageTitle = "ArcadiaWorks | Create Product";
$pageDescription = "Add products to the database this is for admins only.";
include_once './inc/templates/meta.php';
include_once './inc/templates/header.php';
$crud = new Crud();
$products = $crud->getAllProducts();
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
                            <div class="product-view-image-container">
                                <img src="./<?php echo htmlspecialchars($product['imgLink']) ?>" alt="<?php echo htmlspecialchars($product['productTitle']) ?>">
                            </div>
                            <p>Title: <?php echo htmlspecialchars($product['productTitle']) ?></p>
                            <p>Description: <?php echo htmlspecialchars($product['productDescription']) ?></p>
                            <p>Price: $<?php echo number_format($product['productPrice'], 2) ?></p>
                            <p>Condition: <?php echo htmlspecialchars($product['productCondition']) ?></p>
                            <a href="editproduct.php?id=<?php echo $product['ID'] ?>">Edit Product</a>
                            <a href="viewproducts.php?delete=<?= $product['ID'] ?>"
                                onclick="return confirm('Are you sure you want to delete this product?');">
                                Delete Product
                            </a>
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