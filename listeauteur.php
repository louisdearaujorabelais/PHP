<?php
session_start();
?>         
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Page d'ajout auteur</title>
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
                        require_once("navbar.php");
                    ?>
			</div>
			<div class="col-sm-3">
                <img src="covers/moulinsart.png" class="rounded" alt="chateau">
			</div>
		</div>
        <div class="row">
		   <div class="col-sm-9">
            <?php
                            if (!isset($_POST['btnAjoutauteur'])) { 
                                // Le formulaire n'a pas été soumis
                                echo '
                                <form method="POST">
                                    <div class="form-floating mt-3 mb-3">
                                        <input type="text" class="form-control"  name="prenom" placeholder="Entrer le prenom de l auteur">
                                        <label>Prenom de l auteur</label>
                                    </div>
                                    <div class="form-floating mt-3 mb-3">
                                        <input type="text" class="form-control"  name="nom" placeholder="Entrer le nom de l auteur">
                                        <label>nom de l auteur</label>
                                    </div>
                                    <div class="form-floating mt-3 mb-3">
                                        <input type="submit" class="form-control" id="co" name="btnAjoutauteur">
                                    </div>
                                </form>';
                            } else { 
                                if (!empty($_POST['prenom']) && !empty($_POST['nom'])){                 
                                    require_once 'bdd.php';
                                    $prenom = $_POST['prenom'];
                                    $nom = $_POST['nom'];
                                    $laut = $connexion->prepare("INSERT INTO auteur (nom, prenom)
                                            VALUES (:nom, :prenom)");
                                    $laut->setFetchMode(PDO::FETCH_OBJ);
                                    $laut->bindValue(":nom", $nom);
                                    $laut->bindValue(":prenom", $prenom);
                                    $laut->execute();
                                    $resultat = $laut->fetch();
                                    echo '<h3>L auteur a bien été aujouter a la base de donnée </h3>';
                                        }else{
                                            header("Refresh:3");
                                            echo'le ou les champs ne sont pas remplis';
                                        }
                            }
                    require_once('bdd.php');
                    $raut = $connexion->prepare("SELECT nom, prenom  FROM auteur ORDER BY nom asc");                    
                    $raut->setFetchMode(PDO::FETCH_OBJ);                                                     
                    $raut->execute();                                                           
                    while($enregistrement = $raut->fetch())     
                    {    
                        echo'<h6>', $enregistrement->nom, ' ', $enregistrement->prenom,'</h6>';
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