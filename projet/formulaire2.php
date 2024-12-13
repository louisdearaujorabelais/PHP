
            <form action="formulaire2.php"method="POST">
                <div class="form-floating mb-3 mt-3">
                  <input type="text" class="form-control" id="nomUti" placeholder="Entrer votre nom d'utilisateur" name="btnEnvoyer">
                  <label for="nUtilisateur">Nom Utilisateur</label>
                </div>

                <div class="form-floating mt-3 mb-3">
                  <input type="text" class="form-control" id="mdp" placeholder="Entrer le mot de passe" name="btnEnvoyer">
                  <label for="Mdp">Mot de passe</label>
                </div>

                <div class="form-floating mt-3 mb-3">
                  <input type="submit" class="form-control" id="co" name="btnEnvoyer">
                  <label for="co">Connexion</label>
                </div>
            </form>
            <?php
            if(isset($_POST['btnEnvoyer'])){  
               
            }      
            ?>