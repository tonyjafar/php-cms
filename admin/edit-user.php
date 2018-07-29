<?php include "includes/header.php"; ?>
    <?php include "../includes/db.php"; ?>
    
<?php
    $edit = False;
    $delete = False;
    $field_error = False;
    $insert_error = False;
    if (isset($_POST['submit'])){
        foreach ($_POST as $key => $value){
            if ($value == ""){
                $field_error = True;
                break;
            }
        }
    }
    if (isset($_POST['submit']) && !$field_error){
                    $id = $_GET['id'];
                    $admin = mysqli_real_escape_string($conn, $_POST['admin']);
                    $active = mysqli_real_escape_string($conn, $_POST['active']);
                    $stat = "update users set admin = '$admin', active = '$active' where user_id = '$id'";
                    $result = mysqli_query($conn, $stat);
                    if (!$result){
                        echo mysqli_error($conn);
                    }
  
                $url = "all_users.php";
                header('Location: '.$url);
        }elseif(isset($_POST['submit-Del'])){
                    $id = $_GET['id'];
                    $state = "delete from users where user_id = '$id'";
                    $result = mysqli_query($conn, $state);
                    if (!$result){
                        echo mysqli_error($conn);
                    }
        $url = "all_users.php";
                header('Location: '.$url);
                        }

    elseif (isset($_GET['edit'])){
        $id = mysqli_real_escape_string($conn, $_GET['edit']);
        $state = "select * from users where user_id = '$id'";
        $result = mysqli_query($conn, $state);
        if ($result){
            while ($row = mysqli_fetch_assoc($result)){
                $admin = $row['admin'];
                $active = $row['active'];      
            }
            $edit = True;
        }
    }elseif (isset($_GET['delete'])){
        $id = mysqli_real_escape_string($conn, $_GET['delete']);
        $state = "select * from users where user_id = '$id'";
        $result = mysqli_query($conn, $state);
        if ($result){
            while ($row = mysqli_fetch_assoc($result)){
                $admin = $row['admin'];
                $active = $row['active'];
            
            }
            $delete = True;
        }
    }else{
        $url = "all_users.php";
        header('Location: '.$url);
    }

?>

    <div id="wrapper">

        <?php include "includes/navi.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small><?php echo $adminname; ?></small>
                        </h1>
                    </div>
                    <div class="col-xs-6">
                     <form action="edit-user.php?id=<?php echo $id; ?>" method="post">
    
           <div class="form-group">
 
           <label for="user_id">User ID</label>
            <input class="form-control" id="user_id" type="text" name="user_id" value='<?php echo $id; ?>' disabled>

        </div>
        <div class="form-group">

           <label for="Admin">Admin</label>
            <input class="form-control" id="Admin" type="text" name="admin" value='<?php echo $admin; ?>'>
        </div>
        <div class="form-group">
            <label for="active">Active</label>
            <input class="form-control" id="active" type="text" name="active" value="<?php echo $active; ?>">
        </div>
        <br><br>
        <div class="form-group">
        <?php 
            if ($edit){
                echo "<input class='btn btn-success form-group' type='submit' value='Edit User' name='submit'>";
            }else{
                echo "<input class='btn btn-danger form-group' type='submit' value='Delete User' name='submit-Del'>";
                
            }
            ?>
        </div>
    </form>
            
    <?php
    if ($field_error){
        echo "<div class='alert alert-danger' role='alert'>";
        echo "<h3>Please fill in all fields</h3>";
        echo "</div>";
    }elseif ($insert_error){
        echo "<div class='alert alert-danger' role='alert'>";
        echo "<h3>Could not Insert DB Error</h3>";
        echo "</div>";
    }
?>

                </div>
            </div>
            </div>
        <br><br>
</div>
<?php include "includes/footer.php"; ?>
