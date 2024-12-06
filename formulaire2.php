<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>formulaire 2</title>
    </head>
    <body>
            <form action="formulaire2.php"method="POST">
                Nom: <input type="text" name="nom"><br>
                Prénom: <input type="text" name="prenom"><br>
                Adresse: <input type="text" name="adresse"><br>
                <input type="submit" name="btnEnvoyer">
            </form>
            <?php
            if(isset($_POST['btnEnvoyer'])){  
                $nom = $_POST["nom"];
                $prenom = $_POST["prenom"];
                $adresse = $_POST["adresse"];   
                require_once('basededonnee.php');
                $stmt = $connexion->prepare("INSERT INTO formulaire2 (nom, prenom, adresse) VALUES (:nom, :prenom, :adresse)");
                $stmt->bindValue(':nom', $prenom, PDO::PARAM_STR);
                $stmt->bindValue(':prenom', $nom , PDO::PARAM_STR);
                $stmt->bindValue(':adresse', $adresse, PDO::PARAM_STR); 
                $stmt->execute();
            }      
          ?>
    </body>
</html>

