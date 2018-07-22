
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
                    $get_stat = "select * from posts where post_tags like '%{$search}%' order by post_date DESC";
                    $posts = mysqli_query($conn, $get_stat);
                    if (mysqli_num_rows($posts) > 0){
                        while ($row = mysqli_fetch_assoc($posts)){
                        echo "<h2><a href='#'>{$row['post_title']}</a></h2>";
                        echo "<p class='lead'>by <a href='#'>{$row['post_author']}</a></p>";
                        echo "<p><span class='glyphicon glyphicon-time'></span>{$row['post_date']}</p><hr>";
                        echo "<img class='img-responsive' src='images/{$row['post_image']}' alt=''><hr>";
                        echo "<p>{$row['post_content']}</p>";
                        echo "<a class='btn btn-primary' href='#'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a><hr>";
                        }    
                    }else{
                        echo "<h1>No Reult Found</h1>";
                }
                    }else{
                        echo "<h1>No Reult Found</h1>";
                }
                    }else{
                        $newURL = "index.php";
                        header('Location: '.$newURL);
                }
                ?>
            </div>

            <!-- Blog Sidebar Widgets Column -->
      <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>
    <?php include "includes/footer.php"; ?>