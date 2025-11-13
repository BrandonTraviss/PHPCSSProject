<?php
class Validation
{
    // Validates Image returns false or file path
    public function validateImage(array $fileData)
    {
        if (empty($fileData['name'])) {
            return false;
        }

        $fileName = $fileData['name'];
        $fileSize = $fileData['size'];
        $fileError = $fileData['error'];

        if ($fileError !== 0) {
            return false;
        }

        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if ($fileExt === 'svg' || !in_array($fileExt, $allowed)) {
            return false;
        }

        $maxSize = 2 * 1024 * 1024;
        if ($fileSize > $maxSize) {
            return false;
        }

        return $fileExt;
    }
    // Validates Price returns true or false
    public function validatePrice($price)
    {
        return is_numeric($price) && $price > 0;
    }
    // Validates Product Title returns true or false
    public function validateProductTitle($title)
    {
        $title = trim($title);
        return strlen($title) > 0 && strlen($title) <= 100;
    }
    // Validates Description returns true or false
    public function validateProductDescription($description)
    {
        $description = trim($description);
        return strlen($description) <= 255;
    }
    // Validates Condition returns true or false
    public function validateCondition($condition)
    {
        $validConditions = ['New', 'Used', 'Refurbished'];
        return in_array($condition, $validConditions, true);
    }
    // Used to Validate all form data and add appropriate message
    public function validateProductForm(array $formData)
{
    $errors = [];

    if (!$this->validateProductTitle($formData['productTitle'])) {
        $errors['productTitle'] = "Title must be 1–100 characters.";
    }

    if (!$this->validateProductDescription($formData['productDescription'])) {
        $errors['productDescription'] = "Description must be under 255 characters.";
    }

    if (!$this->validatePrice($formData['productPrice'])) {
        $errors['productPrice'] = "Price must be a positive number.";
    }

    if (!$this->validateCondition($formData['productCondition'])) {
        $errors['productCondition'] = "Condition must be New, Used, or Refurbished.";
    }

    return $errors;
}
}
