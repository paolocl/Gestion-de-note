<?php
/**
 * Created by PhpStorm.
 * User: wap26
 * Date: 23/12/15
 * Time: 14:38
 */

$pdo = new PDO('mysql:host=localhost;dbname=ecole', 'root', 'troiswa', array(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION));

$pdo->exec('SET NAMES UTF8');

if(isset($_POST['valeur']) && isset($_POST['matiere']) && isset($_POST['submit']) && isset($_POST['eid']) && $_POST['valeur']<=20 && $_POST['valeur']>=0 && is_float(floatval($_POST['valeur'])))
{
    $note =  $_POST['valeur'];
    $matiere = $_POST['matiere'];
    $eid = $_POST['eid'];

    $query = $pdo->prepare("
        INSERT INTO notes VALUES ('',:note,:eid,:matiere)
    ");

    $query->bindValue(':note',$note,PDO::PARAM_STR);
    $query->bindValue(':eid',$eid,PDO::PARAM_INT);
    $query->bindValue(':matiere',$matiere,PDO::PARAM_STR);


    $resultat = $query->execute();
    $resultatDonne = ($resultat) ? "OKINSERT" : "KO";
}
elseif(isset($_POST['valeur']) && ($_POST['valeur']<0 || $_POST['valeur']>20 || !is_float(floatval ($_POST['valeur']))))
{
    $resultatDonne = 'OKSUPA20';
}elseif(isset($_POST['submit']) && isset($_POST['matiereAjoutee']))
{
    $matiere = $_POST['matiereAjoutee'];

    $query = $pdo->prepare("
        INSERT INTO Matieres VALUES ('',:matiere)
    ");

    $query->bindValue(':matiere',$matiere,PDO::PARAM_STR);


    $resultat = $query->execute();

    $resultatDonne = ($resultat) ? 'OKINSERT' : 'KOINSERT';


}elseif(isset($_POST['ajouterEleve']) && isset($_POST['prenomAjout']) && isset($_POST['nomAjout']) && isset($_POST['cid']))
{

    $run = true;

    $query = $pdo->prepare('
      SELECT  eid, prenom, nom, classe, ROUND(SUM(valeur)/COUNT(valeur),2) AS moyenne, cid FROM eleves NATURAL JOIN classes NATURAL LEFT JOIN notes GROUP BY eid ORDER BY classe, nom;
');

    $query->execute();

    $listeEleves = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach($listeEleves as $unEleve){
        if($unEleve['nom'] === $_POST['nomAjout'] && $unEleve['prenom'] === $_POST['prenomAjout'] && $unEleve['cid'] === $_POST['cid']){
            $run = false;
        }
    }

    if($run){
        $nom = $_POST['nomAjout'];
        $prenom = $_POST['prenomAjout'];
        $cid = $_POST['cid'];

        $query = $pdo->prepare("
          INSERT INTO eleves VALUES ('' ,:prenom,:nom,:cid)
        ");

        $query->bindValue(':nom',$nom,PDO::PARAM_STR);
        $query->bindValue(':prenom',$prenom,PDO::PARAM_STR);
        $query->bindValue(':cid',$cid,PDO::PARAM_INT);

        $resultat = $query->execute();

        $resultatDonne = ($resultat) ? 'OKINSERT' : 'KOINSERT';
    }else{
        $resultatDonne = 'KOINSERT';
    }

}
header('Location:index.php?resultatDonne='. $resultatDonne);
die();