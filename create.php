<?php

require('config.php');
$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";


try{
    $pdo = new PDO($dsn, $dbUser, $dbPass); 


    if($pdo){
        echo "Er is een verbinding met mijn mysql server";
    }else{
        echo "Er is een interne server error, neem contact op met de beheerder";
    }
} catch(PDOException $e){
    echo $e->getMessage();
}


$sql = "INSERT INTO DureAuto (Id
                         Merk
                         ,Model
                         ,Topsnelheid
                         ,Prijs
    VALUES              (NULL
                         ,:merk
                         ,:model
                         ,:topsnelheid
                         ,:prijs);";


  $statement = $pdo->prepare($sql);  

  $statement->bindValue(':Merk', $_POST['merk'], PDO::PARAM_STR);
  $statement->bindValue(':Model', $_POST['model'], PDO::PARAM_STR);
  $statement->bindValue(':Topsnelheid', $_POST['topsnelheid'], PDO::PARAM_INT);
  $statement->bindValue(':Prijs', $_POST['prijs'], PDO::PARAM_INT); 
try {
    $statement->execute();

}  catch(PDOException $e) {
    echo $e->getMessage();
}

header('Location: read.php');
