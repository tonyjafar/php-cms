<?php include "includes/header.php"; ?>
<?php include "includes/navigation.php"; ?>
<?php
    $user = new Users();
    if ($user -> LoggedIn()){
        $username = $_COOKIE['loggedIn'];
    }else{
        header("Location: index.php");
        exit();
    }
    ?>

<div class="container">
<div class="row">
<div class="col-md-8">
<h1 class="page-header">Welcome To Your Profile <?php echo $username ?></h1>
<h3>Change your Password:</h3>
<br><br>
<form action="get_user.php" method="post">
       <div class="form-group">
       <label for="old-password">Password</label>
       <input id="old-password" type="password" class="form-control" name="old-password">
       </div>
       <div class="form-group">
       <label for="new-password">New Password</label>
       <input id="new-password" type="password" class="form-control" name="new-password">
       </div>
       <div class="form-group">
       <label for="password2">Retype new Password</label>
       <input id="password2" type="password" class="form-control" name="password2">
       </div>
        <input class="btn btn-success form-group" type="submit" value="Submit" name="change">
</form>
<br><br>
<?php
    if (isset($_POST['change'])){
        $changIt = $user -> ChangePass($username);
        switch ($changIt){
            case "0":
                echo "<div class='alert alert-danger' role='alert'>";
                echo "<h3>Please Fill in All Fields.</h3>";
                echo "</div>";
                break;
            case "1":
                echo "<div class='alert alert-danger' role='alert'>";
                echo "<h3>password must be at least 6 charachters</h3>";
                echo "</div>";
                break;
            case "2":
                echo "<div class='alert alert-danger' role='alert'>";
                echo "<h3>Passwords do not matched</h3>";
                echo "</div>";
                break;
            case "3":
                echo "<div class='alert alert-danger' role='alert'>";
                echo "<h3>Password is not correct.</h3>";
                echo "</div>";
                break;
            case "OK":
                echo "<div class='alert alert-success' role='alert'>";
                echo "password updated successfully";
                echo "</div>";
        }
    }
    ?>
</div>
<?php include "includes/sidebar.php"; ?>
</div>

  <hr>
<?php include "includes/footer.php"; ?>