<?php
    $pageTitle = "AracdiaWorks";
    $pageDescription = "Explore ArcadiaWorks handcrafted vintage arcade cabinets—authentic retro gaming experiences built with modern precision. Custom designs, premium materials, and timeless nostalgia for collectors and enthusiasts.";
    require_once "./inc/classes/Session.php";
    include_once "./inc/templates/meta.php";
if(!Session::isLoggedIn()){
    require_once "./inc/templates/header.php";
} else {
    require_once "./inc/templates/adminHeader.php";
}
?>
<body>
    <main class="contact-main">
        <form class="contact-form" action="">
            <h1 class="logo-colour">Contact Us</h1>
            <p class="contact-intro">
            Whether you're a retro gaming enthusiast, a collector, or just curious about our handcrafted cabinets, we'd love to hear from you. Fill out the form below and we'll get back to you within 1–2 business days.
            </p>
            <div class="input-container">
                <label for="firstName" class="label-row-login">First Name</label>
                <input id="firstName" name="firstName" type="text" placeholder="First Name">
            </div>
            <div class="input-container">
                <label for="lastName" class="label-row-login">Last Name</label>
                <input id="lastName" name="lastName" type="text" placeholder="Last Name">                
            </div>
            <div class="input-container">
                <label for="email" class="label-row-login">Email</label>
                <input id="email" name="email" type="email" placeholder="Email">                
            </div>
            <label for="message">Message</label>
            <textarea name="message" id="message" placeholder="Enter your message"></textarea>
            <button class="stretch-btn">Send Message</button>
        </form>
    </main>
</body>
<?php require_once "./inc/templates/footer.php" ?>