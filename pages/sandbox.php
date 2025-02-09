
<?php
require_once("../include/autoloader.inc.php");

// Create object for webpage
$webpage = new Webpage("Sandbox - TradeED", "sandbox");

// Insert header
require_once("../include/header.inc.php");
?>

<main>
    <h2 class="text-center">Trading Sandbox</h2>
    <hr class="container border border-3 border-light rounded" />

    <!-- Trading Graph -->
    <div class="container">
        <canvas id="stockChart" width="800" height="400"></canvas>
    </div>

    <!-- Trading Simulation Controls -->
    <div class="container mt-3 text-center">
        <button class="btn btn-primary" id="startSimulation">Start Simulation</button>
        <button class="btn btn-secondary" id="stopSimulation">Stop Simulation</button>
    </div>

    <!-- Trading Simulation Info -->
    <div class="container mt-3">
        <div id="simulationInfo" class="alert alert-info" role="alert">
            Simulation is not running. Click "Start Simulation" to begin.
        </div>
    </div>
</main>

<script src="../scripts/api.js"></script>
<script>
    // JavaScript to handle simulation controls
    document.getElementById('startSimulation').addEventListener('click', function() {
        document.getElementById('simulationInfo').innerText = 'Simulation is running...';
        // Add logic to start the simulation
    });

    document.getElementById('stopSimulation').addEventListener('click', function() {
        document.getElementById('simulationInfo').innerText = 'Simulation is stopped.';
        // Add logic to stop the simulation
    });
</script>

<?php require_once("../include/footer.inc.php"); ?>
