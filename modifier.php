<?php
/**
 * Created by PhpStorm.
 * User: wap26
 * Date: 23/12/15
 * Time: 16:33
 */

$pdo = new PDO('mysql:host=localhost;dbname=ecole', 'root', 'troiswa', array(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION));

$pdo->exec('SET NAMES UTF8');

if(isset($_POST['mid']) && isset($_POST['matiere']) && isset($_POST['submit']))
{
    $mid = $_POST['mid'];
    $matiere = $_POST['matiere'];

    $query = $pdo->prepare('
        UPDATE Matieres set matiere = :matiere WHERE mid = :mid
    ');

    $query->bindValue(':mid',$mid,PDO::PARAM_INT);
    $query->bindValue(':matiere',$matiere,PDO::PARAM_INT);

    $resultat = $query->execute();

    if($resultat)
    {
        $resultatDonne = 'OKMODIF';
    }
    else
    {
        $resultatDonne = "KO";
    }

}
elseif(isset($_POST['modificationClasse']))
{
    $cid = intval($_POST['cid']);
    $eid = intval($_POST['eid']);

    $query = $pdo->prepare('
        UPDATE eleves set cid = :cid WHERE eId = :eid
    ');

    $query->bindValue(':cid',$cid,PDO::PARAM_INT);
    $query->bindValue(':eid',$eid,PDO::PARAM_INT);

    $resultat = $query->execute();

    if($resultat)
    {
        $resultatDonne = 'OKMODIF';
    }
    else
    {
        $resultatDonne = "KO";
    }

}




header('Location:index.php?resultatDonne='. $resultatDonne);

die();