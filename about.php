<?php
$pageTitle = "AracdiaWorks";
$pageDescription = "Explore ArcadiaWorks handcrafted vintage arcade cabinets—authentic retro gaming experiences built with modern precision. Custom designs, premium materials, and timeless nostalgia for collectors and enthusiasts.";
include_once "./inc/templates/meta.php";
include_once "./inc/templates/header.php";
?>

<body>
    <main class="about-main">
        <div class="about-main-title-container">
            <h1 class="logo-colour about-title">About ArcadiaWorks</h1>
            <p class="about-text">At ArcadiaWorks, we breathe new life into technology, refurbishing quality electrincs to reduce waste and make premium hardware accessible for everyone</p>
        </div>
        <section class="accordion">
            <details>
                <summary>Who We Are</summary>
                <p>ArcadiaWorks is a passionate team of arcade enthusiasts dedicated to reviving the golden age of gaming. We specialize in buying, selling, and refurbishing arcade cabinets that capture the spirit of classic arcades while meeting modern standards of quality and performance.</p>
            </details>

            <details>
                <summary>What We Do</summary>
                <p>We source original arcade machines, restore them to their former glory, and offer them for sale to collectors, gamers, and businesses. Our services include full cabinet refurbishment, hardware upgrades, and custom builds tailored to your space and style.</p>
            </details>

            <details>
                <summary>Our Products</summary>
                <p>Our inventory includes vintage originals, refurbished classics, and custom-built arcade cabinets. Each unit is tested for durability and gameplay quality, with optional enhancements like LED lighting, multi-game systems, and personalized artwork.
                    <a href="" class="logo-colour no-dec">Check out our shop</a>
                </p>
            </details>
            <details>
                <summary>Refurbishment Process</summary>
                <p>Every cabinet we refurbish goes through a meticulous process: cleaning, repairing, repainting, and upgrading components. We preserve the original feel while enhancing reliability, ensuring each machine is ready for years of play.
                </p>
            </details>
            <details>
                <summary>Who We Serve</summary>
                <p>We work with home arcade builders, retro gaming collectors, barcades, event organizers, and commercial venues. Whether you're looking for a nostalgic centerpiece or a fleet of machines for your business, ArcadiaWorks delivers arcade magic with style.
                </p>
            </details>
            <details>
                <summary>Get in Touch</summary>
                <p>Have a cabinet to sell? Looking for something specific? Want a custom build? Reach out through our <a href="contact.php" class="logo-colour no-dec">Contact</a> page.We're always ready to talk arcade and help you find the perfect machine.
                </p>
            </details>
        </section>
        <section>
            <h2 class="logo-colour text-centre mb-2">Meet Our Team</h2>
            <div class="profiles-container">
                <article class="about-profile">
                    <div class="about-profile-pic-container">
                        <img src="./src/img/alexCarter.png" alt="Alex Carter">
                    </div>
                    <h3 class="logo-colour-2">Alex Carter</h3>
                    <p>Founder & CEO</p>
                </article>
                <article class="about-profile">
                    <div class="about-profile-pic-container">
                        <img src="./src/img/jordanLee.png" alt="Jordan Lee">
                    </div>
                    <h3 class="logo-colour-2">Jordan Lee</h3>
                    <p>Head of Operations</p>
                </article>
                <article class="about-profile">
                    <div class="about-profile-pic-container">
                        <img src="./src/img/suzukiHiroshi.png" alt="Suzuki Hiroshi">
                    </div>
                    <h3 class="logo-colour-2">Suzuki Hiroshi</h3>
                    <p>Refurbishment Lead</p>
                </article>
            </div>
        </section>
        <section class="about-mission">
            <article class="mission-left">
                <div class="mission-svg">
                    <img src="./src/img/recycle.svg" alt="">
                </div>
                <p>Over 30,000 cabinets refurbished and saved from landfills since 2020</p>
            </article>
            <article class="mission-left">
                <div class="mission-svg">
                    <img src="./src/img/group.svg" alt="">
                </div>
                <p>Over 200,000 customers proudly served</p>
            </article>
            <article class="mission-left">
                <div class="mission-svg">
                    <img src="./src/img/donation.svg" alt="">
                </div>
                <p>Over $300,000 donated to sustainable projects</p>
            </article>
        </section>
    </main>
</body>
<?php include_once "./inc/templates/footer.php" ?>