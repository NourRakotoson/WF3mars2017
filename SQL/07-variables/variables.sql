-- *******************************
-- Les variables en SQL
-- *******************************

-- Une variable est un espace mémoire nommé qui permet de conserver une valeur.

-- Permet d'observer les variables systèmes:
SHOW VARIABLES;

SELECT @@version; -- On met 2 @ pour accéder à une variable système.

-- Déterminer nos propres variables;
SET @ecole = "WF3"; -- Déclare une variable ecole et lui affecte la valeur 'WF3'.
SELECT @ecole; -- On peut accéder au contenu de cette variable par son nom. 