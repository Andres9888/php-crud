<?php

if (isset($_POST['submit'])) {
    try {
        require "config.php";

        $connection = new PDO($dsn, $username, $password, $options);

        $new_user = array(
            "lastname" => $_POST['lastname'],
            "firstname" => $_POST['firstname'],
            "phone" => $_POST['phone'],
            "email" => $_POST['email'],

        );


        $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)",
            "users",
            implode(", ", array_keys($new_user)),
            ":" . implode(", :", array_keys($new_user))
        );

        $statement = $connection->prepare($sql);
        $statement->execute($new_user);
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}



?>

<?php if (isset($_POST['submit']) && $statement) { ?>
  <?php echo $_POST['firstname']; ?> successfully added.
<?php } ?>

<h2>Add New User to Phone Book</h2>
<form method="post">
    <label for="lastname">lastname</label>
    <input type="text" name="lastname" id="lastname">
    <br>
    <label for="firstname">firstname</label>
    <input type="text" name="firstname" id="firstname">
    <br>
    <label for="phone">phone</label>
    <input type="text" name="phone" id="phone">
    <br>
    <label for="name">email</label>
    <input type="text" name="email" id="email">
    <br>





    <input type="submit" name="submit" value="submit">




</form>