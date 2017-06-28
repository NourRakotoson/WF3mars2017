<?php
    $mysqli = new mysqli("localhost", "root", "", "repertoire");

    if (isset($_POST['inscription']))
    { 
        // echo '<pre>'; print_r($_POST); echo '</pre>';
        // echo '<pre>'; var_dump($_POST); echo '</pre>';
        echo '<div class="succes">';
        foreach($_POST as $indice => $valeur){
            echo "<p style='border: 1px solid black; color: white; text-align: center;'>$indice = $valeur</p>";
        }
        echo '</div>';

        $date_de_naissance = $_POST['annee'] . "-" . $_POST['mois'] . "-" . $_POST['jour'];
    }
?>

<!--

Nom
Prénom
Téléphone 
Profession
Ville
CP
Adresse
Date de naissance : Jour - Mois- Année
Sexe : Homme - Femme
Description
Submit  - Inscription

-->

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Révisions Formulaire</title>
        <style>
            label, select {float:left; width: 100px;}
            fieldset {float: left; width: 30%;}
            .submit{clear: both;}
            .erreur{background: #ff0000;}
            .succes{background: #669933;}
        </style>
    </head>

    <body>
        <h1>Formulaire</h1>         
            <form method="post" action="">
                <fieldset>
                    <legend>Informations</legend>
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom"><br>

                        <label for="prenom">Prénom</label>
                        <input type="text" id="prenom" name="prenom"><br>

                        <label for="telephone">Téléphone</label>
                        <input type="text" id="telephone" name="telephone" maxlenght="10"><br>

                        <label for="profession">Profession</label>
                        <input type="text" id="profession" name="profession"><br>

                        <label for="ville">Ville</label>
                        <input type="text" id="ville" name="ville"><br>

                        <label for="codepostal">Code Postal</label>
                        <input type="text" id="codepostal" name="codepostal"><br>

                        <label for="adresse">Adresse</label>
                        <textarea id="adresse" name="adresse" cols="16"></textarea><br><br>

                        <legend>Informations supplémentaires</legend>
                        <label>Date de naissance</label><br><br>
                        <label for="jour">Jour</label><br>
                            <select id="jour" name="jour">
                                <?php 
                                for($i=1; $i <=31; $i++)
                                    if($i<=9)
                                    {
                                        echo "<option>0$i</option>";
                                    } 
                                    else 
                                    {
                                        echo "<option>$i</option>";
                                    }
                                ?>		
                            </select>
                            <label for="mois">Mois</label><br>
                            <select for="mois" name="mois">
                                <option value="01">Janvier</option>
                                <option value="02">Février</option>
                                <option value="03">Mars</option>
                                <option value="04">Avril</option>
                                <option value="05">Mai</option>
                                <option value="06">Juin</option>
                                <option value="07">Juillet</option>
                                <option value="08">Août</option>
                                <option value="09">Septembre</option>
                                <option value="10">Octobre</option>                                
                                <option value="11">Novembre</option>
                                <option value="12">Décembre</option>
                            </select>
                            <label for="annee">Année</label><br>
                            <select name="annee" id="annee">
                                <?php
                                    for($i = date("Y"); $i >= 1930; $i--)
                                    {
                                        echo "<option>$i</option>";
                                    }
                                ?>
                            </select><br><br>

                        <label=for"sexe">Sexe</label><br>
                        Homme: <input type="radio" name="sexe" value="m" checked>
                        Femme: <input type="radio" name="sexe" value="f"><br>

                        <label for="description">Description</label>
                        <textarea id="description" name="description" rows="7" cols="25"></textarea><br>

                        <input type="submit" name="inscription" value="inscription"><br>
                    </fieldset>
                </form>
        </body>
    </html>



