
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Page Panier</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>    
    </head>
    <body>
           
    <div class="container-fluid">
		<div class="row">
			<div class="col-sm-9">
                <!--navbar-->
                <div class="alert alert-success">
                    La bibliothèque de Moulinsart est fermer au public jusqu'a nouvelle ordre. Mais il vous est possible de réserver et de retirer vos livres via notre service Biblio-drive !
                </div>
                <?php
                  require_once("navbar.php")
                ?> 
			</div>
			<div class="col-sm-3">
                <img src="covers/moulinsart.png" class="rounded" alt="chateau">
			</div>
		</div>
        <div class="row">
		    <div class="col-sm-9">
            <?php
            require_once("bdd.php");  // Connexion à la base de données
            // Vérifiez si l'utilisateur est connecté
            if (empty($_SESSION["mel"])) {
                echo '<h2>Vous devez vous connecter pour pouvoir ajouter des livres dans votre panier</h2>';
            } else {
                $mel = $_SESSION["mel"];
                // Vérifiez le nombre de livres déjà empruntés
                $query_emprunts = "SELECT COUNT(*) AS nb_emprunts FROM emprunter WHERE mel = :mel";
                $stmt = $connexion->prepare($query_emprunts);
                $stmt->bindValue(":mel", $mel);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $nb_emprunts = $result['nb_emprunts'];  // Nombre de livres empruntés par l'utilisateur
                // Affichage du nombre de livres empruntés
                echo '<p>Vous avez déjà emprunté ' . $nb_emprunts . ' livre(s).</p>';
                // Ajouter un livre au panier depuis l'URL (si le paramètre nolivre est passé)
                if (isset($_GET["nolivre"])) {
                    $nolivre = $_GET["nolivre"];
                    // Initialiser le panier s'il n'est pas déjà initialisé dans la session
                    if (!isset($_SESSION["panier"])) {
                        $_SESSION["panier"] = array();
                    }

                    // Vérifier si le panier contient déjà 5 livres
                    if (count($_SESSION["panier"]) >= 5) {
                        echo '<h3>Vous ne pouvez pas ajouter plus de 5 livres dans votre panier.</h3>';
                    } else {
                        // Ajouter le livre au panier s'il n'est pas déjà présent
                        if (!isset($_SESSION["panier"][$nolivre])) {
                            $_SESSION["panier"][$nolivre] = 1;  // 1 représente la quantité de ce livre dans le panier
                            echo '<h3>Le livre a été ajouté à votre panier.</h3>';
                        } else {
                            echo '<h3>Le livre est déjà dans votre panier.</h3>';
                        }
                    }
                }
                // Vérifier si un livre doit être retiré du panier
                if (isset($_GET['annuler']) && isset($_SESSION['panier'][$_GET['annuler']])) {
                    $nolivre_to_remove = $_GET['annuler'];  // Récupérer le numéro du livre à retirer
                    unset($_SESSION['panier'][$nolivre_to_remove]);  // Retirer le livre du panier
                    echo '<h3>Le livre a été retiré de votre panier.</h3>';
                }
                // Afficher le panier si des livres y sont ajoutés
                if (isset($_SESSION["panier"]) && !empty($_SESSION["panier"])) {
                    echo '<h3>Votre Panier</h3>';
                    echo '<form action="emprunt.php" method="post">';  // Redirige vers la page emprunt.php

                    foreach ($_SESSION["panier"] as $nolivre => $quantite) {
                        // Requête pour récupérer les détails du livre
                        $query = "SELECT livre.*, auteur.prenom, auteur.nom 
                                FROM livre
                                INNER JOIN auteur ON auteur.noauteur = livre.noauteur
                                WHERE livre.nolivre = :nolivre";
                        $rpanier = $connexion->prepare($query);
                        $rpanier->bindValue(":nolivre", $nolivre);
                        $rpanier->execute();
                        $resultat = $rpanier->fetch(PDO::FETCH_OBJ);  // Récupérer les informations du livre
                        // Affichage du livre dans le panier sous la forme : auteur - titre - date de sortie
                        echo '<div>';
                        echo '<p><strong>' . htmlspecialchars($resultat->prenom) . ' ' . htmlspecialchars($resultat->nom) . ' - ' . htmlspecialchars($resultat->titre) . ' - ' . htmlspecialchars($resultat->anneeparution) . '</strong></p>';
                        echo '<a href="?annuler=' . $nolivre . '" class="btn btn-info" role="button">Annuler</a>';  // Lien pour annuler l'ajout du livre
                        echo '</div>';
                    }
                    // Bouton pour valider le panier
                    echo '<button type="submit" name="valider" value="1">Valider le Panier</button>';
                    echo '</form>';
                } else {
                    // Message si le panier est vide
                    echo '<p>Votre panier est vide.</p>';
                }
            }
            ?>
            </div>
			<div class="col-sm-3">
					<?php
                        require_once("formulaire.php");
                    ?>
			</div>
		</div>
	</div>
    </body>
</html>