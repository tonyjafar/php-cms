<?php
include "includes/header.php";
include "includes/navigation.php";
$log = $user -> LoggedIn();
if ($log){
    header("Location: index.php");
}
?>
<div class="col-xs-8">
<form action="register.php" method="post">
      <div class="form-group">
       <label for="email">Email</label>
       <input id="email" type="email" class="form-control" name="username">
       </div>
       <div class="form-group">
       <label for="password">Password</label>
       <input id="password" type="password" class="form-control" name="password">
       </div>
       <div class="form-group">
       <label for="password2">Retype Password</label>
       <input id="password2" type="password" class="form-control" name="password2">
       </div>
        <input class="btn btn-success form-group" type="submit" value="Register" name="add">
</form>
<br><br><br>
<?php
    if (isset($_POST['add'])){
                $result = $user -> CreateUser();
                switch ($result){
                    case "Could not create the user please try again later":
                        echo "<div class='alert alert-danger' role='alert'>";
                        echo "<h3>Could not create the user please try again later</h3>";
                        echo "</div>";
                        break;
                    case "Username is already taken":
                        echo "<div class='alert alert-danger' role='alert'>";
                        echo "<h3>Username is already takens</h3>";
                        echo "</div>";
                        break;
                    case "Passwords do not matched":
                        echo "<div class='alert alert-danger' role='alert'>";
                        echo "<h3>Passwords do not matched</h3>";
                        echo "</div>";
                        break;
                    case "Password should be 6 char long":
                        echo "<div class='alert alert-danger' role='alert'>";
                        echo "<h3>Password should be 6 char long</h3>";
                        echo "</div>";
                        break;
                    case "please fill in all fields":
                        echo "<div class='alert alert-danger' role='alert'>";
                        echo "<h3>please fill in all fields</h3>";
                        echo "</div>";
                        break;
                    case "done":
                        echo "<div class='alert alert-success' role='alert'>";
                        echo "User registered successfully";
                        echo "</div>";
                }
            }
    ?>
</div>

<?php 
include "includes/sidebar.php";
include "includes/footer.php";
?>
