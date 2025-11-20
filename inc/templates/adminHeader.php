<header>
    <nav>
        <div class="admin-nav-container">
            <a href="./index.php" class="logo-nav"><img class="nav-logo" src="./src/img/darkThemeLogo.png" alt="Home"></a>
            <p><?php echo htmlspecialchars(Session::get('username')); ?></p>
        </div>
        <menu class="desktop-menu">
            <li><a href="./shop.php">Shop</a></li>
            <li><a href="./createproduct.php">Create Product</a></li>
            <li><a href="./viewproducts.php">View Products</a></li>
            <li><a href="./logout.php">Logout</a></li>
        </menu>
        <menu class="mobile-menu hidden">
            <li><a href="./shop.php">Shop</a></li>
            <li><a href="./createproduct.php">Create Product</a></li>
            <li><a href="./viewproducts.php">View Products</a></li>
            <li><a href="./logout.php">Logout</a></li>
        </menu>
        <div class="menu-icon-container">
            <img id="menuIcon" src="./src/img/hamburger.svg" alt="Hamburger">
        </div>
    </nav>
</header>