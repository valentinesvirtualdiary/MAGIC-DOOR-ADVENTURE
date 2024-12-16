<?php
// Start the session
session_start();

// Reset the story when "Restart" is clicked
if (isset($_GET['restart'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}

// Initialize variables
$showInstructions = false;
if (isset($_GET['instructions'])) {
    $showInstructions = true;
}

// Initialize story stage if not set
if (!isset($_SESSION['stage'])) {
    $_SESSION['stage'] = 0;
}
if (!isset($_SESSION['substage'])) {
    $_SESSION['substage'] = 0;
}

// Handle door choices
if (isset($_GET['choice'])) {
    $choice = $_GET['choice'];
    if ($choice == 'door1') {
        $_SESSION['stage'] = 1;
        $_SESSION['substage'] = 0;
    } elseif ($choice == 'door2') {
        $_SESSION['stage'] = 2;
        $_SESSION['substage'] = 0;
    } elseif ($choice == 'door3') {
        $_SESSION['stage'] = 3;
        $_SESSION['substage'] = 0;
    }
}

// Handle sub-choices
if (isset($_GET['subchoice'])) {
    $_SESSION['substage'] = $_GET['subchoice'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magic Door Adventure</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Magic Door Adventure</h1>

        <?php if ($showInstructions): ?>
            <!-- Instructions Page -->
            <div class="instructions">
                <h2>How to Play</h2>
                <p>Welcome to the Magic Door Adventure! Here's how you play:</p>
                <ul>
                    <li>Choose one of the three magical doors to start your adventure.</li>
                    <li>Each door leads to a unique story with different outcomes.</li>
                    <li>After choosing a door, make further choices to progress the story.</li>
                    <li>You can restart the adventure at any time.</li>
                </ul>
                <p>Have fun and enjoy exploring the different possibilities!</p>
                <a href="index.php" class="button">Back to Game</a>
            </div>
        <?php elseif ($_SESSION['stage'] == 0): ?>
            <!-- Main Game Start -->
            <p class="intro-text">Three magical doors stand before you. Each holds a different destiny. Choose wisely...</p>
            <div class="doors">
                <a href="?choice=door1" class="door" id="door1">
                    <p>Door of Gold</p>
                </a>
                <a href="?choice=door2" class="door" id="door2">
                    <p>Enchanted Forest</p>
                </a>
                <a href="?choice=door3" class="door" id="door3">
                    <p>Dungeon of Dragons</p>
                </a>
            </div>
        <?php else: ?>
            <!-- Story Logic -->
            <?php if ($_SESSION['stage'] == 1): ?>
                <?php if ($_SESSION['substage'] == 0): ?>
                    <p>You entered the <strong>Door of Gold</strong> and found a treasure chest. Do you:</p>
                    <img src="images/chest.jpg" alt="Treasure Chest" class="substage-image">

                    <ul>
                        <li><a href="?subchoice=1">Open the chest</a></li>
                        <li><a href="?subchoice=2">Leave the treasure and look for another path</a></li>
                    </ul>
                <?php elseif ($_SESSION['substage'] == 1): ?>
                    <p>You opened the chest and found a mountain of gold! You're rich!</p>
                    <img src="images/gold1.jpg" alt="Gold" class="substage-image">
                <?php elseif ($_SESSION['substage'] == 2): ?>
                    <p>You left the treasure and found a secret door leading to another adventure.</p>
                    <img src="images/secret.jpg" alt="Secret Door" class="substage-image">
                <?php endif; ?>
            <?php elseif ($_SESSION['stage'] == 2): ?>
                <?php if ($_SESSION['substage'] == 0): ?>
                    <p>You entered the <strong>Enchanted Forest</strong>. Fairies surround you. Do you:</p>
                    <img src="images/farries.jpg" alt="Enchanted Forest" class="substage-image">
                    <ul>
                        <li><a href="?subchoice=1">Follow the fairies deeper into the forest</a></li>
                        <li><a href="?subchoice=2">Climb the giant tree to look around</a></li>
                    </ul>
                <?php elseif ($_SESSION['substage'] == 1): ?>
                    <p>You followed the fairies and discovered a magical spring that grants eternal youth!</p>
                    <img src="images/magical.jpg" alt="Magical Spring" class="substage-image">
                <?php elseif ($_SESSION['substage'] == 2): ?>
                    <p>You climbed the giant tree and found a hidden village of elves.</p>
                    <img src="images/elf.jpg" alt="Elf Village" class="substage-image">
                <?php endif; ?>
            <?php elseif ($_SESSION['stage'] == 3): ?>
                <?php if ($_SESSION['substage'] == 0): ?>
                    <p>You entered the <strong>Dungeon of Dragons</strong>. A giant dragon roars in front of you. Do you:</p>
                    <img src="images/roar.jpg" alt="Dragon Dungeon" class="substage-image">
                    <ul>
                        <li><a href="?subchoice=1">Fight the dragon</a></li>
                        <li><a href="?subchoice=2">Run back toward the entrance</a></li>
                    </ul>
                <?php elseif ($_SESSION['substage'] == 1): ?>
                    <p>You bravely fought the dragon and emerged victorious. The dungeon is now yours!</p>
                    <img src="images/fight.jpg" alt="Dragon Fight" class="substage-image">
                <?php elseif ($_SESSION['substage'] == 2): ?>
                    <p>You ran back to the entrance and safely escaped the dragon's wrath.</p>
                    <img src="images/run.jpg" alt="Escape Dragon" class="substage-image">
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>

        <!-- Navigation Buttons -->
        <div class="navigation">
            <a href="?restart=true" class="button">Restart Adventure</a>
            <a href="?instructions=true" class="button instructions-btn">Instructions</a>
        </div>
    </div>
</body>
</html>
