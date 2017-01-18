<?php
/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 16/01/2017
 * Time: 14:00
 */

?>
<html>
    <head>
        <title>Creation auto WP</title>
    </head>
    <body>
        <form action="create.php" method="post">
            <p>Nom du site : <input type="text" name="nom" /></p>
            <p>Utilisateur : <input type="text" name="bdd_user" /></p>
            <p>Mot de passe : <input type="password" name="bdd_pwd" /></p>
            <p>Email : <input type="email" name="email" /></p>
            <p>Nom de la BDD : <input type="text" name="bdd_name" /></p>
            <p>Langue :<SELECT name="locale" size="1">
                <OPTION>fr_FR
                <OPTION>en_EN
                <OPTION>us_US
                </SELECT></p>
            <p>Delete default plugin <input type="checkbox" name="deleteDefaultPlugin" value="deleteDefaultPlugin"><br></p>
            <p><input type="submit" value="OK"></p>
        </form>
    </body>
</html>