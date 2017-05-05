<?php
/*
	1- Afficher dans une table HTML la liste des contacts avec les champs nom, prénom, téléphone, et un champ supplémentaire "autres infos" avec un lien qui permet d'afficher le détail de chaque contact.

	2- Afficher sous la table HTML le détail d'un contact quand on clique sur le lien "autres infos".

*/


$pdo = new PDO('mysql:host=localhost;dbname=contacts', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

$requete = $pdo->query("SELECT nom, prenom, telephone FROM contact");
$resultat = $requete->fetch(PDO::FETCH_ASSOC); 

echo '<pre>'; print_r($resultat); echo'</pre>';

echo '<table>';
	echo '<tr>
			<td></td>
			<td></td>	
			<td></td>
		</tr>';
echo '</table>';




