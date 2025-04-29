<?php
session_start();

// Prezzi dei giochi (in euro)
$prices = [
    "Assassin's Creed Shadows" => 49.49,
    "The Last Of Us Part II Remastered" => 35.69,
    "Cyberpunk 2077: Ultimate Edition" => 32.99,
    "UNCHARTED: Raccolta L'eredità dei ladri" => 49.49,
    "EA Sports FC 25" => 32.99,
    "Baldur's Gate III" => 32.99,
    "Call of Duty: Black Ops 6" => 32.99,
    "Days Gone" => 32.99,
    "Clair Obscur: Expedition 33" => 32.99,
    "Grand Theft Auto V" => 32.99,
    "It Takes Two" => 32.99,
    "Kingdom Come: Deliverance II" => 32.99,
    "Monster Hunter Wilds" => 32.99,
    "NBA 2K25" => 32.99,
    "Horizon Zero Dawn Remastered" => 32.99,
    "Spider-Man 2" => 32.99
];


// Rimozione dal carrello
if (isset($_GET['remove_from_cart'])) {
    $game = $_GET['remove_from_cart'];
    if (($key = array_search($game, $_SESSION['cart'])) !== false) {
        unset($_SESSION['cart'][$key]);
    }
    header("Location: mostra_carrello.php");
    exit;
}

// Simulazione pagamento
$pagamento_effettuato = false;
if (isset($_POST['pay']) && !empty($_SESSION['user'])) {
    $_SESSION['cart'] = []; // Svuota il carrello
    $pagamento_effettuato = true;
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Il tuo Carrello</title>
    <style>
        body {
            background-color: #0b0c10;
            color: #f4f4f4;
            font-family: 'Rubik', sans-serif;
            margin: 0;
            padding: 20px;
        }
        .carrello {
            max-width: 600px;
            margin: auto;
            background: #202020;
            border: 1px solid #8e44ad;
            border-radius: 10px;
            padding: 20px;
        }
        h2 {
            color: #ff4ecd;
            text-align: center;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            padding: 10px 0;
            border-bottom: 1px solid #333;
            display: flex;
            justify-content: space-between;
        }
        .button {
            background-color: transparent;
            color: #ff4ecd;
            border: 2px solid #ff4ecd;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
            transition: 0.3s;
        }
        .button:hover {
            background-color: #ff4ecd;
            color: #0b0c10;
            box-shadow: 0 0 12px #ff4ecd;
        }
        a.remove {
            color: #00ffff;
            font-size: 14px;
            text-decoration: none;
        }
        a.remove:hover {
            text-decoration: underline;
        }
        .totale {
            text-align: center;
            font-size: 18px;
            margin-top: 20px;
        }
        .successo {
            background: #28a745;
            color: white;
            padding: 10px;
            border-radius: 6px;
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="carrello">
        <h2>Contenuto del Carrello</h2>

        <?php if ($pagamento_effettuato): ?>
            <div class="successo">
                Pagamento effettuato con successo! 🎉<br>Grazie per il tuo acquisto.
            </div>
        <?php endif; ?>

        <?php if (!empty($_SESSION['cart'])): ?>
            <ul>
                <?php
                $totale = 0;
                foreach ($_SESSION['cart'] as $item):
                    $prezzo = isset($prices[$item]) ? $prices[$item] : 0;
                    $totale += $prezzo;
                ?>
                    <li>
                        <?php echo htmlspecialchars($item); ?> - €<?php echo number_format($prezzo, 2); ?>
                        <a class="remove" href="?remove_from_cart=<?php echo urlencode($item); ?>">Rimuovi</a>
                    </li>
                <?php endforeach; ?>
            </ul>

            <div class="totale">
                Totale: <strong>€<?php echo number_format($totale, 2); ?></strong>
            </div>

            <?php if (!empty($_SESSION['user'])): ?>
                <form action="checkout.php" method="POST" style="text-align: center;">
                    <button type="submit" class="button">Paga con Stripe 💳</button>
                </form>
            <?php else: ?>
                <p style="text-align: center;">Devi essere <a href="login.php" style="color: #ff4ecd;">loggato</a> per pagare.</p>
            <?php endif; ?>
        <?php else: ?>
            <p>Il carrello è vuoto.</p>
        <?php endif; ?>

        <div style="text-align: center;">
            <a class="button" href="index.php">Torna allo shop</a>
        </div>
    </div>
</body>
</html>
