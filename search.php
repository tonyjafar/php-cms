
    <?php include "includes/header.php"; ?>
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
                if (isset($_POST['search'])){
                    $search = mysqli_real_escape_string($conn, $_POST['search']);
                    if ($search != ""){
                        $get_stat = "select * from posts where post_tags like '%{$search}%' and post_status = 'public' order by post_date DESC";
                        $posts = mysqli_query($conn, $get_stat);
                        if (mysqli_num_rows($posts) > 0){
                            while ($row = mysqli_fetch_assoc($posts)){
                                echo "<h2><a href='post.php?id={$row['post_id']}'>{$row['post_title']}</a></h2>";
                                echo "<p class='lead'>by <a href='user-posts.php?author={$row['post_author']}'>{$row['post_author']}</a></p>";
                                echo "<p><span class='glyphicon glyphicon-time'></span>{$row['post_date']}</p><hr>";
                                echo "<img class='img-responsive' src='images/{$row['post_image']}' alt=''><hr>";
                                $content = substr($row['post_content'],0,50) . ".......";
                                echo "<p>{$content}</p>";
                                echo "<a class='btn btn-primary' href='post.php?id={$row['post_id']}'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a><hr>";
                            }    
                        }else{
                            echo "<h1>No Reult Found</h1>";
                        }
                    }else{
                        $newURL = "index.php";
                        header('Location: '.$newURL);
                        exit();
                    }
                }else{
                    $newURL = "index.php";
                    header('Location: '.$newURL);
                    exit();
                }
                ?>
            </div>

            <!-- Blog Sidebar Widgets Column -->
      <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>
    <?php include "includes/footer.php"; ?>