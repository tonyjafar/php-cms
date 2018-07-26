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
                            <small>Author</small>
                        </h1>
                    </div>
                    <div class="col-xs-6">
                    <?php
                        $countStat = "select count(*) from posts";
                        $result = mysqli_query($conn, $countStat);
                        $row = mysqli_fetch_assoc($result);
                        $count = $row['count(*)'];
                        echo "<h3>You Have $count Posts</h3>";
                    ?>
<table class='table table-hover'>
  <thead>
    <tr>
      <th scope='col'>#</th>
      <th scope='col'>ID</th>
      <th scope='col'>Title</th>
    </tr>
  </thead>
  <tbody>
                                
            <?php
                    
                    $query = "select * from posts order by post_date DESC";
                    $posts = mysqli_query($conn, $query);
                    $x = 1;
                    while ($row = mysqli_fetch_assoc($posts)){
                        $id = $row['post_id'];
                        $title = $row['post_title'];
                        echo "<tr><th scope='row'>$x</th><td>$id</td><td>$title</td><td><a class='btn btn-primary' href='edit-post.php?edit={$row['post_id']}'>Edit Post <span class='glyphicon glyphicon-chevron-right'></span></a><hr></td></tr>";
                        $x++;
                    }
    
                    
                ?>
    </tbody>
</table>
</div>
                </div>
            </div>
        
       </div>
        
<?php include "includes/footer.php"; ?>