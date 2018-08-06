
    <?php include "includes/header.php"; ?>

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
                 <?php
                    if (isset($_GET['author'])){
                        $name = $_GET['author'];
                        $countQuery = "select count(*) from posts where post_author = '$name' and post_status='public'";
                        $postsQuery = "select * from posts where post_author = '$name' and post_status='public' order by post_date DESC";
                        $count = mysqli_query($conn, $countQuery);
                        $posts = mysqli_query($conn, $postsQuery);
                        $count = mysqli_fetch_assoc($count);
                        $count = $count['count(*)'];
                        if ($count > 0){
                            if ($count >1){
                                echo "<h1 class='page-header'> The Author has {$count} Posts </h1>";
                            }else{
                                echo "<h1 class='page-header'> The Author has {$count} Post </h1>";
                            }
                            while ($row = mysqli_fetch_assoc($posts)){
                                echo "<h2><a href='post.php?id={$row['post_id']}'>{$row['post_title']}</a></h2>";
                                echo "<p class='lead'>by <a href='#'>{$row['post_author']}</a></p>";
                                echo "<p><span class='glyphicon glyphicon-time'></span>{$row['post_date']}</p><hr>";
                                echo "<img class='img-responsive' src='images/{$row['post_image']}' alt=''><hr>";
                                $content = substr($row['post_content'],0,50) . ".......";
                                echo "<p>{$content}</p>";
                                echo "<a class='btn btn-primary' href='post.php?id={$row['post_id']}'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a><hr>";
                            }
                        }else{
                            header("Location: index.php");
                        }
                    }else{
                        header("Location: index.php");
                    }
                ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
   
      <?php include "includes/sidebar.php"; ?>
 
        </div>
        <!-- /.row -->

        <hr>
    <?php include "includes/footer.php"; ?>