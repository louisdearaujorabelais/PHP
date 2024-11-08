<!DOCTYPE html>
<html lang="fr">


    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>mon 1er php </title>
    </head>
    <body>
    <?php
        $s = 0;
        echo"<table border='1'>";
        for ($x = 0; $x <= 10; $x++) {
            $s = echo $j "[txtName]" * $x;
            echo "
                <tr>
                    <td>
                        $x X 8 = 
                    </td> 
                    <td>
                        $s
                    </td>
                </tr>
            ";
            }
            
        echo"</table>";    
    ?>
     
    </body>
</html>