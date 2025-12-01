<?php
class Validation
{
    private $crud;
    public function __construct()
    {
        $this->crud = new Crud();
    }
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
    // This function is used to ensure a value is numeric. Used for Dimensions, Weight and Screensize
    public function validateIsNumberGreaterThanZero($value)
    {
        return is_numeric($value) && $value > 0;
    }
    // Used to ensure a valid manufacturer is set which means a length less than 100
    public function validateManufacturer($manufacturer)
    {
        return is_string($manufacturer) && strlen(trim($manufacturer)) > 0 && strlen(trim($manufacturer)) < 100;
    }
    // Ensures CRT or LCD are selected for screen type
    public function validateScreenType($screenType)
    {
        $validType = ['CRT', 'LCD'];
        return in_array($screenType, $validType, true);
    }
    // Used to Validate all form data and add appropriate message
    public function validateProductForm(array $formData)
    {
        $errors = [];

        if (!$this->validateProductTitle($formData['productTitle'])) {
            $errors['productTitle'] = "Title must be 1-100 characters.";
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
        if (!$this->validateIsNumberGreaterThanZero($formData['productScreenSize'])) {
            $errors['productScreenSize'] = "Screen size must be a number greater than 0.";
        }
        if (!$this->validateIsNumberGreaterThanZero($formData['productWidth'])) {
            $errors['productDimensions'] = "Dimensions must be a number greater than 0.";
        }
        if (!$this->validateIsNumberGreaterThanZero($formData['productHeight'])) {
            $errors['productDimensions'] = "Dimensions must be a number greater than 0.";
        }
        if (!$this->validateIsNumberGreaterThanZero($formData['productDepth'])) {
            $errors['productDimensions'] = "Dimensions must be a number greater than 0.";
        }
        if (!$this->validateManufacturer($formData['productManufacturer'])) {
            $errors['productManufacturer'] = "Manufacturer must be 1-100 characters.";
        }
        if (!$this->validateIsNumberGreaterThanZero($formData['productWeight'])) {
            $errors['productWeight'] = "Weight must be a number greater than 0.";
        }
        return $errors;
    }
    // Validates Registering a User
    public function validateRegisterForm(array $formData)
    {
        $usernameError = $this->validateUsername($formData['username']);
        $emailError = $this->validateEmail($formData['email']);
        $passwordError = $this->validatePassword($formData['password'], $formData['confirmPassword']);

        $errors = [
            'username' => $usernameError,
            'email' => $emailError,
            'password' => $passwordError
        ];
        return $errors;
    }
    // Validates username
    public function validateUsername($username)
    {
        $errors = [];
        if ($this->crud->getUser($username)) {
            $errors[] = "Username is already taken.";
        }
        if (strlen($username) > 20) {
            $errors[] = "Username cannot exceed 20 characters in length.";
        }
        if (strpos($username, ' ')) {
            $errors[] = "Username cannot contain spaces.";
        }
        if (empty($errors)) {
            return false;
        }
        return $errors;
    }
    // Validates Email
    public function validateEmail($email)
    {
        $errors = [];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid Email Address.";
        }
        if ($this->crud->getUserByEmail($email)) {
            $errors[] = "Email Address Taken.";
        }
        if (empty($errors)) {
            return false;
        }
        return $errors;
    }
    // Validates Password
    public function validatePassword($password, $confirmPassword)
    {
        $errors = [];
        if ($password !== $confirmPassword) {
            $errors[] = "Passwords do not match.";
        }
        if (strlen($password) < 8) {
            $errors[] = "Password must be atleast 8 characters in length and cannot contain a space.";
        }
        if (strpos($password, ' ')) {
            $errors = "Password must not contain spaces.";
        }
        if (empty($errors)) {
            return false;
        }
        return $errors;
    }
}
