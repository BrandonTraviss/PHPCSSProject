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
$errorMessage = '';
$errors = [];
$old = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old = [
        "productTitle" => $_POST["productTitle"],
        "productDescription" => $_POST["productDescription"],
        "productPrice" => $_POST["productPrice"],
        "productCondition" => $_POST["productCondition"]
    ];
    $formErrors = $validation->validateProductForm($old);
    if (!empty($formErrors)) {
        $errors = $formErrors;
        $errorMessage = "Please fix the errors below.";
    } else {
        $fileData = $_FILES['productImage'];

        if ($fileData['error'] !== UPLOAD_ERR_OK) {
            $errorMessage = "Upload error: " . $fileData['error'];
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
}
?>
<?php require_once "./inc/classes/Session.php"; ?>
<?php include_once "./inc/templates/meta.php"; ?>
<?php if(!Session::isLoggedIn()){
    require_once "./inc/templates/header.php";
} else {
    require_once "./inc/templates/adminHeader.php";
}?>
<?php if (!Session::isLoggedIn()) {
    header("Location:login.php");
    exit;
}
?>

<body>
    <main class="create-product-main">
        <h2 style="text-align:center;">Add a New Product</h2>

        <?php if ($successMessage): ?>
            <p class="logo-colour"><?php echo $successMessage ?></p>
        <?php elseif ($errorMessage): ?>
            <p class="error-colour"><?php echo $errorMessage ?></p>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
            <div class="message error">
                <?php foreach ($errors as $field => $msg): ?>
                    <p class="error-colour"><?php echo htmlspecialchars($msg) ?></p>
                <?php endforeach; ?>
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

            <div class="input-container">
                <label for="productImage">Product Image:</label>
                <input type="file" id="productImage" name="productImage" accept=".jpg,.jpeg,.png,.gif" required>
                <img id="imagePreview" src="#" alt="Image Preview" style="display:none; max-width:300px; margin-top:10px; border:1px solid #ccc; padding:5px;">
            </div>

            <button type="submit" class="main-btn">Create Product</button>
        </form>
    </main>
</body>

<?php require_once "./inc/templates/footer.php"; ?>

</html>