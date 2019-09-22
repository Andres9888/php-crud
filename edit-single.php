<?php



require "config.php";
require "escape.php";

if (isset($_GET['id'])) {
    echo $_GET['id'];
    try {
        $id = $_GET['id'];


        $connection = new PDO($dsn, $username, $password, $options);

        $sql = "SELECT * FROM users WHERE id = :id";
        
        $PreparedStatement = $connection->prepare($sql);

        $PreparedStatement->bindValue(':id', $id);

        $PreparedStatement->execute();

        $user = $PreparedStatement->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $error) {
        echo $sql . "<br>" .  $error->getMessage();
    }
} else {
    echo "something went wrong!";
   
    exit;
}


if (isset($_POST['submit'])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);

        $user = [

                "id" => $_POST['id'],
                "firstname" => $_POST['firstname'],
                "lastname" => $_POST['lastname'],
                "phone" => $_POST['phone'],
                "email" => $_POST['email'],
                "date" => $_POST['date']


        ];


        $sql = "
                UPDATE users
                SET id = :id,
                    firstname = :firstname,
                    lastname = :lastname,
                    phone = :phone,
                    email = :email,
                    date = :date
                WHERE id = :id;

        
        
        
        
        
        ";

        $PreparedStatement = $connection->prepare($sql);
        $PreparedStatement->execute($user);
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}








?>

<form method="post">
    <?php  foreach ($user as $key => $value) :
        
     ?>
           <label for="<?php echo $key;?>">  <?php echo ucfirst($key);?> </label>




           <input type="text" name="<?php echo $key; ?>" id="<?php echo $key ?>" value="<?php echo escape($value) ;?>"
           <?php echo ($key === 'id' ? 'readonly' : null); ?>
           
           
           
           >

          <br>
            

           

    <?php endforeach; ?>
                  
    <input type="submit" name="submit" value="submit">

</form>

<a href="index.php">Go Back Home</a>
