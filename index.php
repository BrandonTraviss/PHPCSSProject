<?php
$pageTitle = "ArcadiaWorks";
$pageDescription = "Welcome to the ArcadiaWorks your one stop shop for arcade cabs";
require_once "./inc/classes/Session.php";
require_once "./inc/templates/meta.php";
if (!Session::isLoggedIn()) {
    require_once "./inc/templates/header.php";
} else {
    require_once "./inc/templates/adminHeader.php";
}
?>

<body class="index-body">
    <main class="index-main">

        <section class="index-hero">
            <article class="hero-card fade-in-up">
                <h1>REVIVE THE GOLDEN AGE OF GAMING</h1>
                <p>Rediscover the thrill of classic arcade gaming. Our handcrafted cabinets combine vintage design with modern durability. Step into nostalgia and play like it's 1985.</p>
                <a href="./shop.php" class="main-btn">OUR SHOP</a>
            </article>
        </section>

        <section class="value-prop">
            <h2>Why Shop ArcadiaWorks?</h2>
            <div class="value-container">
                <article class="value-item">
                    <img src="./src/img/hands.svg" alt="Handcrafted Builds Icon">
                    <h3>Handcrafted Builds</h3>
                    <p>Every cabinet is built by master artisans who share your love for the classics.</p>
                </article>
                <article class="value-item">
                    <img src="./src/img/retro.svg" alt="Retro Accuracy Icon">
                    <h3>Retro Accuracy</h3>
                    <p>Play the games you remember, faithfully recreated just as you remember them.</p>
                </article>
                <article class="value-item">
                    <img src="./src/img/trusted.svg" alt="Modern Durability Icon">
                    <h3>Modern Durability</h3>
                    <p>Built to last, our cabinets offer the perfect fusion of vintage charm and cutting-edge quality.</p>
                </article>
            </div>
        </section>

        <section class="testimonials">
            <h2>Testimonials</h2>
            <div class="testimonial-container">

                <article class="testimonial">
                    <blockquote>
                        "Reliving the classics has become my stress release. It's like I have my own personal slice of the '80s here at home."
                    </blockquote>
                    <p class="name-location">
                        <span class="name">Angela Brooks</span>, <span class="location">Barrie, ON</span>
                    </p>
                </article>

                <article class="testimonial">
                    <blockquote>
                        "Every time I fire up my cabinet, it's pure nostalgia. ArcadiaWorks nailed it!"
                    </blockquote>
                    <p class="name-location">
                        <span class="name">Brent Warwick</span>, <span class="location">Toronto, ON</span>
                    </p>
                </article>


                <article class="testimonial">
                    <blockquote>
                        "From the joystick feel to the CRT glow, it's like the arcade never left. ArcadiaWorks brought it all back."
                    </blockquote>
                    <p class="name-location">
                        <span class="name">Brian Baker</span>, <span class="location">Midland, ON</span>
                    </p>
                </article>


                <article class="testimonial">
                    <blockquote>
                        "It's like stepping into my childhood arcade-every sound, every pixel, perfectly preserved."
                    </blockquote>
                    <p class="name-location">
                        <span class="name">Steve White</span>, <span class="location">Orillia, ON</span>
                    </p>
                </article>

            </div>
            <a href="./shop.php" class="main-btn">SHOP NOW</a>
        </section>

    </main>
</body>
<?php
require_once "./inc/templates/footer.php";
?>