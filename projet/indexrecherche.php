<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Page recherche</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>    </head>
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
                        <form class="d-flex">
                        <input class="form-control me-5" type="text" placeholder="Recherche dans le catalogue (saisie du nom de l'auteur)">
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
                <!--carroussel / résultat de la recherche / pages d'admin (ajout d'un livre)-->
            </div>
			<div class="col-sm-3">
					<?php
                    require_once("formulaire2.php");
                    ?>
			</div>
		</div>
	</div>
    </body>
</html>