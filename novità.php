<?php
$novita = [
    "Assassin’s Creed Shadows è disponibile ora!",
    "The Last of Us Part II Remastered arriva su PC.",
    "Cyberpunk 2077: Ultimate Edition annunciato per Nintendo Switch 2.",
    "La Stagione 3 di Call of Duty: Black Ops 6 è iniziata.",
    "Clair Obscur: Expedition 33 ha venduto 1 milione di copie.",
    "Days Gone Remastered disponibile da aprile 2025."
];
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Novità Videogiochi</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap');

        body {
            background-color: #000;
            color: #00FF00;
            font-family: 'Press Start 2P', monospace;
            padding: 40px;
            text-align: center;
        }

        h1 {
            font-size: 20px;
            margin-bottom: 30px;
            color: #FF00FF;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0 auto;
            max-width: 800px;
        }

        li {
            background: #111;
            margin: 10px 0;
            padding: 15px;
            border: 2px solid #00FF00;
            border-radius: 8px;
            text-align: left;
        }

        .button {
            display: inline-block;
            margin-top: 30px;
            padding: 10px 25px;
            background-color: #FF00FF;
            color: #000;
            text-decoration: none;
            border: 2px solid #00FF00;
            font-weight: bold;
            font-size: 12px;
            transition: 0.3s;
        }

        .button:hover {
            background-color: #00FF00;
            color: #000;
        }
    </style>
</head>
<body>

<h1>🕹️ Ultime Novità Videoludiche 🕹️</h1>

<ul>
    <?php foreach ($novita as $notizia): ?>
        <li><?= htmlspecialchars($notizia) ?></li>
    <?php endforeach; ?>
</ul>

<a class="button" href="index.php">⬅ Torna alla Home</a>

</body>
</html>
