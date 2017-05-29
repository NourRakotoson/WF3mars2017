<?php
require_once('inc/init.inc.php');

$tab = array();
$tab['resultat'] = "";
$tab['pseudo'] = "disponible";

$erreur = false; // Variable de controle de fin de script. Si sa valeur est passée à true, alors il ya une erreur (exemple le pseudo est indispo)



//extract($_POST) :
$mode = isset($_POST['mode']) ? $_POST['mode'] : '';
$pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : '';
$civilite = isset($_POST['civilite']) ? $_POST['civilite'] : '';
$ville = isset($_POST['ville']) ? $_POST['ville'] : '';
$date_de_naissance = isset($_POST['date_de_naissance']) ? $_POST['date_de_naissance'] : '';

// action =  condition ? condition vrai (if) : condition fausse (else);

if($mode == "connexion") {
    //Traitement de la connexion/inscription
    // requete pour tester si le pseudo est déjà dans le BDD
    $resultat = $pdo->query("SELECT * FROM membre WHERE pseudo = '$pseudo'");
    $membre = $resultat->fetch(PDO::FETCH_ASSOC);

    $time=time(); // on récupère le timestamp
    if($resultat->rowCount() == 0 ){   // s'il n'y a pas de ligne alors le pseudo est libre car inexistant en BDD.
        $pdo->query("INSERT INTO membre (pseudo, civilite, ville, date_de_naissance, ip, date_connexion) VALUES ('$pseudo', '$civilite', '$ville', '$date_de_naissance', '$_SERVER[REMOTE_ADDR]', $time) ");

        $id_membre = $pdo->lastInsertId(); // permet de récupéré le dernier id inséré

        $tab['resultat']="Membre enregistré !";
    } 

    elseif ($resultat->rowCount() > 0 && $_SERVER['REMOTE_ADDR'] == $membre['ip']){
        $time = time();
        $pdo->query("UPDATE membre SET date_connexion=$time WHERE id_membre = $membre[id_membre]");
        $id_membre = $membre['id_membre'];
    }else{
        $tab['resultat'] = "Pseudo indisponible, veuillez recommencer";
        $erreur = true;
        $tab['pseudo'] = "indisponible";
    }
    

    if(!$erreur){  // si il n'y a pas d'erreur
        $_SESSION['id_membre'] = $id_membre;
        $_SESSION['pseudo'] = $pseudo;
        $_SESSION['civilite'] = $civilite;

        $f = fopen("prenom.txt","a");
            fwrite($f, $pseudo . "\n");
            fclose($f);
    }
}


echo json_encode($tab);