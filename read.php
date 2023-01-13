<?php
 
  require('config.php');

  $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";

  try {
    $pdo = new PDO($dsn, $dbUser, $dbPass);
    if ($pdo) {
        // echo "De verbinding is gelukt";
    } else {
        echo "Interne server-error";
    }
  } catch(PDOException $e) {
    echo $e->getMessage();
  }


  $sql = "SELECT Id
            ,Merk
            ,Model
            ,Topsnelheid
            ,Prijs
             FROM DureAuto";

  
  $statement = $pdo->prepare($sql);

  
  try {
    $statement->execute();

}  catch(PDOException $e) {
    echo $e->getMessage();
}

  
  $result = $statement->fetchAll(PDO::FETCH_OBJ);

  

  $rows = "";
  foreach ($result as $info) {
    $rows .= "<tr>
                <td>$info->Id</td>
                <td>$info->Merk</td>
                <td>$info->Model</td>
                <td>$info->Topsnelheid</td>
                <td>$info->Prijs</td>
                <td>
                    <a href='delete.php?Id=$info->Id'>
                        <img src='b_drop.png' alt='kruis'>
                    </a>
                </td>
                <td>
                </td>
              </tr>";
  }
  



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>De vijf duurste auto's ter wereld</h3>

    <br>
    <br>
    <table border='1'>
        <thead>
            <th>Id</th>
            <th>Voornaam</th>
            <th>Tussenvoegsel</th>
            <th>Achternaam</th>
            <th>Leeftijd</th>
            <th></th>
            <th></th>
        </thead>
        <tbody>
            <?= $rows; ?>
        </tbody>
    </table>
</body>
</html>

