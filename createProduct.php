<?php
require_once './inc/classes/Crud.php';
require_once './inc/classes/FileHandler.php';
require_once './inc/classes/Validation.php';

$pageTitle = "ArcadiaWorks | Create Product";
$pageDescription = "Add products to the database — admin access only.";

$crud = new Crud();
$fileHandler = new FileHandler();
$validation = new Validation();

$successMessage = '';
$old = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old = [
        "productTitle"        => $_POST["productTitle"] ?? '',
        "productDescription"  => $_POST["productDescription"] ?? '',
        "productPrice"        => $_POST["productPrice"] ?? '',
        "productCondition"    => $_POST["productCondition"] ?? '',
        "productManufacturer" => $_POST["productManufacturer"] ?? '',
        "productDepth"        => $_POST["productDepth"] ?? '',
        "productHeight"       => $_POST["productHeight"] ?? '',
        "productWidth"        => $_POST["productWidth"] ?? '',
        "productScreenType"   => $_POST["productScreenType"] ?? '',
        "productScreenSize"   => $_POST["productScreenSize"] ?? '',
        "productWeight"       => $_POST["productWeight"] ?? ''
    ];
    $formErrors = $validation->validateProductForm($old);
        $fileData = $_FILES['productImage'];
        if ($fileData['error'] !== UPLOAD_ERR_OK) {
            $imgError = "Upload error: " . $fileData['error'];
        } else {
            $fileExt = $validation->validateImage($fileData);

            if ($fileExt !== false) {
                $imagePath = $fileHandler->saveImage($fileData, $fileExt);
                if ($imagePath !== false) {
                    $formData = $old;
                    $formData['imgLink'] = $imagePath;
                    $result = $crud->createProduct($formData);
                    if ($result === true) {
                        $successMessage = "Product created successfully!";
                        $old = [];
                    } else {
                        $imgError = "Failed to create product.";
                        error_log("CreateProduct returned false. FormData: " . print_r($formData, true));
                    }
                } else {
                    $imgError = "File upload failed.";
                }
            } else {
                $imgError = "Invalid image file. Cannot be SVG or over 2mb in size.";
            }
        }
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
        <h2>Add a New Product</h2>
        <?php if ($successMessage): ?>
            <p class="logo-colour"><?php echo $successMessage ?></p>
        <?php endif; ?>

        <form action="" method="POST" enctype="multipart/form-data" class="create-product-form">

            <div class="input-container">
                <label for="productTitle">Product Title:</label>
                <input type="text" id="productTitle" name="productTitle"
                    class="<?php echo isset($formErrors['productTitle']) ? 'border-error' : ''; ?>"
                    value="<?php echo htmlspecialchars($old['productTitle'] ?? '') ?>" required>
                <?php if (isset($formErrors['productTitle'])): ?>
                    <p class="text-error"><?php echo htmlspecialchars($formErrors['productTitle']) ?></p>
                <?php endif; ?>
            </div>

            <div class="input-container">
                <label for="productManufacturer">Manufacturer:</label>
                <input type="text" id="productManufacturer" name="productManufacturer"
                    class="<?php echo isset($formErrors['productManufacturer']) ? 'border-error' : ''; ?>"
                    value="<?php echo htmlspecialchars($old['productManufacturer'] ?? '') ?>" required>
                <?php if (isset($formErrors['productManufacturer'])): ?>
                    <p class="text-error"><?php echo htmlspecialchars($formErrors['productManufacturer']) ?></p>
                <?php endif; ?>
            </div>

            <div class="input-container">
                <label for="productDescription">Description:</label>
                <textarea class="<?php echo isset($formErrors['productDescription']) ? 'border-error' : ''; ?>"
                    id="productDescription" name="productDescription" rows="4"><?php echo htmlspecialchars($old['productDescription'] ?? '') ?></textarea>
                <?php if (isset($formErrors['productDescription'])): ?>
                    <p class="text-error"><?php echo htmlspecialchars($formErrors['productDescription']) ?></p>
                <?php endif; ?>
            </div>

            <div class="input-row">
                <div class="input-container-sm">
                    <label for="productDepth">Depth</label>
                    <input class="<?php echo isset($formErrors['productDimensions']) ? 'border-error' : ''; ?>" type="number" id="productDepth" name="productDepth" step="0.01"
                        value="<?php echo htmlspecialchars($old['productDepth'] ?? '') ?>" required>
                </div>
                <div class="input-container-sm">
                    <label for="productHeight">Height</label>
                    <input class="<?php echo isset($formErrors['productDimensions']) ? 'border-error' : ''; ?>" type="number" id="productHeight" name="productHeight" step="0.01"
                        value="<?php echo htmlspecialchars($old['productHeight'] ?? '') ?>" required>
                </div>
                <div class="input-container-sm">
                    <label for="productWidth">Width</label>
                    <input class="<?php echo isset($formErrors['productDimensions']) ? 'border-error' : ''; ?>" type="number" id="productWidth" name="productWidth" step="0.01"
                        value="<?php echo htmlspecialchars($old['productWidth'] ?? '') ?>" required>
                </div>
            </div>
            <?php if (isset($formErrors['productDimensions'])): ?>
                <p class="text-error"><?php echo htmlspecialchars($formErrors['productDimensions']) ?></p>
            <?php endif; ?>

            <div class="input-container">
                <label for="productWeight">Weight (lbs):</label>
                <input type="number" id="productWeight" name="productWeight" step="1"
                    class="<?php echo isset($formErrors['productWeight']) ? 'border-error' : ''; ?>"
                    value="<?php echo htmlspecialchars($old['productWeight'] ?? '') ?>" required>
                <?php if (isset($formErrors['productWeight'])): ?>
                    <p class="text-error"><?php echo htmlspecialchars($formErrors['productWeight']) ?></p>
                <?php endif; ?>
            </div>

            <div class="input-container">
                <label for="productPrice">Price (CAD):</label>
                <input type="number" id="productPrice" name="productPrice" step="0.01"
                    class="<?php echo isset($formErrors['productPrice']) ? 'border-error' : ''; ?>"
                    value="<?php echo htmlspecialchars($old['productPrice'] ?? '') ?>" required>
                <?php if (isset($formErrors['productPrice'])): ?>
                    <p class="text-error"><?php echo htmlspecialchars($formErrors['productPrice']) ?></p>
                <?php endif; ?>
            </div>

            <div class="input-container">
                <label for="productScreenType">Screen Type:</label>
                <select id="productScreenType" name="productScreenType" required>
                    <option value="">Select</option>
                    <option value="CRT" <?php echo ($old['productScreenType'] ?? '') === 'CRT' ? 'selected' : '' ?>>CRT</option>
                    <option value="LCD" <?php echo ($old['productScreenType'] ?? '') === 'LCD' ? 'selected' : '' ?>>LCD</option>
                </select>
                <?php if (isset($formErrors['productScreenType'])): ?>
                    <p class="text-error"><?php echo htmlspecialchars($formErrors['productScreenType']) ?></p>
                <?php endif; ?>
            </div>

            <div class="input-container">
                <label for="productScreenSize">Size (inches):</label>
                <input class="<?php echo isset($formErrors['productScreenSize']) ? 'border-error' : ''; ?>" type="number" id="productScreenSize" name="productScreenSize" step="1"
                    value="<?php echo htmlspecialchars($old['productScreenSize'] ?? '') ?>" required>
                <?php if (isset($formErrors['productScreenSize'])): ?>
                    <p class="text-error"><?php echo htmlspecialchars($formErrors['productScreenSize']) ?></p>
                <?php endif; ?>
            </div>

            <div class="input-container">
                <label for="productCondition">Condition:</label>
                <select id="productCondition" name="productCondition" required>
                    <option value="">Select</option>
                    <option value="New" <?php echo ($old['productCondition'] ?? '') === 'New' ? 'selected' : '' ?>>New</option>
                    <option value="Used" <?php echo ($old['productCondition'] ?? '') === 'Used' ? 'selected' : '' ?>>Used</option>
                    <option value="Refurbished" <?php echo ($old['productCondition'] ?? '') === 'Refurbished' ? 'selected' : '' ?>>Refurbished</option>
                </select>
                <?php if (isset($formErrors['productCondition'])): ?>
                    <p class="text-error"><?php echo htmlspecialchars($formErrors['productCondition']) ?></p>
                <?php endif; ?>
            </div>

            <div class="input-container">
                <label for="productImage">Product Image:</label>
                <input type="file" id="productImage" name="productImage" accept=".jpg,.jpeg,.png,.gif" class="white-text" required>
                <?php if (isset($imgError)): ?>
                    <p class="text-error"><?php echo htmlspecialchars($imgError) ?></p>
                <?php endif; ?>
                <img id="imagePreview" src="#" alt="Image Preview" class="image-preview">
            </div>

            <button type="submit" class="main-btn">Create Product</button>
        </form>
    </main>
</body>

<?php require_once "./inc/templates/footer.php"; ?>

</html>
