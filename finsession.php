<?php
    session_start();
?>
<!DOCTYPE html>
    <html>
        <body>
            <?php
                session_unset(); // suppression de toutes les variables de session
                session_destroy(); // destruction de la session
                header("Location: http://localhost/PHP/projet/accueil.php"); // redirection à la page d'accueil
            ?>
        </body>
    </html>