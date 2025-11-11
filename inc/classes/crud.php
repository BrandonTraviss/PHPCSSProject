<?php
require_once "./inc/classes/Database.php";
class Crud extends Database
{
public function registerUser($formData)
{
    if ($formData["password"] !== $formData["confirmPassword"]) {
        return false;
    }

    $hashedPassword = password_hash($formData["password"], PASSWORD_DEFAULT);

    $params = [
        ":username" => $formData["username"],
        ":email" => $formData["email"],
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
