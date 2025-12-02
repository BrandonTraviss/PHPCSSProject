<?php
$pageTitle = "AracdiaWorks";
$pageDescription = "Explore ArcadiaWorks handcrafted vintage arcade cabinets—authentic retro gaming experiences built with modern precision. Custom designs, premium materials, and timeless nostalgia for collectors and enthusiasts.";
require_once "./inc/classes/Session.php";
require_once "./inc/classes/crud.php";
require_once "./inc/templates/meta.php";
?>

<body class="login-body">
    <?php
    if (!Session::isLoggedIn()) {
        require_once "./inc/templates/header.php";
    } else {
        require_once "./inc/templates/adminHeader.php";
    }
    if (Session::isLoggedIn()) {
        header('Location:viewProducts.php');
        exit;
    }
    $error = '';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $crud = new Crud;
        $username = $_POST['username'];
        $password = $_POST['password'];
        $user = $crud->login($username, $password);
        if ($user) {
            Session::set("user_id", $user['ID']);
            Session::set('username', $user['username']);
            header('Location:viewProducts.php');
            exit;
        } else {
            $error = "Invalid Username or Password";
        }
    }
    ?>
    <main class="login-main">
        <div>
            <form action="login.php" class="login-form" method="POST">
                <h2 class="mb-2">Login</h2>
                <?php if ($error): ?>
                    <p class="text-error">Invalid Username or Password</p>
                <?php endif; ?>
                <div class="input-container">
                    <label for="username" class="label-row-login">Username</label>
                    <input id="username" name="username" type="text" placeholder="Username">
                </div>
                <div class="input-container">
                    <label for="password" class="label-row-login">Password</label>
                    <input id="password" name="password" type="password" placeholder="Password">
                </div>

                <div class="form-btn-container">
                    <button class="form-btn">Login</button>
                </div>
                <p>Need an account? <a class="logo-colour no-dec" href="./register.php">Register</a></p>
            </form>
        </div>
    </main>
    <?php require_once "./inc/templates/footer.php" ?>