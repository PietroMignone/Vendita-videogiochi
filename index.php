<?php
include 'config.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_GET['add_to_cart'])) {
    $game = $_GET['add_to_cart'];
    if (!in_array($game, $_SESSION['cart'])) {
        $_SESSION['cart'][] = $game;
    }
    echo count($_SESSION['cart']);
    exit;
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Home - GAMENEXUS</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500&family=Rubik&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


    <style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Rubik', sans-serif;
        background-color: #0b0c10;
        color: #f4f4f4;
        line-height: 1.6;
    }

    header {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        padding: 20px 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: rgba(11, 12, 16, 0.85);
        backdrop-filter: blur(5px);
        z-index: 1000;
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
        transition: all 0.3s ease;
    }

    .auth-links a:hover, .logout:hover, .carrello-link:hover {
        background-color: #ff4ecd;
        color: #0b0c10;
        box-shadow: 0 0 10px #ff4ecd;
    }

    .hero {
        background: url('cyb.jpg') center center/cover no-repeat;
        height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .hero-text {
        background-color: rgba(11, 12, 16, 0.85);
        padding: 40px;
        border: 2px solid #8e44ad;
        border-radius: 12px;
        max-width: 90%;
    }

    .hero-text h2 {
        font-size: 40px;
        color: #ff4ecd;
        margin-bottom: 15px;
    }

    .hero-text p {
        font-size: 18px;
        color: #ccc;
    }

    .catalogo {
        display: grid;
        grid-template-columns: repeat(4, 1fr); /* 3 giochi per riga */
        gap: 20px;
        padding: 40px;
    }

    .gioco {
        background: #202020;
        border: 1px solid #8e44ad;
        border-radius: 10px;
        overflow: hidden;
        position: relative;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .gioco:hover {
        transform: scale(1.03);
        box-shadow: 0 0 15px #ff4ecd;
    }

    .gioco img {
        width: 100%;
        height: 300px;
        object-fit: cover;
    }

    .gioco-content {
        padding: 20px;
    }

    .gioco h3 {
        color: #ff4ecd;
        margin-bottom: 10px;
    }

    .gioco p {
        color: #ccc;
        margin-bottom: 15px;
        font-size: 16px;
    }

    .gioco p s {
        color: #888;
        margin-right: 10px;
    }

    .gioco p strong {
        color: #00ffff;
    }

    .button {
        background-color: transparent;
        color: #ff4ecd;
        border: 2px solid #ff4ecd;
        padding: 10px 15px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: bold;
        transition: all 0.3s ease;
    }

    .button:hover {
        background-color: #ff4ecd;
        color: #0b0c10;
        box-shadow: 0 0 10px #ff4ecd;
    }

    .ribbon {
        position: absolute;
        top: 10px;
        left: -10px;
        background: #00ffff;
        color: #0b0c10;
        padding: 5px 20px;
        transform: rotate(-45deg);
        font-size: 12px;
        font-weight: bold;
        z-index: 1;
    }

    .gioco:hover .ribbon {
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s ease;
}

.gioco:hover .game-video {
    opacity: 1;
    pointer-events: auto;
}

.gioco:hover .game-image {
    opacity: 0;
}


    main > div {
        text-align: center;
        margin: 20px;
    }

    .media-container {
        position: relative;
        width: 100%;
        height: 300px;
        overflow: hidden;
    }

    .game-image, .game-video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: opacity 0.5s ease;
    }

    .game-video {
        opacity: 0;
        pointer-events: none;
    }

    .search-bar-button {
    font-family: 'Rubik', sans-serif;
    color: #ff4ecd;
    background-color: transparent;
    border: 2px solid #ff4ecd;
    border-radius: 8px;
    padding: 8px 16px;
    font-size: 16px;
    width: 250px;
    text-align: center;
    transition: background-color 0.3s, color 0.3s, box-shadow 0.3s;
}

.search-bar-button::placeholder {
    color: #ff4ecd;
    opacity: 0.7;
}

.search-bar-button:focus {
    outline: none;
    background-color: #ff4ecd;
    color: #0b0c10;
    box-shadow: 0 0 10px #ff4ecd;
}

.search-bar-button:hover {
    background-color: #ff4ecd;
    color: #0b0c10;
    box-shadow: 0 0 10px #ff4ecd;
}

header {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    padding: 20px 40px;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
    background: rgba(11, 12, 16, 0.85);
    backdrop-filter: blur(5px);
    z-index: 1000;
    border-bottom: 3px solid #8e44ad;
    gap: 20px;
}

.logo-container {
    display: flex;
    align-items: center;
    gap: 10px;
}

.logo-container img {
    height: 40px;
    width: auto;
}

header h1 {
    font-family: 'Orbitron', sans-serif;
    color: #ff4ecd;
    font-size: 28px;
    white-space: nowrap;
}

.search-container {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
}

.search-wrapper {
    position: relative;
    width: 100%;
    max-width: 300px;
}

.search-wrapper .search-icon {
    position: absolute;
    top: 50%;
    left: 12px;
    transform: translateY(-50%);
    color: #ff4ecd;
    font-size: 16px;
    pointer-events: none;
    opacity: 0.8;
    transition: color 0.3s ease;
}

.search-bar-button {
    width: 100%;
    padding: 10px 16px 10px 38px;
    font-family: 'Rubik', sans-serif;
    font-size: 16px;
    color: #ff4ecd;
    background-color: transparent;
    border: 2px solid #ff4ecd;
    border-radius: 8px;
    transition: box-shadow 0.3s ease;
}

/* Nessun cambio colore al passaggio o al focus */
.search-bar-button:hover,
.search-bar-button:focus {
    background-color: transparent;
    color: #ff4ecd;
    box-shadow: 0 0 10px #ff4ecd;
    outline: none;
}

.search-bar-button::placeholder {
    color: #ff4ecd;
    opacity: 0.7;
}


    footer {
        text-align: center;
        padding: 20px;
        background: #202020;
        color: #888;
        font-size: 14px;
        margin-top: 40px;
    }

    @media (max-width: 768px) {
        header {
            flex-direction: column;
            padding: 15px 20px;
        }

        .auth-links a, .logout, .carrello-link {
            margin: 10px 5px 0 0;
        }

        .hero-text h2 {
            font-size: 28px;
        }

        .hero-text p {
            font-size: 16px;
        }

        .catalogo {
            padding: 20px;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        }

        .gioco img {
            height: 200px;
        }
    }
</style>

</head>
<body>
<header>
    <div style="display: flex; align-items: center; gap: 10px;">
        <img src="logon.webp" alt="Logo GAMENEXUS" style="height: 60px;">
        <h1>GAMENEXUS</h1>
    </div>
     <div class="search-container">
    <div class="search-wrapper">
        <i class="fas fa-search search-icon"></i>
        <input type="text" id="searchBar" placeholder="Cerca un gioco..." class="search-bar-button">
    </div>
</div>

    
    <div style="display: flex; align-items: center;">
        <a href="mostra_carrello.php" class="carrello-link" id="carrello-link">
            Carrello (<?php echo count($_SESSION['cart']); ?>)
        </a>
        <?php if (!empty($_SESSION['user'])): ?>
            <span style="margin-left: 15px;"><?php echo htmlspecialchars($_SESSION['user']['nome']); ?></span>
            <a href="logout.php" class="logout" style="margin-left: 15px;">Logout</a>
        <?php else: ?>
            <div class="auth-links" style="display: flex; gap: 15px;">
                <a href="login.php">Login</a>
                <a href="register.php">Registrati</a>
            </div>
        <?php endif; ?>
    </div>
</header>



<div class="hero">
    <div class="hero-text">
        <h2>Benvenuto nel nostro cyber store</h2>
        <p>Offerte speciali, neon e adrenalina pura.</p>
    </div>
</div>

<main>
    <div>
        <a class="button" href="novità.php">Leggi le Novità</a>
        <a class="button" href="info.php">Catalogo Giochi</a>
    </div>

    <div class="catalogo"> 

    <!-- Clair Obscur: Expedition 33 -->
<div class="gioco">
    <div class="media-container" onmouseenter="playVideo(this)" onmouseleave="stopVideo(this)">
        <img src="expedition33.jpg" alt="Clair Obscur: Expedition 33" class="game-image">
        <video class="game-video" muted loop preload="none">
            <source src="expedition33v.mp4" type="video/mp4">
        </video>
    </div>
    <div class="gioco-content">
        <h3>Clair Obscur: Expedition 33</h3>
        <p><s>50€</s> <strong>29,99€</strong></p>
        <a class="button" href="javascript:void(0);" onclick="addToCart('Clair Obscur: Expedition 33')">Aggiungi al carrello</a>
        <div class="ribbon">Nuovo</div>
        <a class="button" href="gioco_dettaglio.php?nome=<?php echo urlencode('Clair Obscur: Expedition 33'); ?>">Recensioni</a>
    </div>
</div>

<!-- The Last Of Us Part II Remastered -->
<div class="gioco">
    <div class="media-container" onmouseenter="playVideo(this)" onmouseleave="stopVideo(this)">
        <img src="thelastofus.jpg" alt="The Last Of Us Part II Remastered" class="game-image">
        <video class="game-video" muted loop preload="none">
            <source src="thelastv.mp4" type="video/mp4">
        </video>
    </div>
    <div class="gioco-content">
        <h3>The Last Of Us Part II Remastered</h3>
        <p><s>50€</s> <strong>35,69€</strong></p>
        <a class="button" href="javascript:void(0);" onclick="addToCart('The Last Of Us Part II Remastered')">Aggiungi al carrello</a>
        <div class="ribbon">Nuovo</div>
        <a class="button" href="gioco_dettaglio.php?nome=<?php echo urlencode('The Last Of Us Part II Remastered'); ?>">Recensioni</a>
    </div>
</div>

<!-- Cyberpunk 2077: Ultimate Edition -->
<div class="gioco">
    <div class="media-container" onmouseenter="playVideo(this)" onmouseleave="stopVideo(this)">
        <img src="cyberco.jpg" alt="Cyberpunk 2077: Ultimate Edition" class="game-image">
        <video class="game-video" muted loop preload="none">
            <source src="cybvideo.mp4" type="video/mp4">
        </video>
    </div>
    <div class="gioco-content">
        <h3>Cyberpunk 2077: Ultimate Edition</h3>
        <p><s>90€</s> <strong>32,99€</strong></p>
        <a class="button" href="javascript:void(0);" onclick="addToCart('Cyberpunk 2077: Ultimate Edition')">Aggiungi al carrello</a>
        <div class="ribbon">Nuovo</div>
        <a class="button" href="gioco_dettaglio.php?nome=<?php echo urlencode('Cyberpunk 2077: Ultimate Edition'); ?>">Recensioni</a>
    </div>
</div>

<!-- UNCHARTED: Raccolta L'eredità dei ladri -->
<div class="gioco">
    <div class="media-container" onmouseenter="playVideo(this)" onmouseleave="stopVideo(this)">
        <img src="uncharted.jpeg" alt="UNCHARTED: Raccolta L'eredità dei ladri" class="game-image">
        <video class="game-video" muted loop preload="none">
            <source src="uncht.mp4" type="video/mp4">
        </video>
    </div>
    <div class="gioco-content">
        <h3>UNCHARTED: Raccolta L'eredità dei ladri</h3>
        <p><s>50€</s> <strong>15,68€</strong></p>
        <a class="button" href="javascript:void(0);" onclick="addToCart('UNCHARTED: Raccolta L\'eredità dei ladri')">Aggiungi al carrello</a>
        <div class="ribbon">Nuovo</div>
        <a class="button" href="gioco_dettaglio.php?nome=<?php echo urlencode('UNCHARTED: Raccolta L\'eredità dei ladri'); ?>">Recensioni</a>
    </div>
</div>

<!-- EA Sports FC 25 -->
<div class="gioco">
    <div class="media-container" onmouseenter="playVideo(this)" onmouseleave="stopVideo(this)">
        <img src="fc25.jpeg" alt="EA Sports FC 25" class="game-image">
        <video class="game-video" muted loop preload="none">
            <source src="fifav.mp4" type="video/mp4">
        </video>
    </div>
    <div class="gioco-content">
        <h3>EA Sports FC 25</h3>
        <p><s>70€</s> <strong>25,65</strong></p>
        <a class="button" href="javascript:void(0);" onclick="addToCart('EA Sports FC 25')">Aggiungi al carrello</a>
        <div class="ribbon" style="background: #ff4ecd;">Usato</div>
        <a class="button" href="gioco_dettaglio.php?nome=<?php echo urlencode('EA Sports FC 25'); ?>">Recensioni</a>
    </div>
</div>

<!-- Baldur's Gate III -->
<div class="gioco">
    <div class="media-container" onmouseenter="playVideo(this)" onmouseleave="stopVideo(this)">
        <img src="baldursgate3.webp" alt="Baldur's Gate III" class="game-image">
        <video class="game-video" muted loop preload="none">
            <source src="baldursgate3v.mp4" type="video/mp4">
        </video>
    </div>
    <div class="gioco-content">
        <h3>Baldur's Gate III</h3>
        <p><s>60€</s> <strong>55,99€</strong></p>
        <a class="button" href="javascript:void(0);" onclick="addToCart('Baldur\'s Gate III')">Aggiungi al carrello</a>
        <div class="ribbon">Nuovo</div>
        <a class="button" href="gioco_dettaglio.php?nome=<?php echo urlencode('Baldur\'s Gate III'); ?>">Recensioni</a>
    </div>
</div>

<!-- Call of Duty: Black Ops 6 -->
<div class="gioco">
    <div class="media-container" onmouseenter="playVideo(this)" onmouseleave="stopVideo(this)">
        <img src="blackops6.jpg" alt="Call of Duty: Black Ops 6" class="game-image">
        <video class="game-video" muted loop preload="none">
            <source src="bo6v.mp4" type="video/mp4">
        </video>
    </div>
    <div class="gioco-content">
        <h3>Call of Duty: Black Ops 6</h3>
        <p><s>80€</s> <strong>54,49€</strong></p>
        <a class="button" href="javascript:void(0);" onclick="addToCart('Call of Duty: Black Ops 6')">Aggiungi al carrello</a>
        <div class="ribbon">Nuovo</div>
        <a class="button" href="gioco_dettaglio.php?nome=<?php echo urlencode('Call of Duty: Black Ops 6'); ?>">Recensioni</a>
    </div>
</div>

<!-- Days Gone -->
<div class="gioco">
    <div class="media-container" onmouseenter="playVideo(this)" onmouseleave="stopVideo(this)">
        <img src="daysgone.jpg" alt="Days Gone" class="game-image">
        <video class="game-video" muted loop preload="none">
            <source src="daysv.mp4" type="video/mp4">
        </video>
    </div>
    <div class="gioco-content">
        <h3>Days Gone</h3>
        <p><s>10€</s> <strong>7,99€</strong></p>
        <a class="button" href="javascript:void(0);" onclick="addToCart('Days Gone')">Aggiungi al carrello</a>
        <div class="ribbon" style="background: #ff4ecd;">Usato</div>
        <a class="button" href="gioco_dettaglio.php?nome=<?php echo urlencode('Days Gone'); ?>">Recensioni</a>
    </div>
</div>

<!-- Assassin's Creed Shadows -->
<div class="gioco"> 
    <div class="media-container" onmouseenter="playVideo(this)" onmouseleave="stopVideo(this)">
        <img src="asassincreed.avif" alt="Assassin's Creed Shadows" class="game-image">
        <video class="game-video" muted loop preload="none">
            <source src="acv.mp4" type="video/mp4">
        </video>
    </div>
    <div class="gioco-content">
        <h3>Assassin's Creed Shadows</h3>
        <p><s>70€</s> <strong>49,49€</strong></p>
        <a class="button" href="javascript:void(0);" onclick="addToCart('Assassin\'s Creed Shadows')">Aggiungi al carrello</a>
        <div class="ribbon">Nuovo</div>
        <a class="button" href="gioco_dettaglio.php?nome=<?php echo urlencode('Assassin\'s Creed Shadows'); ?>">Recensioni</a>
    </div>
</div>


<!-- It Takes Two -->
<div class="gioco">
    <div class="media-container" onmouseenter="playVideo(this)" onmouseleave="stopVideo(this)">
        <img src="ittakes2.jpeg" alt="It Takes Two" class="game-image">
        <video class="game-video" muted loop preload="none">
            <source src="ittakes2v.mp4" type="video/mp4">
        </video>
    </div>
    <div class="gioco-content">
        <h3>It Takes Two</h3>
        <p><s>40€</s> <strong>15,85€</strong></p>
        <a class="button" href="javascript:void(0);" onclick="addToCart('It Takes Two')">Aggiungi al carrello</a>
        <div class="ribbon" style="background: #ff4ecd;">Usato</div>
        <a class="button" href="gioco_dettaglio.php?nome=<?php echo urlencode('It Takes Two'); ?>">Recensioni</a>
    </div>
</div>

<!-- Horizon Zero Dawn Remastered -->
<div class="gioco">
    <div class="media-container" onmouseenter="playVideo(this)" onmouseleave="stopVideo(this)">
        <img src="horizon.jpeg" alt="Horizon Zero Dawn Remastered" class="game-image">
        <video class="game-video" muted loop preload="none">
            <source src="horizonv.mp4" type="video/mp4">
        </video>
    </div>
    <div class="gioco-content">
        <h3>Horizon Zero Dawn Remastered</h3>
        <p><s>50€</s> <strong>31,32€</strong></p>
        <a class="button" href="javascript:void(0);" onclick="addToCart('Horizon Zero Dawn Remastered')">Aggiungi al carrello</a>
        <div class="ribbon">Nuovo</div>
        <a class="button" href="gioco_dettaglio.php?nome=<?php echo urlencode('Horizon Zero Dawn Remastered'); ?>">Recensioni</a>
    </div>
</div>

<!-- Kingdom Come: Deliverance II -->
<div class="gioco">
    <div class="media-container" onmouseenter="playVideo(this)" onmouseleave="stopVideo(this)">
        <img src="kcm2.png" alt="Kingdom Come: Deliverance II" class="game-image">
        <video class="game-video" muted loop preload="none">
            <source src="kd2v.mp4" type="video/mp4">
        </video>
    </div>
    <div class="gioco-content">
        <h3>Kingdom Come: Deliverance II</h3>
        <p><s>60€</s> <strong>45,75€</strong></p>
        <a class="button" href="javascript:void(0);" onclick="addToCart('Kingdom Come: Deliverance II')">Aggiungi al carrello</a>
        <div class="ribbon">Nuovo</div>
        <a class="button" href="gioco_dettaglio.php?nome=<?php echo urlencode('Kingdom Come: Deliverance II'); ?>">Recensioni</a>
    </div>
</div>

<!-- Monster Hunter Wilds -->
<div class="gioco">
    <div class="media-container" onmouseenter="playVideo(this)" onmouseleave="stopVideo(this)">
        <img src="monsterhunterwilds.jpg" alt="Monster Hunter Wilds" class="game-image">
        <video class="game-video" muted loop preload="none">
            <source src="monsterv.mp4" type="video/mp4">
        </video>
    </div>
    <div class="gioco-content">
        <h3>Monster Hunter Wilds</h3>
        <p><s>70€</s> <strong>40,89€</strong></p>
        <a class="button" href="javascript:void(0);" onclick="addToCart('Monster Hunter Wilds')">Aggiungi al carrello</a>
        <div class="ribbon">Nuovo</div>
        <a class="button" href="gioco_dettaglio.php?nome=<?php echo urlencode('Monster Hunter Wilds'); ?>">Recensioni</a>
    </div>
</div>

<!-- NBA 2K25 -->
<div class="gioco">
    <div class="media-container" onmouseenter="playVideo(this)" onmouseleave="stopVideo(this)">
        <img src="2k25.jpg" alt="NBA 2K25" class="game-image">
        <video class="game-video" muted loop preload="none">
            <source src="nba25v.mp4" type="video/mp4">
        </video>
    </div>
    <div class="gioco-content">
        <h3>NBA 2K25</h3>
        <p><s>70€</s> <strong>17,07€</strong></p>
        <a class="button" href="javascript:void(0);" onclick="addToCart('NBA 2K25')">Aggiungi al carrello</a>
        <div class="ribbon">Nuovo</div>
        <a class="button" href="gioco_dettaglio.php?nome=<?php echo urlencode('NBA 2K25'); ?>">Recensioni</a>
    </div>
</div>


<!-- Spider-Man 2 -->
<div class="gioco">
    <div class="media-container" onmouseenter="playVideo(this)" onmouseleave="stopVideo(this)">
        <img src="spiderman2.jpeg" alt="Spider-Man 2" class="game-image">
        <video class="game-video" muted loop preload="none">
            <source src="spiderman2v.mp4" type="video/mp4">
        </video>
    </div>
    <div class="gioco-content">
        <h3>Spider-Man 2</h3>
        <p><s>60€</s> <strong>43,99€</strong></p>
        <a class="button" href="javascript:void(0);" onclick="addToCart('Spider-Man 2')">Aggiungi al carrello</a>
        <div class="ribbon">Nuovo</div>
        <a class="button" href="gioco_dettaglio.php?nome=<?php echo urlencode('Spider-Man 2'); ?>">Recensioni</a>
    </div>
</div>

<!-- Grand Theft Auto V -->
<div class="gioco">
    <div class="media-container" onmouseenter="playVideo(this)" onmouseleave="stopVideo(this)">
        <img src="gta5.jpeg" alt="Grand Theft Auto V" class="game-image">
        <video class="game-video" muted loop preload="none">
            <source src="gta5v.mp4" type="video/mp4">
        </video>
    </div>
    <div class="gioco-content">
        <h3>Grand Theft Auto V</h3>
        <p><s>30€</s> <strong>11,89€</strong></p>
        <a class="button" href="javascript:void(0);" onclick="addToCart('Grand Theft Auto V')">Aggiungi al carrello</a>
        <div class="ribbon" style="background: #ff4ecd;">Usato</div>
        <a class="button" href="gioco_dettaglio.php?nome=<?php echo urlencode('Grand Theft Auto V'); ?>">Recensioni</a>
    </div>
</div>


</div>

</main>

<script>
    function addToCart(game) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'index.php?add_to_cart=' + encodeURIComponent(game), true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                document.getElementById('carrello-link').innerText = 'Carrello (' + xhr.responseText + ')';
            }
        };
        xhr.send();
    }


 
    function playVideo(container) {
        const video = container.querySelector('.game-video');
        const image = container.querySelector('.game-image');
        video.style.opacity = 1;
        image.style.opacity = 0;
        video.play();
    }

    function stopVideo(container) {
        const video = container.querySelector('.game-video');
        const image = container.querySelector('.game-image');
        video.pause();
        video.currentTime = 0;
        video.style.opacity = 0;
        image.style.opacity = 1;
    }


</script>

<script>
    document.getElementById('searchBar').addEventListener('input', function () {
        const query = this.value.toLowerCase();
        const giochi = document.querySelectorAll('.catalogo .gioco');

        giochi.forEach(gioco => {
            const titolo = gioco.querySelector('h3').textContent.toLowerCase();
            gioco.style.display = titolo.includes(query) ? 'block' : 'none';
        });
    });
</script>

<footer>
    <div style="max-width: 1200px; margin: auto; padding: 40px 20px; display: flex; flex-wrap: wrap; justify-content: space-between; align-items: flex-start; border-top: 1px solid #8e44ad;">
        <div style="flex: 1 1 250px; margin-bottom: 20px;">
            <h3 style="color: #ff4ecd; margin-bottom: 15px;">GAMENEXUS</h3>
            <p style="color: #ccc;">Il tuo punto di riferimento per i giochi digitali. Offerte incredibili, novità e il meglio del gaming.</p>
        </div>

        <div style="flex: 1 1 200px; margin-bottom: 20px;">
            <h4 style="color: #ff4ecd; margin-bottom: 10px;">Contatti</h4>
            <p style="color: #ccc; margin-bottom: 5px;">📧 support@gamenexus.it</p>
            <p style="color: #ccc;">📞 +39 06 1234 5678</p>
        </div>

        <div style="flex: 1 1 200px; margin-bottom: 20px;">
  <h4 style="color: #ff4ecd; margin-bottom: 15px; text-align: center;">Seguici</h4>
  <div style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;">
    <a href="#" title="Facebook" style="color: #1877F2; font-size: 26px; transition: 0.3s;" onmouseover="this.style.color='#ffffff'" onmouseout="this.style.color='#1877F2'">
      <i class="fab fa-facebook-f"></i>
    </a>
    <a href="#" title="Instagram" style="color: #E4405F; font-size: 26px; transition: 0.3s;" onmouseover="this.style.color='#ffffff'" onmouseout="this.style.color='#E4405F'">
      <i class="fab fa-instagram"></i>
    </a>
    <a href="#" title="Twitter/X" style="color: #000000; font-size: 26px; transition: 0.3s;" onmouseover="this.style.color='#ffffff'" onmouseout="this.style.color='#000000'">
      <i class="fab fa-x-twitter"></i>
    </a>
    <a href="#" title="Discord" style="color: #5865F2; font-size: 26px; transition: 0.3s;" onmouseover="this.style.color='#ffffff'" onmouseout="this.style.color='#5865F2'">
      <i class="fab fa-discord"></i>
    </a>
    <a href="#" title="YouTube" style="color: #FF0000; font-size: 26px; transition: 0.3s;" onmouseover="this.style.color='#ffffff'" onmouseout="this.style.color='#FF0000'">
      <i class="fab fa-youtube"></i>
    </a>
    <a href="#" title="Twitch" style="color: #9146FF; font-size: 26px; transition: 0.3s;" onmouseover="this.style.color='#ffffff'" onmouseout="this.style.color='#9146FF'">
      <i class="fab fa-twitch"></i>
    </a>
  </div>
</div>


        </div>
    </div>
    <div>
        <p style="color: #555;">&copy; <?php echo date('Y'); ?> GAMENEXUS - Tutti i diritti riservati.</p>
    </div>
</footer>

</body>
</html>
