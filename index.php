
    <?php include "includes/header.php"; ?>
    <?php include "includes/paginator.php"; ?>
    <?php 
            if (isset($_POST['login'])){
                $result = $user -> Login();
                switch ($result){
                    case "Username or Password is not correct":
                        echo "<div class='alert alert-danger' role='alert'>";
                        echo "<h3>Username or Password is not correct</h3>";
                        echo "</div>";
                        break;
                    case "Please fill in all fields":
                        echo "<div class='alert alert-danger' role='alert'>";
                        echo "Please fill in all fields";
                        echo "</div>";
                        break;
                    case "Your account is still not active, please try again later":
                        echo "<div class='alert alert-danger' role='alert'>";
                        echo "Your account is still not active, please try again later";
                        echo "</div>";
                }
            }
    ?> 
     <!-- Navigation -->
  <?php include "includes/navigation.php"; ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Our Blog Posts
                    <small>List of all posts starting the newest Post.</small>
                </h1>

                <!-- First Blog Post -->
                <?php
                    $query = "select * from posts where post_status = 'public' order by post_date DESC";
                    $posts = mysqli_query($conn, $query);
                    $pager = new Pager();
                    $pager -> listLength = mysqli_num_rows($posts);
                    $get = $pager -> PageIt(mysqli_fetch_all($posts));
                    foreach($get as $row){
                        echo "<h2><a href='post.php?id={$row[0]}'>{$row[2]}</a></h2>";
                        echo "<p class='lead'>by <a href='user-posts.php?author={$row[3]}'>{$row[3]}</a></p>";
                        echo "<p><span class='glyphicon glyphicon-time'></span>{$row[4]}</p><hr>";
                        echo "<img class='img-responsive' src='images/{$row['5']}' alt=''><hr>";
                        $content = substr($row[6],0,50) . ".......";
                        echo "<p>{$content}</p>";
                        echo "<a class='btn btn-primary' href='post.php?id={$row[0]}'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a><hr>";
                    }
                    
                    if($pager -> next == true){
                        $pageNum = $pager ->PageNum +1;
                        echo "<a class='btn btn-info pull-right' href=index.php?page={$pageNum}>Next Page</a>";
                    }
                    if($pager -> prev == true){
                        $pageNumP = $pager ->PageNum -1;
                        echo "<a class='btn btn-info pull-left' href=index.php?page={$pageNumP}>Prev Page</a>";
                    }
                ?>
            </div>

            <!-- Blog Sidebar Widgets Column -->
   
      <?php include "includes/sidebar.php"; ?>
 
        </div>
        <!-- /.row -->

        <hr>
    <?php include "includes/footer.php"; ?>