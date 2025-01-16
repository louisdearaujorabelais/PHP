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
                //array_key_exists("email", $_SESSION
                    if (!empty($_GET["nolivre"]) && ctype_digit($_GET["nolivre"])) {
                        require_once("bdd.php");
                        $rlivre = $connexion->prepare("SELECT * FROM livre 
                                                        INNER JOIN auteur ON auteur.noauteur = livre.noauteur 
                                                        LEFT JOIN emprunter ON emprunter.nolivre = livre.nolivre AND emprunter.dateretour IS NULL 
                                                        WHERE livre.nolivre = :recherche");
                        $rlivre->setFetchMode(PDO::FETCH_OBJ);
                        $rlivre->bindValue(":recherche", $_GET["nolivre"]);
                        $rlivre->execute();
                        $resultat = $rlivre->fetch();
                        if ($resultat): ?>
                            <div class="row"> 
                                <div class="col-sm-7">
                                    <p>Auteur : <?=$resultat->nom?> <?=$resultat->prenom?></p>
                                    <p>ISBN 13 : <?=$resultat->isbn13?></p>
                                    <p>Résumé du livre:</p>
                                    <p><?=$resultat->detail?></p>
                                    <?php if (empty($resultat->dateretour) && empty($resultat->dateemprunt)): ?>
                                        <a href="panier.php?nolivre=<?=$_GET["nolivre"]?>">Emprunter</a>
                                        <p>Disponible</p>
                                    <?php else: ?> 
                                        <p>Indisponible</p>
                                    <?php endif; ?>
                                </div>
                                <img src="./covers/<?=$resultat->photo?>" alt="<?=$resultat->titre?>" class="col-sm-3">                    
                            </div>  
                        <?php endif;
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
        
        
        
        