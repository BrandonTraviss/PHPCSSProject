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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fileData = $_FILES['productImage'];
    $fileExt = $validation->validateImage($fileData);

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

            if ($crud->createProduct($formData)) {
                $successMessage = "Product created successfully!";
            } else {
                $errorMessage = "Failed to create product.";
            }
        } else {
            $errorMessage = "File upload failed.";
        }
    } else {
        $errorMessage = "Invalid image file.";
    }
}
?>

<?php 
    include_once "./inc/templates/meta.php";
    include_once "./inc/templates/header.php";
?>

<h2 style="text-align:center;">Add a New Product</h2>

<?php if ($successMessage): ?>
    <div class="message success"><?= $successMessage ?></div>
<?php elseif ($errorMessage): ?>
    <div class="message error"><?= $errorMessage ?></div>
<?php endif; ?>

<form action="" method="POST" enctype="multipart/form-data">
    <label for="productTitle">Product Title:</label>
    <input type="text" id="productTitle" name="productTitle" required>

    <label for="productDescription">Description:</label>
    <textarea id="productDescription" name="productDescription" rows="4"></textarea>

    <label for="productPrice">Price (CAD):</label>
    <input type="number" id="productPrice" name="productPrice" step="0.01" required>

    <label for="productCondition">Condition:</label>
    <select id="productCondition" name="productCondition" required>
        <option value="">Select</option>
        <option value="New">New</option>
        <option value="Used">Used</option>
        <option value="Refurbished">Refurbished</option>
    </select>

    <label for="productImage">Product Image:</label>
    <input type="file" id="productImage" name="productImage" accept=".jpg,.jpeg,.png,.gif" required>

    <button type="submit">Create Product</button>
</form>

</body>
</html>