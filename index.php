<?php
require_once("include/autoloader.inc.php");

// Create object for webpage
$webpage = new Webpage("Home - TradeED", "home");

// Redirect if userID cookie is not set
if (!isset($_COOKIE["userID"])) {
    header("Location: ../pages/account.php");
    exit();
}

// Insert header
require_once("include/header.inc.php");
?>

<main>
    <!-- Hero -->
    <img class="d-block mx-auto mb-4 image-fluid w-100" src="../images/home.jfif" alt="Home" id="hero">
    <h1 class="text-center">Home Page</h1>
    <hr class="container border border-3 border-light rounded" />

    <!-- Cards -->
    <div class="container mb-5">
        <div class="row gap-2 mx-auto">
            <!-- Hotel -->
            <div class="card m-1" style="width: 26rem;">
                <img src="../images/elephant.jfif" class="card-img-top" alt="Animal Image">
                <div class="card-body">
                    <h5 class="card-title text-center border-bottom">Hotel</h5>
                    <p class="card-text">We have an on-site hotel you can book to stay in. You can do this online or in person.</p>
                    <div class="card-footer d-flex justify-content-end">
                        <a href="../pages/hotel.php" class="btn btn-outline-light">Read More</a>
                    </div>
                </div>
            </div>
            <!-- Ticket -->
            <div class="card m-1" style="width: 26rem;">
                <img src="../images/giraffe.jfif" class="card-img-top" alt="Animal Image">
                <div class="card-body">
                    <h5 class="card-title text-center border-bottom">Ticket</h5>
                    <p class="card-text">Book tickets for a visit. Loyalty points rewarded.</p>
                    <div class="card-footer d-flex justify-content-end">
                        <a href="../pages/ticket.php" class="btn btn-outline-light">Read More</a>
                    </div>
                </div>
            </div>
            <!-- Animal -->
            <div class="card m-1" style="width: 26rem;">
                <img src="../images/panda.jfif" class="card-img-top" alt="Animal Image">
                <div class="card-body">
                    <h5 class="card-title text-center border-bottom">Animals</h5>
                    <p class="card-text">Search and read about our animals. Animal information and images are provided.</p>
                    <div class="card-footer d-flex justify-content-end">
                        <a href="../pages/animal.php" class="btn btn-outline-light">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once("include/footer.inc.php"); ?>

