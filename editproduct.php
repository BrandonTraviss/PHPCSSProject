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
            "imgLink"            => $imagePath,
            "productTitle"       => $_POST["productTitle"],
            "productDescription" => $_POST["productDescription"],
            "productPrice"       => $_POST["productPrice"],
            "productCondition"   => $_POST["productCondition"],
            "productWidth"       => $_POST["productWidth"],
            "productHeight"      => $_POST["productHeight"],
            "productDepth"       => $_POST["productDepth"],
            "productManufacturer" => $_POST["productManufacturer"],
            "productScreenSize"  => $_POST["productScreenSize"],
            "productScreenType"  => $_POST["productScreenType"],
            "productWeight"      => $_POST["productWeight"]
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
                    <label for="productManufacturer">Manufacturer:</label>
                    <input type="text" id="productManufacturer" name="productManufacturer"
                        class="<?php echo isset($errors['productManufacturer']) ? 'border-error' : ''; ?>"
                        value="<?php echo htmlspecialchars($old['productManufacturer'] ?? $product['productManufacturer']) ?>" required>
                    <?php if (isset($errors['productManufacturer'])): ?>
                        <p class="text-error"><?php echo htmlspecialchars($errors['productManufacturer']) ?></p>
                    <?php endif; ?>
                </div>

                <div class="input-container">
                    <label for="productDescription">Description:</label>
                    <textarea class="<?php echo isset($errors['productDescription']) ? 'border-error' : ''; ?>"
                        id="productDescription" name="productDescription" rows="4"><?php echo htmlspecialchars($old['productDescription'] ?? $product['productDescription']) ?></textarea>
                    <?php if (isset($errors['productDescription'])): ?>
                        <p class="text-error"><?php echo htmlspecialchars($errors['productDescription']) ?></p>
                    <?php endif; ?>
                </div>

                <div class="input-row">
                    <div class="input-container-sm">
                        <label for="productDepth">Depth</label>
                        <input type="number" id="productDepth" name="productDepth" step="0.01"
                            value="<?php echo htmlspecialchars($old['productDepth'] ?? $product['productDepth']) ?>" required>
                        <?php if (isset($errors['productDepth'])): ?>
                            <p class="text-error"><?php echo htmlspecialchars($errors['productDepth']) ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="input-container-sm">
                        <label for="productHeight">Height</label>
                        <input type="number" id="productHeight" name="productHeight" step="0.01"
                            value="<?php echo htmlspecialchars($old['productHeight'] ?? $product['productHeight']) ?>" required>
                        <?php if (isset($errors['productHeight'])): ?>
                            <p class="text-error"><?php echo htmlspecialchars($errors['productHeight']) ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="input-container-sm">
                        <label for="productWidth">Width</label>
                        <input type="number" id="productWidth" name="productWidth" step="0.01"
                            value="<?php echo htmlspecialchars($old['productWidth'] ?? $product['productWidth']) ?>" required>
                        <?php if (isset($errors['productWidth'])): ?>
                            <p class="text-error"><?php echo htmlspecialchars($errors['productWidth']) ?></p>
                        <?php endif; ?>
                    </div>
                </div>


                <div class="input-container">
                    <label for="productWeight">Weight (lbs):</label>
                    <input type="number" id="productWeight" name="productWeight" step="1"
                        class="<?php echo isset($errors['productWeight']) ? 'border-error' : ''; ?>"
                        value="<?php echo htmlspecialchars($old['productWeight'] ?? $product['productWeight']) ?>" required>
                    <?php if (isset($errors['productWeight'])): ?>
                        <p class="text-error"><?php echo htmlspecialchars($errors['productWeight']) ?></p>
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
                    <label for="productScreenType">Screen Type:</label>
                    <select id="productScreenType" name="productScreenType" required>
                        <option value="">Select</option>
                        <option value="CRT" <?php echo ($old['productScreenType'] ?? $product['productScreenType']) === 'CRT' ? 'selected' : '' ?>>CRT</option>
                        <option value="LCD" <?php echo ($old['productScreenType'] ?? $product['productScreenType']) === 'LCD' ? 'selected' : '' ?>>LCD</option>
                    </select>
                    <?php if (isset($errors['productScreenType'])): ?>
                        <p class="text-error"><?php echo htmlspecialchars($errors['productScreenType']) ?></p>
                    <?php endif; ?>
                </div>

                <div class="input-container">
                    <label for="productScreenSize">Size (inches):</label>
                    <input type="number" id="productScreenSize" name="productScreenSize" step="1"
                        value="<?php echo htmlspecialchars($old['productScreenSize'] ?? $product['productScreenSize']) ?>" required>
                    <?php if (isset($errors['productScreenSize'])): ?>
                        <p class="text-error"><?php echo htmlspecialchars($errors['productScreenSize']) ?></p>
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
                    <input type="file" id="productImage" name="productImage" accept=".jpg,.jpeg,.png,.gif"
                        class="white-text <?php echo isset($errors['productImage']) ? 'border-error' : ''; ?>">
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