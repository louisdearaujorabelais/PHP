<?php
session_start();
?>         
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Page d'acceuil</title>
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
                <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
                    <div class="container-fluid">
                        <form class="d-flex" method="POST" action="indexrecherche.php"> 
                        <input class="form-control me-5" type="text" placeholder="Recherche dans le catalogue (saisie du nom de l'auteur)" >
                        <span class="navbar-text"></span>
                        <button class="btn btn-primary" type="button" name="btnPanier">Panier</button>
                    </div>
                </nav>
			</div>
			<div class="col-sm-3">
                <img src="moulinsart.png" class="rounded" alt="chateau">
			</div>
		</div>
        <div class="row">
		   <div class="col-sm-9">
                <h3 style="text-align:center">Dernière sortie de la semaine</h3>
					<!--carroussel / résultat de la recherche / pages d'admin (ajout d'un livre)-->
                <div id="demo" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                        <button type="button" data-bs-target="#demo" data-bs-slide-to="1" style="width:20%"></button>
                        <button type="button" data-bs-target="#demo" data-bs-slide-to="2" style="width:20%"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="1984.jpg" alt="1984" class="d-block mx-auto" style="width:25%">
                            <div class="carousel-caption">
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="Anna_Karenine.jpg" alt="Anna Karenine" class="d-block mx-auto" style="width:25%">
                                <div class="carousel-caption">
                                </div> 
                            </div>
                        <div class="carousel-item"> 
                            <img src="Bartleby_le_Scribe.jpg" alt="Bartleby le Scribe" class="d-block mx-auto" style="width:25%">
                            <div class="carousel-caption">
                            </div>  
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
			</div>
			<div class="col-sm-3">
                <form action="formulaire2.php"method="POST">
                    <div class="form-floating mb-3 mt-3">
                        <input type="text" class="form-control" id="nomUti" name="mel" placeholder="Entrer votre nom d'utilisateur">
                        <label>Nom Utilisateur</label>
                    </div>
                    <div class="form-floating mt-3 mb-3">
                        <input type="password" class="form-control" id="mdp" name="mot_de_passe" placeholder="Entrer le mot de passe">
                        <label for="Mdp">Mot de passe</label>
                    </div>
                    <div class="form-floating mt-3 mb-3">
                        <input type="submit" class="form-control" id="co" name="btnconnexion">
                        <label for="co">Connexion</label>
                    </div>
                </form>
				<?php
                    require_once("formulaire2.php");
                ?>
			</div>
		</div>
	</div>
    </body>
</html>