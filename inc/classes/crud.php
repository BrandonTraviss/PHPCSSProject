<?php
require_once "./inc/classes/Database.php";
class Crud extends Database
{
public function registerUser($formData)
{
    // Check if password and confirmPassword match
    if ($formData["password"] !== $formData["confirmPassword"]) {
        return false;
    }

    // Hash the password securely
    $hashedPassword = password_hash($formData["password"], PASSWORD_DEFAULT);

    // Prepare parameters
    $params = [
        ":username" => $formData["username"],
        ":email" => $formData["email"],
        ":password" => $hashedPassword
    ];

    // Clean SQL (no trailing commas)
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
        echo $e->getMessage(); // Optional: log instead of echoing
        return false;
    }
}
public function createProduct(array $formData): bool
{
    $params = [
        ":imgLink"           => $formData["imgLink"],
        ":productTitle"       => $formData["productTitle"],
        ":productDescription" => $formData["productDescription"],
        ":productPrice"       => $formData["productPrice"],
        ":productCondition"   => $formData["productCondition"]
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
}
