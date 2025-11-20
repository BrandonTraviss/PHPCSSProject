<?php
require_once "./inc/classes/Database.php";
require_once "./inc/classes/Validation.php";

class Crud extends Database
{
    // Register User 
    public function registerUser($formData)
    {
        // Compares password and confirmPassword
        if ($formData["password"] !== $formData["confirmPassword"]) {
            return false;
        }
        // hashes password for storing in Database
        $hashedPassword = password_hash($formData["password"], PASSWORD_DEFAULT);
        // Create assoc array to use as params
        $params = [
            ":username" => $formData["username"],
            ":email"    => $formData["email"],
            ":password" => $hashedPassword
        ];

        $sql = "INSERT INTO users (
                    username,
                    email,
                    password
                ) VALUES (
                    :username,
                    :email,
                    :password
                )";

        try {
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // Get User by username
    public function getUser($username) {
        $sql = "SELECT * FROM users WHERE username = :username LIMIT 1";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':username' => $username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user ?: false;
        } catch (PDOException $e) {
            return false;
        }
    }
    // Get User by Email
        public function getUserByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user ?: false;
        } catch (PDOException $e) {
            return false;
        }
    }
    // Create Product
    public function createProduct(array $formData)
    {
        // Assoc array to be used in prepared statement
        // Validation for inputs is done in createproduct.php
        $params = [
            ":imgLink"           => $formData["imgLink"],
            ":productTitle"      => $formData["productTitle"],
            ":productDescription" => $formData["productDescription"],
            ":productPrice"      => $formData["productPrice"],
            ":productCondition"  => $formData["productCondition"]
        ];

        $sql = "INSERT INTO products (
                imgLink,
                productTitle,
                productDescription,
                productPrice,
                productCondition
            ) VALUES (
                :imgLink,
                :productTitle,
                :productDescription,
                :productPrice,
                :productCondition
            )";

        try {
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            return false;
        }
    }
    // Get All Products
    public function getAllProducts()
    {
        $sql = "SELECT * FROM products ORDER BY ID DESC";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }
    // Get Singular Product
    public function getProduct(int $id)
    {
        $sql = "SELECT * FROM products WHERE ID = :id LIMIT 1";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id' => $id]);
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
            return $product ?: false;
        } catch (PDOException $e) {
            return false;
        }
    }
    // Update Product
    public function updateProduct(int $id, array $formData)
    {
        $validator = new Validation();
        $errors = [];
        // Validate inputs, image validation is done inside editproduct.php
        if (!$validator->validateProductTitle($formData['productTitle'])) {
            $errors['productTitle'] = "Title must be 1–100 characters.";
        }

        if (!$validator->validateProductDescription($formData['productDescription'])) {
            $errors['productDescription'] = "Description must be under 255 characters.";
        }

        if (!$validator->validatePrice($formData['productPrice'])) {
            $errors['productPrice'] = "Price must be a positive number.";
        }

        if (!$validator->validateCondition($formData['productCondition'])) {
            $errors['productCondition'] = "Condition must be New, Used, or Refurbished.";
        }

        if (!empty($errors)) {
            return $errors;
        }
        // Get product information stored in database to check if the imgLink has changed
        $product = $this->getProduct($id);
        $newImgLink = $formData["imgLink"];

        if (!empty($product['imgLink']) && $product['imgLink'] !== $newImgLink) {
            $fileHandler = new FileHandler();
            $fileHandler->deleteImage($product['imgLink']);
        }
        // Params to be used in query
        $params = [
            ":imgLink"            => $newImgLink,
            ":productTitle"       => $formData["productTitle"],
            ":productDescription" => $formData["productDescription"],
            ":productPrice"       => $formData["productPrice"],
            ":productCondition"   => $formData["productCondition"],
            ":id"                 => $id
        ];

        $sql = "UPDATE products SET
                imgLink = :imgLink,
                productTitle = :productTitle,
                productDescription = :productDescription,
                productPrice = :productPrice,
                productCondition = :productCondition
            WHERE ID = :id";

        try {
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            return false;
        }
    }
    // Delete Product
    public function deleteProduct(int $id)
    {
        $sql = "DELETE FROM products WHERE ID = :id";

        try {
            $stmt = $this->pdo->prepare($sql);
            // Delete the file from the uploads directory
            $fileHandler = new FileHandler();
            $product = $this->getProduct($id);
            $fileHandler->deleteImage($product['imgLink']);
            return $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            return false;
        }
    }
}
