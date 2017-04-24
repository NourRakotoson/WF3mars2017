-- *******************************
-- Fonctions prédéfinies
-- *******************************
-- Fonctions prédéfinies : prévue par le langage SQL, et exécutée par le développeur;

-- Dernier id inséré:
INSERT INTO abonne (prenom) VALUES ('test');
SELECT LAST_INSERT_ID(); -- Permet d'afficher le dernier identifiant inséré

-- Fonction de dates:
SELECT *, DATE_FORMAT(date_rendu, '%d-%m-%Y') AS date_rendu_fr FROM emprunt; -- Mets les dates du champs date_rendu_fr au format français JJ-MM-AAAA
-- les minuscules donnent 2 chiffres et les majuscules 4
-- juste formatage lecture, pas de modifications de la base de données

SELECT NOW(); -- Affiche la date et l'heure en cours
SELECT DATE_FORMAT(NOW(), '%d-%m-%Y %H:%i:%s');

SELECT CURDATE(); -- Retourne la date du jour au format YYYY-MM-DD
SELECT CURTIME(); -- Retourne l'heure courante au format hh:mm:ss

-- Crypter un mot de passe avec l'algorithme AES:
SELECT PASSWORD('mypass'); -- affiche 'mypass' crypté par l'algorithme AES
INSERT INTO abonne (prenom) VALUES(PASSWORD('mypass')); -- Insère le mot de pass crypté en base

-- Concaténation
SELECT CONCAT('a', 'b', 'c'); -- Concatène les 3 chaînes de caractères
SELECT CONCAT_WS( '-', 'a', 'b', 'c'); -- Concat with separator (concaténation avec un séparateur)

-- Fonctions sur les chaînes de caractères:
SELECT SUBSTRING('bonjour', 1, 3); -- Affiche 'bon': compte 3 à partir de la position 1
-- Une des rares fonctions qui compte à partir de 1 et non pas 0
SELECT TRIM('   Bonjour     '); -- Nettoie, supprime les espaces avant et après la chaîne de caractères

-- Sources pour trouver des fonctions SQL : sql.sh
