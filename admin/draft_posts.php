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
           <form action="draft_posts.php" method="POST">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search by Title">
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
                                $get_stat = "select * from posts where post_title like '%{$search}%' and post_status = 'draft' order by post_date DESC";
                                $posts = mysqli_query($conn, $get_stat);
                                if (mysqli_num_rows($posts) > 0){
                                    while ($row = mysqli_fetch_assoc($posts)){
                                        echo "<h2><a href='../post.php?id={$row['post_id']}'>{$row['post_title']}</a></h2>";
                                        echo "<a class='btn btn-success' href='edit-post.php?edit={$row['post_id']}'>Edit Post <span class='glyphicon glyphicon-chevron-right' ><a class='btn btn-danger' href='edit-post.php?delete={$row['post_id']}'>Delete Post <span class='glyphicon glyphicon-chevron-right'></span></a><hr></span></a>";
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
                        $countStat = "select count(*) from posts where post_status = 'draft'";
                        $result = mysqli_query($conn, $countStat);
                        $row = mysqli_fetch_assoc($result);
                        $count = $row['count(*)'];
                        if ($count > 1){
                            echo "<h3>You Have $count Posts</h3>";
                        }else{
                            echo "<h3>You Have $count Post</h3>";
                        }
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
                    $query = "select * from posts where post_status = 'draft' order by post_date DESC";
                    $posts = mysqli_query($conn, $query);
                    $x = 1;
                    while ($row = mysqli_fetch_assoc($posts)){
                        $id = $row['post_id'];
                        $title = $row['post_title'];
                        echo "<tr><th scope='row'>$x</th><td>$id</td><td>$title</td><td><a class='btn btn-success' href='edit-post.php?edit={$row['post_id']}'>Edit Post <span class='glyphicon glyphicon-chevron-right'></span></a></td><td><a class='btn btn-danger' href='edit-post.php?delete={$row['post_id']}'>Delete Post <span class='glyphicon glyphicon-chevron-right'></span></a></td></tr>";
                        
                        $x++;
                    }
    
                    
                ?>
    </tbody>
</table>
</div>
          
            </div>
        
       </div>
        
<?php include "includes/footer.php"; ?>