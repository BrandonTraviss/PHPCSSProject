<?php
    $pageTitle = "AracdiaWorks";
    $pageDescription = "Explore ArcadiaWorks handcrafted vintage arcade cabinets—authentic retro gaming experiences built with modern precision. Custom designs, premium materials, and timeless nostalgia for collectors and enthusiasts.";
    include_once "./inc/templates/meta.php";
    include_once "./inc/templates/header.php";
?>
<body class="login-body">
    <main>
        <form action="" class="login-form">
            <h2 class="mb-2">Login</h2>
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
    </main>
</body>
<?php include_once "./inc/templates/footer.php" ?>