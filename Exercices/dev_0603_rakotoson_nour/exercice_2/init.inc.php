<?php

// Connexion à la BDD
$pdo = new PDO('mysql:host=localhost;dbname=apolearn', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

// Session 
session_start();

// Chemin du site
define('RACINE_SITE', '/Exercices/exercice_2/'); // indique le dossier dans lequel se situe le site dans 'localhost'

// Déclaration des variables d'affichage du site
$contenu = '';
$contenu_gauche = '';
$contenu_droite = '';

// Autres inclusions:
require_once('fonction.inc.php');