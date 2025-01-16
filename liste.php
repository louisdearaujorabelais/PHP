<!DOCTYPE html>
    <html>
        <body>
            <div>
                <?php           
                        // Vérification si la donnée "recherche" est envoyée et non vide
                    if (isset($_POST["recherche"]) && !empty($_POST["recherche"])) {
                        // Récupérer et sécuriser la donnée
                        $recherche = $_POST["recherche"];
                        $recherche = "%" . $recherche . "%";  // Ajout des jokers pour LIKE
                    } else {
                        echo "Aucune donnée de recherche n'a été envoyée.";
                        exit(); // Arrêter le script si la recherche est vide
                    }

                    // Inclusion de la connexion à la base de données
                    require_once('bdd.php');

                    // Préparation de la requête SQL avec un paramètre
                    $stmt = $connexion->prepare("SELECT * FROM livre INNER JOIN auteur ON auteur.noauteur = livre.noauteur WHERE auteur.nom LIKE :recherche");

                    // Liaison du paramètre à la variable $recherche
                    $stmt->bindParam(':recherche', $recherche, PDO::PARAM_STR);

                    // Définir le mode de récupération des résultats
                    $stmt->setFetchMode(PDO::FETCH_OBJ);

                    // Exécution de la requête
                    if ($stmt->execute()) {
                        // Vérification si des résultats sont trouvés
                        $resultat = $stmt->fetchAll();
                        if (empty($resultat)) {
                            echo "Aucun résultat trouvé pour cette recherche.";
                        } else {
                            // Récupération des résultats et affichage
                            foreach ($resultat as $affiche) {
                                $nostmt = $affiche->nolivre;  // ID du livre
                                echo "<a href='detail.php?nolivre=$nostmt'><p>$affiche->titre ($affiche->anneeparution)</p></a>";
                            }
                        }
                    } else {
                        echo "Erreur lors de l'exécution de la requête SQL.";
                    }
                ?>
            </div>
        </body>
    </html>