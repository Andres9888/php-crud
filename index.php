 <?php


 try {
     include "config.php";

     $connection = new PDO($dsn, $username, $password, $options);
     $sql = "SELECT * FROM users";
     $statement = $connection->prepare($sql);
     $statement->execute();

     $result = $statement->fetchAll();
 } catch (PDOException $error) {
     echo $sql . "<br>" . $error->getMessage();
 }

 if (isset($_GET["id"])) {
     try {
         $connection = new PDO($dsn, $username, $password, $options);
  
         $id = $_GET["id"];
  
         $sql = "DELETE FROM users WHERE id = :id";
  
         $statement = $connection->prepare($sql);
         $statement->bindValue(':id', $id);
         $statement->execute();
  
         $success = "User successfully deleted";
     } catch (PDOException $error) {
         echo $sql . "<br>" . $error->getMessage();
     }
 }

 if ($result && $statement->rowCount() > 0) { ?>


 <table>
     <thead>


         <tr>

             <th>Action</th>
             <th></th>
             <th>Last</th>
             <th>First</th>
             <th>Phone</th>
             <th>Email</th>

         </tr>

     </thead>

     <tbody>

         <?php foreach ($result as $row) { ?>
         <tr>

             <th><a href="edit-single.php?id=<?php  echo $row['id'];?>">Edit</a></th>
             <td><a href="index.php?id=<?php echo $row["id"]; ?>">Delete</a></td>
             <th><?php echo $row['lastname']; ?></th>
             <th><?php echo $row['firstname']; ?></th>
             <th><?php echo $row['phone']; ?></th>
             <th><?php echo $row['email']; ?></th>




         </tr>


         <?php } ?>
     </tbody>


 </table>








 <?php } else {
     echo "no results in phone book";
 } ?>

 <br>

 <a href="add-users.php">Add User</a>