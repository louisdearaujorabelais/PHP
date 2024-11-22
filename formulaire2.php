<!DOCTYPE html>
<html lang="fr">


    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>formulaire 2 </title>
    </head>
    <body>
            <?php

            require_once('basededonnee.php');

            echo '<form action="formulaire2.php" method="post">

            Nom: <input type="text" name="txtNom"><br>

            Prénom: <input type="text" name="txtPrenom"><br>

            Adresse: <input type="text" name="txtAdresse"><br>

            <input type="submit" value "ok">

            </form>"';

            $prenom = $_POST["txtPrenom"];

            $nom = $_POST["txtNom"];

            $adresse = $_POST["txtAdresse"];

            $stmt = $connexion ->prepare("INSERT INTO donneeformulaire (nom, prenom, adresse) VALUES ($nom, $prenom, $adresse)");

            $stmt->execute();




            // $stmt->bindValue(':prenom', $prenom, PDO::PARAM_STR);

            // $stmt->bindValue(':nom', $nom , PDO::PARAM_STR);

            // $stmt->bindValue(':adresse', $adresse, PDO::PARAM_STR);
          ?>
    </body>
</html>


