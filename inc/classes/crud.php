<?php
require_once "./inc/classes/Database.php";
require_once "./inc/classes/Validation.php";

class Crud extends Database
{
    public function registerUser($formData): bool
    {
        if ($formData["password"] !== $formData["confirmPassword"]) {
            return false;
        }

        $hashedPassword = password_hash($formData["password"], PASSWORD_DEFAULT);

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

public function createProduct(array $formData)
{
    $params = [
        ":imgLink"           => $formData["imgLink"],
        ":productTitle"      => $formData["productTitle"],
        ":productDescription"=> $formData["productDescription"],
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

    public function getAllProducts(): array
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

    public function getProduct(int $id): array|false
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

    public function updateProduct(int $id, array $formData): bool|array
    {
        $validator = new Validation();
        $errors = [];

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

        $params = [
            ":imgLink"           => $formData["imgLink"],
            ":productTitle"      => $formData["productTitle"],
            ":productDescription" => $formData["productDescription"],
            ":productPrice"      => $formData["productPrice"],
            ":productCondition"  => $formData["productCondition"],
            ":id"                => $id
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

    public function deleteProduct(int $id): bool
    {
        $sql = "DELETE FROM products WHERE ID = :id";

        try {
            $stmt = $this->pdo->prepare($sql);
            $fileHandler = new FileHandler();
            $product = $this->getProduct($id);
            $fileHandler->deleteImage($product['imgLink']);
            return $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            return false;
        }
    }
}
