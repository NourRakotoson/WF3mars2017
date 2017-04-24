-- *******************************
-- EXERCICES
-- *******************************

-- 1.Qui conduit la voiture d'id_vehicule 503?
SELECT prenom, nom FROM conducteur WHERE id_conducteur IN (SELECT id_conducteur FROM association_vehicule_conducteur WHERE id_vehicule = 503);

SELECT c.prenom, c.nom FROM conducteur c INNER JOIN association_vehicule_conducteur a ON c.id_conducteur = a.id_conducteur WHERE a.id_vehicule = 503;

-- 2.Qui conduit quel modèle?
SELECT c.prenom, c.nom, v.marque, v.modele
FROM conducteur c
INNER JOIN association_vehicule_conducteur a
ON c.id_conducteur = a.id_conducteur
INNER JOIN vehicule v
ON a.id_vehicule = v.id_vehicule;

-- 3.Insérez vous dans table conducteur. Puis afficher tous les conducteurs (même ceux qui n'ont pas de véhicules affectés), ainsi que les modèles de véhicules.
INSERT INTO conducteur (id_conducteur, prenom, nom) VALUES('6', 'Nour', 'Rakotoson');

-- 4.Ajoutez l'enregistrement suivant:
INSERT INTO vehicule (marque, modele, couleur, immatriculation) VALUES ('Renault', 'Espace', 'noir', 'ZE-123-RT');
-- Puis affichez tous les modèles de véhicule, y compris ceux qui n'ont pas de chauffeur affecté, et le prénom des conducteurs.
SELECT c.prenom, v.modele
FROM vehicule v 
LEFT JOIN association_vehicule_conducteur a 
ON v.id_vehicule = a.id_vehicule
LEFT JOIN conducteur c 
ON a.id_conducteur = c.id_conducteur;

-- 5.Affichez les prénoms des conducteurs (y compris ceux qui n'ont pas de véhicules) et tous les modèles (y compris ceux qui n'ont pas de chauffeur).
(SELECT c.prenom, v.modele
FROM conducteur c
LEFT JOIN association_vehicule_conducteur a 
ON c.id_conducteur = a.id_conducteur
LEFT JOIN vehicule v
ON a.id_vehicule = v.id_vehicule)
UNION
(SELECT c.prenom, v.modele
FROM conducteur c
RIGHT JOIN association_vehicule_conducteur a
ON c.id_conducteur = a.id_conducteur
RIGHT JOIN vehicule v
ON a.id_vehicule = v.id_vehicule);
