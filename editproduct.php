<?php
require_once './inc/classes/Crud.php';
require_once './inc/classes/FileHandler.php';
require_once './inc/classes/Validation.php';

$pageTitle = "ArcadiaWorks | Edit Product";
$pageDescription = "Edit existing product details. Admin access only.";

$crud = new Crud();
$fileHandler = new FileHandler();
$validation = new Validation();

$successMessage = '';
$errorMessage = '';
$errors = [];
$old = [];

// Get product ID from URL
$productId = $_GET['id'] ?? null;
$product = $productId ? $crud->getProduct($productId) : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $product) {
    $fileData = $_FILES['productImage'];
    $fileExt = $validation->validateImage($fileData);
    $imagePath = $product['imgLink'];

    if (!empty($fileData['name']) && $fileExt !== false) {
        $newPath = $fileHandler->saveImage($fileData, $fileExt);
        if ($newPath !== false) {
            $imagePath = $newPath;
        }
    }

    $formData = [
        "imgLink" => $imagePath,
        "productTitle" => $_POST["productTitle"],
        "productDescription" => $_POST["productDescription"],
        "productPrice" => $_POST["productPrice"],
        "productCondition" => $_POST["productCondition"]
    ];

    $old = $formData;

    $result = $crud->updateProduct($productId, $formData);

    if ($result === true) {
        $successMessage = "Product updated successfully!";
        $product = $crud->getProduct($productId); // refresh product data
        $old = [];
    } elseif (is_array($result)) {
        $errors = $result;
        $errorMessage = "Please fix the errors below.";
    } else {
        $errorMessage = "Failed to update product.";
    }
}

if (!$product) {
    $errorMessage = "Product not found.";
}
?>

<?php include_once "./inc/templates/meta.php"; ?>
<?php include_once "./inc/templates/header.php"; ?>

<body>
    <main class="create-product-main">
        <h2 style="text-align:center;">Edit Product</h2>

        <?php if ($successMessage): ?>
            <div class="message success"><?php echo $successMessage ?></div>
        <?php elseif ($errorMessage): ?>
            <div class="message error"><?php echo $errorMessage ?></div>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
            <div class="message error">
                <ul>
                    <?php foreach ($errors as $field => $msg): ?>
                        <li><?php echo htmlspecialchars($msg) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if ($product): ?>
        <form action="" method="POST" enctype="multipart/form-data" class="create-product-form">
            <div class="input-container">
                <label for="productTitle">Product Title:</label>
                <input type="text" id="productTitle" name="productTitle"
                       value="<?php echo htmlspecialchars($old['productTitle'] ?? $product['productTitle']) ?>" required>
            </div>

            <div class="input-container">
                <label for="productDescription">Description:</label>
                <textarea id="productDescription" name="productDescription" rows="4"><?php echo htmlspecialchars($old['productDescription'] ?? $product['productDescription']) ?></textarea>
            </div>

            <div class="input-container">
                <label for="productPrice">Price (CAD):</label>
                <input type="number" id="productPrice" name="productPrice" step="0.01"
                       value="<?php echo htmlspecialchars($old['productPrice'] ?? $product['productPrice']) ?>" required>
            </div>

            <div class="input-container">
                <label for="productCondition">Condition:</label>
                <select id="productCondition" name="productCondition" required>
                    <option value="">Select</option>
                    <option value="New" <?php echo ($old['productCondition'] ?? $product['productCondition']) === 'New' ? 'selected' : '' ?>>New</option>
                    <option value="Used" <?php echo ($old['productCondition'] ?? $product['productCondition']) === 'Used' ? 'selected' : '' ?>>Used</option>
                    <option value="Refurbished" <?php echo ($old['productCondition'] ?? $product['productCondition']) === 'Refurbished' ? 'selected' : '' ?>>Refurbished</option>
                </select>
            </div>

            <label for="productImage">Replace Image (optional):</label>
            <input type="file" id="productImage" name="productImage" accept=".jpg,.jpeg,.png,.gif">
            <p>Current Image:</p>
            <img src="./<?php echo htmlspecialchars($product['imgLink']) ?>" alt="Current product image" style="max-width:150px;"><br>

            <button type="submit" class="main-btn">Update Product</button>
        </form>
        <?php endif; ?>
    </main>
</body>

<?php include_once "./inc/templates/footer.php"; ?>
</html>