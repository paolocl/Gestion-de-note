<?php
/**
 * Created by PhpStorm.
 * User: wap26
 * Date: 23/12/15
 * Time: 15:39
 */

$pdo = new PDO('mysql:host=localhost;dbname=ecole', 'root', 'troiswa', array(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION));

$pdo->exec('SET NAMES UTF8');

if(isset($_POST['nid']))
{
    $nid = $_POST['nid'];

    $query = $pdo->prepare('
        DELETE FROM notes WHERE nid = :nid
    ');

    $query->bindValue(':nid',$nid,PDO::PARAM_INT);

    $resultat = $query->execute();

    if($resultat)
    {
        $resultatDonne = 'OKSUPP';
    }
    else
    {
        $resultatDonne = "KO";
    }

}elseif(isset($_POST['mid']))
{
    $mid = $_POST['mid'];

    $query = $pdo->prepare('
        DELETE FROM Matieres WHERE mid = :mid
    ');

    $query->bindValue(':mid',$mid,PDO::PARAM_INT);

    $resultat = $query->execute();

    if($resultat)
    {
        $resultatDonne = 'OKSUPP';
    }
    else
    {
        $resultatDonne = 'KO';
    }

}
header('Location:index.php?resultatDonne='. $resultatDonne);
die();