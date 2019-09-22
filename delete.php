<?php


if (isset($_GET["id"])) {
     try {

        require "config.php";
         $connection = new PDO($dsn, $username, $password, $options);
  
         $id = $_GET["id"];
  
         $sql = "DELETE FROM users WHERE id = :id";
  
         $statement = $connection->prepare($sql);
         $statement->bindValue(':id', $id);
         $statement->execute();
  
         $success = "User successfully deleted";
         echo $success;
     } catch (PDOException $error) {
         echo $sql . "<br>" . $error->getMessage();
     }
 }
?>
 <br>
<a href="index.php">Return to Home</a>