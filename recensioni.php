<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user'])) {
    echo "Devi essere loggato per lasciare una recensione.";
    exit;
}

// Controlla se i dati sono stati inviati
if (isset($_POST['voto'], $_POST['commento'], $_POST['id_gioco'])) {
    $id_gioco = $_POST['id_gioco'];
    $voto = $_POST['voto'];
    $commento = $_POST['commento'];
    $id_utente = $_SESSION['user']['id']; // ID dell'utente loggato

    // Verifica che il voto sia un numero tra 1 e 5
    if ($voto < 1 || $voto > 5) {
        echo "Il voto deve essere tra 1 e 5.";
        exit;
    }

    // Inserisci la recensione nel database
    $stmt = $conn->prepare("INSERT INTO recensioni (id_utente, id_gioco, voto, commento, data_recensione) VALUES (?, ?, ?, ?, CURDATE())");
    $stmt->bind_param("iiis", $id_utente, $id_gioco, $voto, $commento);

    if ($stmt->execute()) {
        echo "Recensione inviata con successo!";
    } else {
        echo "Errore durante l'invio della recensione.";
    }

    // Ritorna alla pagina del gioco
    header("Location: gioco_dettaglio.php?nome=" . urlencode($_POST['nome_gioco']));
    exit;
} else {
    echo "Dati non validi.";
}
?>
