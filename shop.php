<?php
    $pageTitle = "AracdiaWorks";
    $pageDescription = "Explore ArcadiaWorks handcrafted vintage arcade cabinets—authentic retro gaming experiences built with modern precision. Custom designs, premium materials, and timeless nostalgia for collectors and enthusiasts.";
    include_once "./inc/templates/meta.php";
    include_once "./inc/templates/header.php";
?>
<body>
    <main>
        <section>
            <h1 class="featured-title">F<span class="logo-colour-2">eatured</span>  A<span class="logo-colour-2">rcade</span>  M<span class="logo-colour-2">achine</span></h1>
            <!-- Randomly Selected from products -->
            <article class="featured-product">
                <div class="featured-left">
                    <!-- Grab from Database -->
                    <h1 class="featured-product-title">Pacman</h1>
                    <div class="featured-img-container">
                        <!-- Grab from Database -->
                        <img src="./upload/pacman.png" alt="">
                    </div>
                </div>
                <div class="featured-right">
                    <h2 class="logo-colour">Description</h2>
                    <!-- Grab from Database -->
                    <p class="featured-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde sunt ducimus magni, dignissimos enim quis, at vero, omnis voluptates laboriosam amet ex nesciunt consequuntur. Quas, doloribus eligendi. Ab iure eius sapiente, at, quas natus eligendi perspiciatis officia eveniet beatae unde ad ex temporibus delectus, voluptatum vitae veniam obcaecati sequi impedit.</p>
                    <!-- Grab from Database -->
                    <h3 class="logo-colour-2">Condition: Refurbished</h3>
                    <div class="featured-cart-price">
                        <a href="" class="main-btn">Add To Cart</a>
                        <!-- Grab from Database -->
                        <p class="featured-price">$599.99</p>
                    </div>
                </div>
            </article>
        </section>

        <section class="products-list">
            <h2 class="products-header">A<span class="logo-colour-2">rcade</span> M<span class="logo-colour-2">achines</span></h2>
            <div class="products-container">
        <!-- Card information pulled from Database -->
                <article class="product-card">
                    <h2 class="logo-colour-2">Double Dragon</h2>
                    <div class="product-card-img-container">
                        <img src="./upload/doubledragon.png" alt="">
                    </div>
                    <p class="product-card-price">$630.99</p>
                    <div class="product-card-links">
                        <a href="" class="dark-btn">More Details</a>
                        <a href="" class="main-btn">Add To Cart</a>
                    </div>
                </article>
            <!-- Card information pulled from Database -->
                <article class="product-card">
                    <h2 class="logo-colour-2">Dungeons & Dragons</h2>
                    <div class="product-card-img-container">
                        <img src="./upload/dungeonsDragons.png" alt="Dungeons & Dragons">
                    </div>
                    <p class="product-card-price">$729.89</p>
                    <div class="product-card-links">
                        <a href="" class="dark-btn">More Details</a>
                        <a href="" class="main-btn">Add To Cart</a>
                    </div>
                </article>
            <!-- Card information pulled from Database -->
                <article class="product-card">
                    <h2 class="logo-colour-2">Gauntlet Legends</h2>
                    <div class="product-card-img-container">
                        <img src="./upload/gauntletLegends.png" alt="Gauntlet Legends">
                    </div>
                    <p class="product-card-price">$729.89</p>
                    <div class="product-card-links">
                        <a href="" class="dark-btn">More Details</a>
                        <a href="" class="main-btn">Add To Cart</a>
                    </div>
                </article>
            <!-- Card information pulled from Database -->
                <article class="product-card">
                    <h2 class="logo-colour-2">Rampage World Tour</h2>
                    <div class="product-card-img-container">
                        <img src="./upload/rampageWorldTour.png" alt="Rampage World Tour">
                    </div>
                    <p class="product-card-price">$830.99</p>
                    <div class="product-card-links">
                        <a href="" class="dark-btn">More Details</a>
                        <a href="" class="main-btn">Add To Cart</a>
                    </div>
                </article>
            <!-- Card information pulled from Database -->
                <article class="product-card">
                    <h2 class="logo-colour-2">Tekken</h2>
                    <div class="product-card-img-container">
                        <img src="./upload/tekken.png" alt="Tekken">
                    </div>
                    <p class="product-card-price">$579.99</p>
                    <div class="product-card-links">
                        <a href="" class="dark-btn">More Details</a>
                        <a href="" class="main-btn">Add To Cart</a>
                    </div>
                </article>
            <!-- Card information pulled from Database -->
                <article class="product-card">
                    <h2 class="logo-colour-2">Time Crisis</h2>
                    <div class="product-card-img-container">
                        <img src="./upload/timeCrisis.png" alt="">
                    </div>
                    <p class="product-card-price">$985.99</p>
                    <div class="product-card-links">
                        <a href="" class="dark-btn">More Details</a>
                        <a href="" class="main-btn">Add To Cart</a>
                    </div>
                </article>
            </div>
        </section>
    </main>
</body>
<?php include_once "./inc/templates/footer.php" ?>