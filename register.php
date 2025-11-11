<?php
    $pageTitle = "AracdiaWorks";
    $pageDescription = "Explore ArcadiaWorks handcrafted vintage arcade cabinets—authentic retro gaming experiences built with modern precision. Custom designs, premium materials, and timeless nostalgia for collectors and enthusiasts.";
    include_once "./inc/templates/meta.php";
    include_once "./inc/templates/header.php";
?>
<body class="register-body">
    <main>
        <form action="" class="register-form">
            <h2 class="mb-2">Register</h2>
            <div class="input-container">
                <label for="username" class="label-row-register">Username</label>
                <input id="username" name="username" type="text" placeholder="Username">
            </div>
            <div class="input-container">
                <label for="email" class="label-row-register">Email</label>
                <input id="email" name="email" type="email" placeholder="email">
            </div>
            <div class="input-container">
                <label for="password" class="label-row-register">Password</label>
                <input id="password" name="password" type="password" placeholder="Password">                
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
<?php include_once "./inc/templates/footer.php" ?>