<?php

$pdo = new PDO('mysql:host=localhost;dbname=ecole', 'root', 'troiswa');

$pdo->exec('SET NAMES UTF8');

//LISTE ELEVES ELEVE ET CLASSE

$query = $pdo->prepare('
    SELECT  eid, prenom, nom, classe, ROUND(SUM(valeur)/COUNT(valeur),2) AS moyenne, cid FROM eleves NATURAL JOIN classes NATURAL LEFT JOIN notes GROUP BY eid ORDER BY classe, nom;
');

$query->execute();

$listeEleves = $query->fetchAll(PDO::FETCH_ASSOC);

//LISTE CLASSE ET EFFECTIFS ET MOYENNE PAR CLASSE

$query = $pdo->prepare('
    SELECT classe, COUNT(eid) AS NombreElevesParClasse, ROUND(SUM(valeur)/count(valeur),2) AS moyenneClasse FROM classes NATURAL LEFT JOIN eleves NATURAL LEFT JOIN notes GROUP BY cid ORDER BY niveau;
');

$query->execute();

$listeClasses = $query->fetchAll(PDO::FETCH_ASSOC);

//LISTE EFFECTIFS de chaque CLASSE

$query = $pdo->prepare('
    SELECT  COUNT(eid) AS NombreElevesParClasse, classe, cid FROM classes NATURAL LEFT JOIN eleves GROUP BY cid ORDER BY niveau;
');

$query->execute();

$listeClassesEffectif = $query->fetchAll(PDO::FETCH_ASSOC);

// LISTE MOYENNE ECOLE

$query = $pdo->prepare('
    SELECT ROUND(SUM(valeur)/count(valeur),2) AS moyenneEcole FROM notes;
');

$query->execute();

$MoyenneEcole = $query->fetch(PDO::FETCH_ASSOC);


// LISTE ELEVE ET NOTE

$query = $pdo->prepare('
    SELECT nom, matiere, valeur, mid, nid FROM notes NATURAL JOIN eleves NATURAL JOIN Matieres ORDER BY mid;
');

$query->execute();

$listeNoteseleve = $query->fetchAll(PDO::FETCH_ASSOC);


// LISTE MOYENNE PAR MATIERE

$query = $pdo->prepare('
    SELECT matiere, ROUND(sum(valeur)/count(valeur),2) AS MoyenneMatiere FROM notes NATURAL JOIN Matieres GROUP BY mid;
');

$query->execute();

$MoyenneMatiere = $query->fetchAll(PDO::FETCH_ASSOC);

// LISTE MATIERE

$query = $pdo->prepare('
    SELECT matiere, mid FROM Matieres GROUP BY mid;
');

$query->execute();

$MatiereDisponible = $query->fetchAll(PDO::FETCH_ASSOC);

//echo 'hello';
//var_dump($listeEleves);
//var_dump($listeClasses);
//var_dump($listeClassesEffectif);
//var_dump($MoyenneEcole);
//var_dump($listeNoteseleve);
//var_dump($MoyenneMatiere);
//var_dump($MatiereDisponible);


include 'index.phtml';

