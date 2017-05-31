<?php

$user = array(
	'id_user' => '1',
	'pseudo' => 'yakine75',
	'prenom' => 'Yakine',
	'nom' => 'HAMIDA',
	'email' => 'yakine.hamida@evogue.fr'
);

echo '<pre>';
print_r($user);
echo '</pre>';

echo '<h2>Les infos de ' . $user['pseudo'] . '</h2>';
echo '<ul>';
echo '	<li>' . $user['id_user'] . '</li>';
echo '	<li>' . $user['pseudo'] . '</li>';
echo '	<li>' . $user['prenom'] . '</li>';
echo '	<li>' . $user['nom'] . '</li>';
echo '	<li>' . $user['email'] . '</li>';
echo '</ul>';

extract($user);
echo '<h2>Les infos de ' . $pseudo . '</h2>';
echo '<ul>';
echo '	<li>' . $id_user . '</li>';
echo '	<li>' . $pseudo . '</li>';
echo '	<li>' . $prenom . '</li>';
echo '	<li>' . $nom . '</li>';
echo '	<li>' . $email . '</li>';
echo '</ul>';




