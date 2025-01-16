<?php
// Démarrage de la session, instruction a placer en tête de script
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Page recherche</title>
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
                    if (!isset($_POST['btnAjoutmembre'])) { 
                        // Le formulaire n'a pas été soumis
                        echo '
                        <form method="POST">
                            <div class="form-floating mt-3 mb-3">
                                <input type="text" class="form-control"  name="mel" placeholder="Entrer le mail">
                                <label>mail</label>
                            </div>
                            <div class="form-floating mt-3 mb-3">
                                <input type="text" class="form-control"  name="motdepasse" placeholder="Entrer le mot de passe">
                                <label>mot de passe</label>
                            </div>
                            <div class="form-floating mt-3 mb-3">
                                <input type="text" class="form-control"  name="prenom" placeholder="Entrez le prenom ">
                                <label> Prenom </label>
                            </div>
                            <div class="form-floating mt-3 mb-3">
                                <input type="text" class="form-control"  name="nom" placeholder="Entrez le nom ">
                                <label> nom </label>
                            </div>
                            <div class="form-floating mt-3 mb-3">
                                <input type="text" class="form-control"  name="adresse" placeholder="Entrer l adresse">
                                <label> adresse </label>
                            </div>
                            <div class="form-floating mt-3 mb-3">
                                <input type="text" class="form-control"  name="ville" placeholder="Entrer la ville">
                                <label> ville </label>
                            </div>
                            <div class="form-floating mt-3 mb-3">
                                <input type="text" class="form-control"  name="codepostale" placeholder="Entrer le code postale">
                                <label> code postale </label>
                            </div>
                            <div class="form-floating mt-3 mb-3">
                                <input type="submit" class="form-control" id="co" name="btnAjoutmembre">
                            </div>
                        </form>';
                    } else { 
                        if (!empty($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['mel']) && !empty($_POST['motdepasse'])
                            && !empty($_POST['adresse']) && !empty($_POST['ville']) && !empty($_POST['codepostale'])){                 
                            require_once 'bdd.php';
                            $prenom = $_POST['prenom'];
                            $mel = $_POST['mel'];
                            $nom = $_POST['nom'];
                            $motdepasse = $_POST['motdepasse'];
                            $adresse = $_POST['adresse'];
                            $ville = $_POST['ville'];
                            $codepostale = $_POST['codepostale'];
                            $laut = $connexion->prepare("INSERT INTO utilisateur (nom, prenom, mel, adresse, motdepasse, ville, codepostal)
                                    VALUES (:nom, :prenom, :mel, :adresse, :motdepasse, :ville, :codepostal)");
                            $laut->setFetchMode(PDO::FETCH_OBJ);
                            $laut->bindValue(":nom", $nom);
                            $laut->bindValue(":prenom", $prenom);
                            $laut->bindValue(":mel", $mel);
                            $laut->bindValue(":adresse", $adresse);
                            $laut->bindValue(":motdepasse", $motdepasse);
                            $laut->bindValue(":ville", $ville);
                            $laut->bindValue(":codepostal", $codepostale);
                            $laut->execute();
                            $resultat = $laut->fetch();
                            echo '<h3>Le membre a bien été aujouter a la base de donnée </h3>';
                                }else{
                                    echo'le ou les champs ne sont pas remplis';
                                    header("Refresh:3");
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