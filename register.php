<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $conn->real_escape_string($_POST['nome']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if ($conn->query("INSERT INTO utenti (nome, email, password, data_registrazione) VALUES ('$nome', '$email', '$password', NOW())")) {
        $messaggio = "Registrazione completata! <a href='login.php'>Accedi ora</a>.";
    } else {
        $errore = "Errore durante la registrazione.";
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Registrati - GAMENEXUS</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500&family=Rubik&display=swap" rel="stylesheet">
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
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .register-container {
            background-color: rgba(32, 32, 32, 0.95);
            border: 2px solid #8e44ad;
            border-radius: 12px;
            padding: 40px;
            width: 350px;
            box-shadow: 0 0 20px #8e44ad;
        }
        h2 {
            font-family: 'Orbitron', sans-serif;
            text-align: center;
            color: #ff4ecd;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-top: 10px;
            color: #ccc;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #8e44ad;
            border-radius: 8px;
            background-color: #1c1c1e;
            color: #fff;
        }
        input[type="submit"] {
            margin-top: 20px;
            width: 100%;
            padding: 10px;
            background-color: transparent;
            border: 2px solid #ff4ecd;
            color: #ff4ecd;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #ff4ecd;
            color: #0b0c10;
            box-shadow: 0 0 10px #ff4ecd;
        }
        .messaggio, .errore {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }
        .messaggio {
            color: #00ffcc;
        }
        .errore {
            color: #ff4ecd;
        }
        .messaggio a {
            color: #00ffff;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Registrati su GAMENEXUS</h2>
        <?php
            if (!empty($messaggio)) echo "<p class='messaggio'>$messaggio</p>";
            if (!empty($errore)) echo "<p class='errore'>$errore</p>";
        ?>
        <form method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Registrati">
        </form>
    </div>
</body>
</html>
