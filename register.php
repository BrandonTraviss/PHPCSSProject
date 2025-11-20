<?php
$pageTitle = "AracdiaWorks";
$pageDescription = "Explore ArcadiaWorks handcrafted vintage arcade cabinets—authentic retro gaming experiences built with modern precision. Custom designs, premium materials, and timeless nostalgia for collectors and enthusiasts.";
require_once "./inc/classes/Session.php";
require_once "./inc/templates/meta.php";
if (!Session::isLoggedIn()) {
    require_once "./inc/templates/header.php";
} else {
    require_once "./inc/templates/adminHeader.php";
}
require_once './inc/classes/Crud.php';
require_once './inc/classes/Validation.php';
$crud = new Crud();
$validation = new Validation();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formData = [
        "username" => $_POST["username"],
        "email" => $_POST["email"],
        "password" => $_POST["password"],
        "confirmPassword" => $_POST["confirmPassword"]
    ];
    $formErrors = $validation->validateRegisterForm($formData);
    $isError = false;
    var_dump($formErrors);
    foreach ($formErrors as $error) {
        if ($error !== false) {
            $isError = true;
        }
    }
    if (!$isError) {
        $crud->registerUser($formData);
        $successMessage = "Account Successfully Created";
        $_POST = [];
    }
}
?>

<body class="register-body">
    <main>
        <form action="" class="register-form" method="POST">
            <h2 class="mb-2">Register</h2>
            <div class="input-container">
                <label for="username" class="label-row-register">Username</label>
                <input id="username" class="<?php echo isset($formErrors['username']) && $formErrors['username'] !== false ? 'border-error' : ''; ?>" name="username" type="text" placeholder="Username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                <?php if (isset($formErrors['username']) && is_array($formErrors['username'])): ?>
                    <?php foreach ($formErrors['username'] as $error): ?>
                        <p class="text-error"><?php echo htmlspecialchars($error); ?></p>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="input-container">
                <label for="email" class="label-row-register">Email</label>
                <input id="email" name="email" type="email" placeholder="email" class="<?php echo isset($formErrors['email']) && $formErrors['email'] !== false ? 'border-error' : ''; ?>" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                <?php if (isset($formErrors['email']) && is_array($formErrors['email'])): ?>
                    <?php foreach ($formErrors['email'] as $error): ?>
                        <p class="text-error"><?php echo htmlspecialchars($error); ?></p>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="input-container">
                <label for="password" class="label-row-register">Password</label>
                <input id="password" name="password" type="password" placeholder="Password" class="<?php echo isset($formErrors['password']) && $formErrors['password'] !== false ? 'border-error' : ''; ?>">
                <?php if (isset($formErrors['password']) && is_array($formErrors['password'])): ?>
                    <?php foreach ($formErrors['password'] as $error): ?>
                        <p class="text-error"><?php echo htmlspecialchars($error); ?></p>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="input-container">
                <label for="confirmPassword" class="label-row-register">Confirm Password</label>
                <input id="confirmPassword" name="confirmPassword" type="password" placeholder="Confirm Password">
            </div>
            <div class="form-btn-container">
                <button class="form-btn">Register</button>
            </div>
            <p>Have an account? <a class="logo-colour no-dec" href="./login.php">Login</a></p>
        </form>
    </main>
</body>
<?php require_once "./inc/templates/footer.php" ?>