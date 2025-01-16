<?php
session_start();
require_once("bdd.php");  // Connexion à la base de données

// Vérifiez si l'utilisateur est connecté
if (empty($_SESSION["mel"])) {
    echo '<h2>Vous devez vous connecter pour valider votre emprunt.</h2>';
    exit;
} else {
    $mel = $_SESSION["mel"];

    // Vérifiez si le formulaire a été soumis
    if (isset($_POST['valider']) && $_POST['valider'] == '1') {
        // Vérifiez que le panier contient des livres
        if (isset($_SESSION['panier']) && !empty($_SESSION['panier'])) {
            // Insérer chaque livre dans la table emprunter
            foreach ($_SESSION['panier'] as $nolivre => $quantite) {
                $query = "INSERT INTO emprunter (mel, nolivre, dateemprunt)
                          VALUES (:mel, :nolivre, NOW())";
                $stmt = $connexion->prepare($query);
                $stmt->bindValue(":mel", $mel);
                $stmt->bindValue(":nolivre", $nolivre);
                $stmt->execute();
            }
            // Vider le panier après l'emprunt
            unset($_SESSION['panier']);
            echo '<h3>Votre emprunt a été validé. Les livres ont été ajoutés à votre emprunt.</h3>';
            header( "refresh:3;url=panier.php" );
        } else {
            echo '<h3>Votre panier est vide. Aucun livre à emprunter.</h3>';
        }
    } else {
        echo '<h3>Erreur lors de la validation. Veuillez réessayer.</h3>';
    }
}
?>
