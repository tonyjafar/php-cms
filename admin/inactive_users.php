<?php include "includes/header.php"; ?>
<?php include "../includes/db.php"; ?>

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
                              <div class="col-xs-12">
           <form action="inactive_users.php" method="POST">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search by Username">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    </form>
                    <?php
                        if (isset($_POST['search'])){
                            $search = mysqli_real_escape_string($conn, $_POST['search']);
                            if ($search != ""){
                                $get_stat = "select * from users where username like '%{$search}%' and active = 'no'";
                                $users = mysqli_query($conn, $get_stat);
                                if (mysqli_num_rows($users) > 0){
                                    while ($row = mysqli_fetch_assoc($users)){
                                        echo "<h2><a href='#'>{$row['username']}</a></h2>";
                                        echo "<a class='btn btn-success' href='edit-user.php?edit={$row['user_id']}'>Edit User <span class='glyphicon glyphicon-chevron-right' ><a class='btn btn-danger' href='edit-user.php?delete={$row['user_id']}'>Delete User <span class='glyphicon glyphicon-chevron-right'></span></a></span></a>";
                                        echo "";
                                    }  
                                }else{
                                    echo "<h1>No Reult Found</h1>";
                                }
                            }
                    }
                    ?>
                    <div></div>
                </div>
                    <div class="col-xs-6">
                    <?php
                        $countStat = "select count(*) from users where active = 'no'";
                        $result = mysqli_query($conn, $countStat);
                        $row = mysqli_fetch_assoc($result);
                        $count = $row['count(*)'];
                        if ($count > 1){
                            echo "<h3>You Have $count Users</h3>";
                        }else{
                            echo "<h3>You Have $count User</h3>";
                        }
                    ?>
<table class='table table-hover'>
  <thead>
    <tr>
      <th scope='col'>#</th>
      <th scope='col'>ID</th>
      <th scope='col'>Username</th>
      <th scope='col'>Active</th>
      <th scope='col'>Admin</th>
    </tr>
  </thead>
  <tbody>
                                
            <?php
                    $query = "select * from users where active = 'no'";
                    $users = mysqli_query($conn, $query);
                    $x = 1;
                    while ($row = mysqli_fetch_assoc($users)){
                        $id = $row['user_id'];
                        $username = $row['username'];
                        $admin = $row['admin'];
                        $active = $row['active'];
                        echo "<tr><th scope='row'>$x</th><td>$id</td><td>$username</td><td>$active</td><td>$admin</td><td><a class='btn btn-success' href='edit-user.php?edit={$row['user_id']}'>Edit User <span class='glyphicon glyphicon-chevron-right'></span></a></td><td><a class='btn btn-danger' href='edit-user.php?delete={$row['user_id']}'>Delete User <span class='glyphicon glyphicon-chevron-right'></span></a></td></tr>";
                        
                        $x++;
                    }
    
                    
                ?>
    </tbody>
</table>
</div>

            </div>
        
       </div>
        
<?php include "includes/footer.php"; ?>