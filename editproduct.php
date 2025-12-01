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
$productId = $_GET['id'] ?? null;

$product = $productId ? $crud->getProduct($productId) : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $product) {
    $fileData = $_FILES['productImage'];
    $imagePath = $product['imgLink'];

    // Only validate if a file was uploaded
    if (!empty($fileData['name'])) {
        $fileExt = $validation->validateImage($fileData);

        if ($fileExt === false) {
            $errors['productImage'] = "Invalid image format. Please upload a JPG, PNG, or GIF. Size must also be under 2mb";
        } else {
            $newPath = $fileHandler->saveImage($fileData, $fileExt);
            if ($newPath !== false) {
                $imagePath = $newPath;
            } else {
                $errors['productImage'] = "Failed to save image.";
            }
        }
    }

    if (empty($errors)) {
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
            $product = $crud->getProduct($productId);
            $old = [];
        } 
        $errorMessage = "Please fix the errors below.";
    }
}

if (!$product) {
    $errorMessage = "Product not found.";
}
?>
<?php require_once "./inc/classes/Session.php"; ?>
<?php include_once "./inc/templates/meta.php"; ?>
<?php if (!Session::isLoggedIn()) {
    require_once "./inc/templates/header.php";
} else {
    require_once "./inc/templates/adminHeader.php";
} ?>
<?php if (!Session::isLoggedIn()) {
    header("Location:login.php");
    exit;
}
?>

<body>
    <main class="create-product-main">
        <h2 style="text-align:center;">Edit Product</h2>

        <?php if ($successMessage): ?>
            <div class="message-success"><?php echo $successMessage ?></div>
        <?php endif; ?>

        <?php if ($product): ?>
            <form action="" method="POST" enctype="multipart/form-data" class="create-product-form">
                <div class="input-container">
                    <label for="productTitle">Product Title:</label>
                    <input type="text" id="productTitle" name="productTitle"
                        class="<?php echo isset($errors['productTitle']) ? 'border-error' : ''; ?>"
                        value="<?php echo htmlspecialchars($old['productTitle'] ?? $product['productTitle']) ?>" required>
                    <?php if (isset($errors['productTitle'])): ?>
                        <p class="text-error"><?php echo htmlspecialchars($errors['productTitle']) ?></p>
                    <?php endif; ?>
                </div>

                <div class="input-container">
                    <label for="productDescription">Description:</label>
                    <textarea class="<?php echo isset($errors['productDescription']) ? 'border-error' : ''; ?>" id="productDescription" name="productDescription" rows="4"><?php echo htmlspecialchars($old['productDescription'] ?? $product['productDescription']) ?></textarea>
                    <?php if (isset($errors['productDescription'])): ?>
                        <p class="text-error"><?php echo htmlspecialchars($errors['productDescription']) ?></p>
                    <?php endif; ?>
                </div>

                <div class="input-container">
                    <label for="productPrice">Price (CAD):</label>
                    <input type="number" id="productPrice" name="productPrice" step="0.01"
                        class="<?php echo isset($errors['productPrice']) ? 'border-error' : ''; ?>"
                        value="<?php echo htmlspecialchars($old['productPrice'] ?? $product['productPrice']) ?>" required>
                    <?php if (isset($errors['productPrice'])): ?>
                        <p class="text-error"><?php echo htmlspecialchars($errors['productPrice']) ?></p>
                    <?php endif; ?>
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

                <div class="input-container">
                    <label for="productImage">Replace Image (optional):</label>
                    <input type="file" id="productImage" name="productImage" accept=".jpg,.jpeg,.png,.gif" class="white-text <?php echo isset($errors['productImage']) ? 'border-error' : ''; ?>">
                    <?php if (isset($errors['productImage'])): ?>
                        <p class="text-error"><?php echo htmlspecialchars($errors['productImage']) ?></p>
                    <?php endif; ?>

                    <div class="create-product-image-preview-container">
                        <div class="current-image-container">
                            <p>Current Image</p>
                            <img src="./<?php echo htmlspecialchars($product['imgLink']) ?>" alt="Current product image">
                        </div>
                        <div id="imagePreviewContainer" class="image-preview-container">
                            <p>New Image</p>
                            <img id="imagePreview" src="#" alt="Image Preview" />
                        </div>
                    </div>
                </div>

                <button type="submit" class="main-btn">Update Product</button>
                <a href="./viewproducts.php" class="dark-btn">Go Back</a>
            </form>
        <?php endif; ?>
    </main>
</body>

<?php require_once "./inc/templates/footer.php"; ?>
</html>