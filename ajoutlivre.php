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
                        if (!isset($_POST['btnAjoutlivre'])) { 
                            // Le formulaire n'a pas été soumis
                            echo '
                            <form method="POST" name="auteur">
                            <select>';
                            require_once('bdd.php');
                            $raut = $connexion->prepare("SELECT * FROM auteur ORDER BY nom asc");                    
                            $raut->setFetchMode(PDO::FETCH_OBJ);                                                     
                            $raut->execute();                                                           
                            while($enregistrement = $raut->fetch())     
                            {
                            ?>   
                                <h6><option method="POST" name = "auteur" value=<?=$enregistrement->noauteur?>><?=$enregistrement->nom?></option>
                            <?php
                            }
                            echo
                            '</select>
                            </form>
                            <form method="POST">
                                <div class="form-floating mt-3 mb-3">
                                    <input type="text" class="form-control"  name="titre" placeholder="Entrer le titre">
                                    <label>titre</label>
                                </div>
                                <div class="form-floating mt-3 mb-3">
                                    <input type="text" class="form-control"  name="isbn13" placeholder="Entrer l isbn13">
                                    <label>isbn13</label>
                                </div>
                                <div class="form-floating mt-3 mb-3">
                                    <input type="text" class="form-control"  name="anneeparution" placeholder="Entrer l année de parution">
                                    <label>anneeparution</label>
                                </div>
                                <div class="form-floating mt-3 mb-3">
                                    <input type="text" class="form-control"  name="detail" placeholder="Entrer le nom de l auteur">
                                    <label>detail</label>
                                </div>
                                <div class="form-floating mt-3 mb-3">
                                    <input type="text" class="form-control"  name="photo" placeholder="Entrer le chemin de la photo">
                                    <label>photo</label>
                                </div>
                                <div class="form-floating mt-3 mb-3">
                                    <input type="submit" class="form-control" id="co" name="btnAjoutlivre">
                                </div>
                            </form>';
                        } else { 
                            echo  $_POST["auteur"];
                            if (!empty($_POST['titre']) && !empty($_POST['isbn13']) && !empty($_POST['anneeparution']) && !empty($_POST['detail']) && !empty($_POST['photo']) && !empty($_POST['auteur'])){ 
                                echo $_POST['auteur'];                       
                                require_once 'bdd.php';   
                                $auteur = $connexion->prepare("SELECT noauteur FROM livre INNER JOIN auteur ON auteur.noauteur = livre.noauteur WHERE auteur.nom = :auteur;");
                                $auteur->setFetchMode(PDO::FETCH_OBJ);
                                $auteur->bindValue(":auteur", $_POST['auteur']);
                                $auteur->execute();
                                $noauteur = $auteur->fetch();
                                $livre = $connexion->prepare(" INSERT INTO livre (titre, isbn13, anneeparution, detail, photo, dateajout, livre.noauteur) VALUES (:titre, :isbn13, :anneeparution, :detail, :photo, NOW(), :noauteur)");
                                $livre->setFetchMode(PDO::FETCH_OBJ);
                                $livre->bindValue(":titre", $_POST['titre']);
                                $livre->bindValue(":titre", $_POST['titre']);
                                $livre->bindValue(":isbn13", $_POST['isbn13']);
                                $livre->bindValue(":anneeparution", $_POST['anneeparution']);
                                $livre->bindValue(":detail", $_POST['detail']);
                                $livre->bindValue(":photo", $_POST['photo']);
                                $livre->bindValue(":noauteur", $noauteur);
                                $livre->execute();
                                $resultat = $livre->fetch();
                                echo '<h3>Le livre a bien été aujouter a la base de donnée </h3>';
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