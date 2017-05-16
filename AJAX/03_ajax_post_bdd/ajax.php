<?php
     $pdo = new PDO('mysql:host=localhost;dbname=entreprise', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

     $id_employes = '';

     if (isset($_POST['personne']))
    {
        $id_employes = $_POST['personne'];
    }
    $employes = $pdo->query("SELECT * FROM employes WHERE id_employes=$id_employes");

    $information_employes = $employes->fetch(PDO::FETCH_ASSOC);

    // et envoyer une réponse sous forme de tableau HTML, il doit avoir deux lignes, une avec le nom des colonnes et l'autre avec les valeurs
    $tab = array();
    $tab['resultat'] = "<table border='1'><tr>";
    $tab['resultat'] .= '<th>'. implode('</th><th>', array_keys($information_employes)) . '</th></tr>';

    $tab['resultat'] .= '<tr>';

    foreach($information_employes as $valeur)
    {
        $tab['resultat'] .= '<td>' . $valeur . '</td>';
    }

    $tab['resultat'] .= '</tr>';
    $tab['resultat'] .= '</table>';

echo json_encode($tab);


