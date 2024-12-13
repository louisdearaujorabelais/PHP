<?php
session_start();
?>            
          
          <?php
          if(isset($_POST['btnconnexion'])){  
            $_SESSION["utilisateur"] = ;                 
            require_once('bdd.php');
            $mel = $_POST['mel'];
            $mot_de_passe = $_POST['mot_de_passe'];
            $stmt = $connexion->prepare("SELECT * FROM utilisateur where mel=:mel and motdepasse=:motdepasse");
            $stmt->bindValue(":mel", $mel); 
            $stmt->bindValue(":mot_de_passe", $mot_de_passe);
            $stmt->setFetchMode(PDO::FETCH_OBJ);        
            $stmt->execute();
            $enregistrement = $stmt->fetch();
            if ($enregistrement) { 
              echo '<h1>Connexion réussie !</h1>';
            } else {     
              echo "Echec à la connexion.";      
            }
          }          
          ?>
          

      
                    
                    
                    

