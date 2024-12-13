                <?php
                if(isset($_POST['btnEnvoyer'])){  
                    $recherche = $_POST["recherche"];  
                    require_once('basededonnee.php');
                    $stmt = $connexion->prepare("SELECT * FROM auteur WHERE nom LIKE :recherche");
                    $stmt->setFetchMode(PDO::FETCH_OBJ);
                    $stmt->execute();
                    while($enregistrement = $stmt->fetch())
                    {
                        echo  $enregistrement->nom, $enregistrement->prenom, $enregistrement->noauteur;
                    }
                    $stmt->execute();
                }      
                ?>