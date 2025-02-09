<?php
require_once("include/autoloader.inc.php");

// Create object for webpage
$webpage = new Webpage("Home - TradeED", "home");

// Redirect if userID cookie is not set
if (!isset($_COOKIE["userID"])) {
    header("Location: pages/account.php");
    exit();
}

// Insert header
require_once("include/header.inc.php");
?>

<main>
    <h1 class="text-center">Welcome to TradeED</h1>
    <hr class="container border border-3 border-light rounded" />

    <!-- Hero Section -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <h2>Start Trading Today</h2>
                <p>Join TradeED and start your forex trading journey with our comprehensive tools and resources.</p>
                <a href="pages/sandbox.php" class="btn btn-primary">Try Sandbox</a>
            </div>
            <div class="col-md-6">
                <img src="images/home.jfif" class="img-fluid" alt="Trading Image">
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4 text-center">
                <h3>Learn</h3>
                <p>Access articles and videos to learn about forex trading.</p>
                <a href="pages/articles_videos.php" class="btn btn-secondary">Learn More</a>
            </div>
            <div class="col-md-4 text-center">
                <h3>Trade</h3>
                <p>Use our trading platform to practice and improve your skills.</p>
                <a href="pages/sandbox.php" class="btn btn-secondary">Start Trading</a>
            </div>
            <div class="col-md-4 text-center">
                <h3>Community</h3>
                <p>Join our community of traders and share your experiences.</p>
                <a href="pages/profile.php" class="btn btn-secondary">Join Community</a>
            </div>
        </div>
    </div>
</main>

<?php require_once("include/footer.inc.php"); ?>

