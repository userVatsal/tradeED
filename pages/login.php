<?php
require_once("../include/autoloader.inc.php");

// Create object for webpage
$webpage = new Webpage("Login - TradeED", "login");

// Create object for account
$account = new Account($_POST["firstName"] ?? '', $_POST["lastName"] ?? '', $_POST["email"] ?? '', $_POST["password"] ?? '', $_POST["password2"] ?? '');

// Validation request on button press
if (isset($_POST['loginBtn'])) {
    // Validate & login
    $account->validateLogin();
}

// Redirect if userID cookie is set
if (isset($_COOKIE["userID"])) {
    header("Location: ../pages/profile.php");
    exit();
}

// Insert header
require_once("../include/header.inc.php");
?>

<main>
    <h2 class="text-center">Login</h2>
    <hr class="container border border-3 border-light rounded" />

    <div class="container">
        <form class="row needs-validation d-flex justify-content-center" method="post" novalidate>
            <!-- Email -->
            <span class="fs-5 ms-2">Email<span class="text-danger">*</span></span>
            <div class="input-group mb-3 has-validation">
                <span class="input-group-text">Email</span>
                <input name="email" type="text" class="form-control <?php if (isset($_POST["loginBtn"])) echo $account->getError("email"); ?>" value="<?php if (isset($_POST["loginBtn"])) echo $account->getValue("email"); ?>" placeholder="Email" aria-label="Email">
                <div class="invalid-feedback">
                    Email is invalid.
                </div>
            </div>

            <!-- Password -->
            <span class="fs-5 ms-2">Password<span class="text-danger">*</span></span>
            <div class="input-group mb-3 has-validation">
                <span class="input-group-text">Password</span>
                <input name="password" type="password" class="form-control <?php if (isset($_POST["loginBtn"])) echo $account->getError("password"); ?>" value="<?php if (isset($_POST["loginBtn"])) echo $account->getValue("password"); ?>" placeholder="Password" aria-label="Password">
                <div class="invalid-feedback">
                    Password must be more than 5 characters and less than 40.
                </div>
            </div>

            <!-- Submit Button -->
            <button name="loginBtn" type="submit" class="btn btn-light col-6">Login</button>
        </form>

        <div class="container d-flex col justify-content-center mt-3">
            <hr class="w-25">
            <div class="text-center mx-4">Or Login Using</div>
            <hr class="w-25">
        </div>

        <div class="container d-flex justify-content-center col-12 text-center mt-3 mb-3 gap-3">
            <button type="button" class="btn btn-outline-success">Google</button>
            <button type="button" class="btn btn-outline-light">Twitter</button>
            <button type="button" class="btn btn-outline-primary">Facebook</button>
        </div>

        <div class="text-center">Don't have an account? <a href="signup.php">Create Now.</a></div>
    </div>
</main>

<?php require_once("../include/footer.inc.php"); ?>

