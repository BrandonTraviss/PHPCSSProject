<?php
require_once './inc/classes/Crud.php';
require_once './inc/classes/FileHandler.php';
require_once './inc/classes/Validation.php';

$pageTitle = "ArcadiaWorks | Create Product";
$pageDescription = "Add products to the database this is for admins only.";

$crud = new Crud();
$fileHandler = new FileHandler();
$validation = new Validation();

$successMessage = '';
$errorMessage = '';
$errors = [];
$old = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fileData = $_FILES['productImage'];

    if ($fileData['error'] !== UPLOAD_ERR_OK) {
        $errorMessage = "Upload error: " . $fileData['error'];
    } else {
        $fileExt = $validation->validateImage($fileData);

        $old = [
            "productTitle" => $_POST["productTitle"],
            "productDescription" => $_POST["productDescription"],
            "productPrice" => $_POST["productPrice"],
            "productCondition" => $_POST["productCondition"]
        ];

        if ($fileExt !== false) {
            $imagePath = $fileHandler->saveImage($fileData, $fileExt);

            if ($imagePath !== false) {
                $formData = [
                    "imgLink" => $imagePath,
                    "productTitle" => $_POST["productTitle"],
                    "productDescription" => $_POST["productDescription"],
                    "productPrice" => $_POST["productPrice"],
                    "productCondition" => $_POST["productCondition"]
                ];
                $result = $crud->createProduct($formData);

                if ($result === true) {
                    $successMessage = "Product created successfully!";
                    $old = [];
                } elseif (is_array($result)) {
                    $errors = $result;
                    error_log("Validation errors: " . print_r($errors, true));
                } else {
                    $errorMessage = "Failed to create product.";
                    error_log("CreateProduct returned false. FormData: " . print_r($formData, true));
                }
            } else {
                $errorMessage = "File upload failed.";
            }
        } else {
            $errorMessage = "Invalid image file.";
        }
    }
}
?>

<?php include_once "./inc/templates/meta.php"; ?>
<?php include_once "./inc/templates/header.php"; ?>

<body>
    <main class="create-product-main">
        <h2 style="text-align:center;">Add a New Product</h2>

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

        <form action="" method="POST" enctype="multipart/form-data" class="create-product-form">
            <div class="input-container">
                <label for="productTitle">Product Title:</label>
                <input type="text" id="productTitle" name="productTitle"
                    value="<?php echo htmlspecialchars($old['productTitle'] ?? '') ?>" required>
            </div>

            <div class="input-container">
                <label for="productDescription">Description:</label>
                <textarea id="productDescription" name="productDescription" rows="4"><?php echo htmlspecialchars($old['productDescription'] ?? '') ?></textarea>
            </div>

            <div class="input-container">
                <label for="productPrice">Price (CAD):</label>
                <input type="number" id="productPrice" name="productPrice" step="0.01"
                    value="<?php echo htmlspecialchars($old['productPrice'] ?? '') ?>" required>
            </div>

            <div class="input-container">
                <label for="productCondition">Condition:</label>
                <select id="productCondition" name="productCondition" required>
                    <option value="">Select</option>
                    <option value="New" <?php echo ($old['productCondition'] ?? '') === 'New' ? 'selected' : '' ?>>New</option>
                    <option value="Used" <?php echo ($old['productCondition'] ?? '') === 'Used' ? 'selected' : '' ?>>Used</option>
                    <option value="Refurbished" <?php echo ($old['productCondition'] ?? '') === 'Refurbished' ? 'selected' : '' ?>>Refurbished</option>
                </select>
            </div>

            <label for="productImage">Product Image:</label>
            <input type="file" id="productImage" name="productImage" accept=".jpg,.jpeg,.png,.gif" required>

            <button type="submit" class="main-btn">Create Product</button>
        </form>
    </main>
</body>

<?php include_once "./inc/templates/footer.php"; ?>

</html>