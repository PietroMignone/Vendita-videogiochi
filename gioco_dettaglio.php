<?php
include 'config.php';

$nome_gioco = $_GET['nome'] ?? '';

// Ottieni info gioco
$stmt = $conn->prepare("SELECT * FROM giochi WHERE nome = ?");
$stmt->bind_param("s", $nome_gioco);
$stmt->execute();
$gioco = $stmt->get_result()->fetch_assoc();

if (!$gioco) {
    echo "Gioco non trovato.";
    exit;
}

// Ottieni recensioni
$stmt = $conn->prepare("
    SELECT recensioni.voto, recensioni.commento, utenti.nome 
    FROM recensioni 
    JOIN utenti ON recensioni.id_utente = utenti.id
    WHERE recensioni.id_gioco = ?
    ORDER BY recensioni.data_recensione DESC
");
$stmt->bind_param("i", $gioco['id']);
$stmt->execute();
$recensioni = $stmt->get_result();

// Calcola media
$stmt = $conn->prepare("SELECT AVG(voto) as media FROM recensioni WHERE id_gioco = ?");
$stmt->bind_param("i", $gioco['id']);
$stmt->execute();
$media = $stmt->get_result()->fetch_assoc()['media'];
$media = round($media, 1);
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($gioco['nome']); ?> - GameNexus</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500&family=Rubik&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Rubik', sans-serif;
            background: linear-gradient(135deg, #0b0c10, #1f1f1f);
            color: #f4f4f4;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        header {
            background: #202020;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 3px solid #8e44ad;
        }
        header h1 {
            font-family: 'Orbitron', sans-serif;
            color: #ff4ecd;
            font-size: 32px;
        }
        .auth-links a, .logout, .carrello-link {
            color: #ff4ecd;
            border: 2px solid #ff4ecd;
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            margin-left: 15px;
            transition: 0.3s;
        }
        .auth-links a:hover, .logout:hover, .carrello-link:hover {
            background-color: #ff4ecd;
            color: #0b0c10;
            box-shadow: 0 0 10px #ff4ecd;
        }
        main {
            flex-grow: 1;
            width: 90%;
            max-width: 1000px;
            margin: 40px auto;
        }
        .gioco-detail {
            background: #1f1f1f;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(255, 78, 205, 0.5);
            text-align: center;
            margin-bottom: 30px;
        }
        .gioco-detail h2 {
            font-size: 36px;
            color: #ff4ecd;
            margin-bottom: 10px;
        }
        .gioco-detail p {
            margin-top: 10px;
            font-size: 18px;
            color: #ccc;
        }
        .gioco-detail .media-voto {
            margin-top: 20px;
            font-size: 22px;
            color: #00ffff;
        }
        .recensioni-container {
            background: #1f1f1f;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(255, 78, 205, 0.5);
            margin-bottom: 30px;
        }
        .recensioni-container h2 {
            color: #ff4ecd;
            font-size: 28px;
            margin-bottom: 20px;
        }
        .recensione {
            background: #202020;
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 10px;
            border: 1px solid #8e44ad;
            position: relative;
        }
        .recensione strong {
            color: #ff4ecd;
            font-size: 18px;
        }
        .recensione em {
            color: #bbb;
            display: block;
            margin-top: 10px;
        }
        .stars {
            color: #ffd700;
            margin-top: 5px;
        }
        .form-recensione {
            background: #1f1f1f;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(255, 78, 205, 0.5);
        }
        .form-recensione input, .form-recensione textarea, .form-recensione button {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 2px solid #ff4ecd;
            background: #202020;
            color: #ff4ecd;
            border-radius: 8px;
            font-size: 16px;
            transition: 0.3s;
        }
        .form-recensione input:focus, .form-recensione textarea:focus, .form-recensione button:hover {
            background: #ff4ecd;
            color: #0b0c10;
        }
        footer {
            text-align: center;
            padding: 20px;
            background: #202020;
            color: #555;
            font-size: 14px;
            margin-top: 40px;
        }
    </style>
</head>
<body>

<header>
    <div style="display: flex; align-items: center;">
        <img src="logon.webp" alt="Logo GAMENEXUS" style="height: 60px; margin-right: 10px;">
        <h1>GAMENEXUS</h1>
    </div>
    <div style="display: flex; align-items: center;">
        <a href="mostra_carrello.php" class="carrello-link">Carrello (<?php echo count($_SESSION['cart'] ?? []); ?>)</a>
        <?php if (!empty($_SESSION['user'])): ?>
            <span style="margin-left: 15px;"><?php echo htmlspecialchars($_SESSION['user']['nome']); ?></span>
            <a href="logout.php" class="logout">Logout</a>
        <?php else: ?>
            <div class="auth-links" style="display: flex; gap: 10px;">
                <a href="login.php">Login</a>
                <a href="register.php">Registrati</a>
            </div>
        <?php endif; ?>
    </div>
</header>

<main>
    <div class="gioco-detail">
        <h2><?php echo htmlspecialchars($gioco['nome']); ?></h2>
        <p><?php echo htmlspecialchars($gioco['descrizione']); ?></p>
        <p><strong>Prezzo:</strong> <?php echo htmlspecialchars($gioco['prezzo']); ?>€</p>
        <p class="media-voto"><strong>Media voto:</strong> <?php echo $media ? $media . "/5 ⭐" : "Nessuna recensione"; ?></p>
    </div>

    <div class="recensioni-container">
        <h2>Recensioni</h2>
        <?php if ($recensioni->num_rows > 0): ?>
            <?php while ($r = $recensioni->fetch_assoc()): ?>
                <div class="recensione">
                    <strong><?php echo htmlspecialchars($r['nome']); ?></strong>
                    <div class="stars"><?php echo str_repeat('⭐', $r['voto']); ?></div>
                    <em><?php echo nl2br(htmlspecialchars($r['commento'])); ?></em>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Nessuna recensione ancora.</p>
        <?php endif; ?>
    </div>

    <?php if (!empty($_SESSION['user'])): ?>
        <div class="form-recensione">
            <h2>Lascia una recensione</h2>
            <form action="recensioni.php" method="post">
                <input type="hidden" name="id_gioco" value="<?php echo $gioco['id']; ?>">
                <input type="number" name="voto" min="1" max="5" required placeholder="Voto (1-5)">
                <textarea name="commento" rows="4" placeholder="Scrivi il tuo commento..." required></textarea>
                <button type="submit">Invia Recensione</button>
            </form>
        </div>
    <?php else: ?>
        <p style="text-align: center;"><a href="login.php" style="color: #ff4ecd;">Accedi</a> per lasciare una recensione.</p>
    <?php endif; ?>
</main>

<footer>
    &copy; <?php echo date('Y'); ?> GameNexus - Tutti i diritti riservati
</footer>

</body>
</html>
