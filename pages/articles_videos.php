<?php
require_once("../include/autoloader.inc.php");

// Create object for webpage
$webpage = new Webpage("Articles & Videos - TradeED", "articles_videos");

// Insert header
require_once("../include/header.inc.php");
?>

<main>
    <h2 class="text-center">Articles & Videos</h2>
    <hr class="container border border-3 border-light rounded" />

    <!-- Articles Section -->
    <div class="container mt-4">
        <h3>Articles</h3>
        <div class="row">
            <!-- Example Article -->
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="../images/article1.jpg" class="card-img-top" alt="Article Image">
                    <div class="card-body">
                        <h5 class="card-title">Understanding Forex Trading</h5>
                        <p class="card-text">Learn the basics of forex trading and how to get started.</p>
                        <a href="#" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
            <!-- Add more articles as needed -->
        </div>
    </div>

    <!-- Videos Section -->
    <div class="container mt-4">
        <h3>Videos</h3>
        <div class="row">
            <!-- Example Video -->
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="../images/video1.jpg" class="card-img-top" alt="Video Thumbnail">
                    <div class="card-body">
                        <h5 class="card-title">Introduction to Forex Trading</h5>
                        <p class="card-text">Watch this introductory video to understand forex trading.</p>
                        <a href="#" class="btn btn-primary">Watch Video</a>
                    </div>
                </div>
            </div>
            <!-- Add more videos as needed -->
        </div>
    </div>
</main>

<?php require_once("../include/footer.inc.php"); ?>
