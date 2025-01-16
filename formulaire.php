<!DOCTYPE html>
<html>
    <body>
        <?php
                    if (!array_key_exists("mel", $_SESSION)) { 
                        // L'utilisateur n'est pas connecté
                        if (!isset($_POST['btnSeConnecter'])) { 
                            // Le formulaire n'a pas été soumis
                            echo '
                            <form action="accueil.php" method="POST">
                                <div class="form-floating mb-3 mt-3">
                                    <input type="email" class="form-control" id="email" name="mel" placeholder="Entrer votre nom utilisateur" " >
                                    <label>Nom Utilisateur</label>
                                </div>
                                <div class="form-floating mt-3 mb-3">
                                    <input type="password" class="form-control" id="pwd" name="mot_de_passe" placeholder="Entrer le mot de passe" " >
                                    <label for="Mdp">Mot de passe</label>
                                </div>
                                <div class="form-floating mt-3 mb-3">
                                    <input type="submit" class="form-control" id="co" name="btnSeConnecter">
                                    <label for="co">Connexion</label>
                                </div>
                            </form>';
                            //pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$
                            //pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}

                        } else { // si non connecté et submit

                            header("Refresh:0");
                            // Le formulaire a été soumis
                            require_once 'bdd.php';
                            $mel = $_POST['mel'];
                            $mot_de_passe = $_POST['mot_de_passe'];
                         
                            // Requête pour vérifier les identifiants
                            $stmt = $connexion->prepare("SELECT * FROM utilisateur WHERE mel = :mel AND motdepasse = :mot_de_passe");
                            $stmt->bindValue(":mel", $mel); 
                            $stmt->bindValue(":mot_de_passe", $mot_de_passe); 
                            $stmt->setFetchMode(PDO::FETCH_OBJ);
                            $stmt->execute();

                            $enregistrement = $stmt->fetch(); // Récupère le premier enregistrement trouvé
                            if ($enregistrement) { 
                                // Utilisateur trouvé -> connecté
                                $_SESSION["mel"] = $mel; // Stocke le mel dans la session
                                ?>
                                <div class="row"> 
                                    <div class="col-sm-7">
                                        <p><?=$enregistrement->nom . ' ' . $enregistrement->prenom?></p>
                                        <p><?=$enregistrement->mel?></p>
                                        <p><?=$enregistrement->adresse?></p>
                                        <p><?=$enregistrement->ville . ' ' . $enregistrement->codepostal?></p>
                                    </div>
                                    <a href="finsession.php" class="btn btn-info" role="button">Deconnexion</a>                  
                                </div>
                                <?php
                            } else { // Identifiants incorrects
                                echo "Echec à la connexion.";
                                header( "refresh:3;url=accueil.php" );
                            } // FIN TRAITREMENT AUTHENTIFICATION
                        } // FIN AFF. TRAIT. FORMULAIRE AUTHENTIFICATION
                    } else {
                        // L'utilisateur est déjà connecté
                        require_once 'bdd.php';
                        $util = $connexion->prepare("SELECT * FROM utilisateur WHERE mel = :mel");
                        $util->bindParam(':mel', $_SESSION["mel"], PDO::PARAM_STR);
                        $util->setFetchMode(PDO::FETCH_OBJ);
                        $util->execute();
                        $resultat = $util->fetch(); // Récupère les informations de l'utilisateur connecté

                        if (!empty($resultat)) {
                            ?>
                            <div class="row"> 
                                <div class="col-sm-7">
                                    <p><?=$resultat->nom . ' ' . $resultat->prenom?></p>
                                    <p><?=$resultat->mel?></p>
                                    <p><?=$resultat->adresse?></p>
                                    <p><?=$resultat->ville . ' ' . $resultat->codepostal?></p>
                                </div>
                                <a href="finsession.php" class="btn btn-info" role="button">Deconnexion</a>                  
                            </div>
                            <?php
                            require_once 'bdd.php';
                            $mail = $_SESSION["mel"];
                            // Requête pour vérifier le statut de la personne connectée
                            $cprm = $connexion->prepare("SELECT * FROM utilisateur WHERE mel = :mail");
                            $cprm->bindValue(":mail", $mail);
                            $cprm->setFetchMode(PDO::FETCH_OBJ);
                            $cprm->execute();
                            $profil = $cprm->fetch();
                            if (!empty($_SESSION["mel"]) && $profil->profil != 'client') {
                                echo'
                                <a href="listeauteur.php" class="btn btn-info" role="button">Ajout Auteur</a>
                                <a href="ajoutlivre.php" class="btn btn-info" role="button">Ajout Livre</a>
                                <a href="ajoutmembre.php" class="btn btn-info" role="button">Ajout Membre</a>
                                ';
                            } 

                        } else {
                            echo "Impossible de récupérer les informations de l'utilisateur.";
                            unset($_POST['btnSeConnecter']);       
                        }
                    }
                    
        ?>
    </body>
</html>