<?php include "includes/header.php"; ?>

    <!-- Navigation -->
 <?php include "includes/navigation.php"; 

?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->
                <?php
                
                    if (isset($_GET['id'])){
                        $id = mysqli_real_escape_string($conn, $_GET['id']);
                        $query = "select * from posts where post_id = '$id' and post_status = 'public'";
                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) !=0){
                            while ($row = mysqli_fetch_assoc($result)){
                                echo "<h1>{$row['post_title']}</h1>";
                                echo "<p class='lead'>by <a href='user-posts.php?author={$row['post_author']}'>{$row['post_author']}</a></p><hr>";
                                echo "<p><span class='glyphicon glyphicon-time'></span>{$row['post_date']}</p><hr>";
                                echo "<img class='img-responsive' src='images/{$row['post_image']}' alt=''><hr>";
                                echo "<p class='lead'>{$row['post_content']}</p><hr>";
                            }
                        }else{
                            $url = "index.php";
                            header('Location: '.$url);
                        }
                    }else{
                        $url = "index.php";
                        header('Location: '.$url);
                    }
                
                 if (isset($_POST['comment'])){
                     if ($user -> LoggedIn()){
                        $comment =  mysqli_real_escape_string($conn, $_POST['comment']);
                        if ($comment != ""){
                            $user_name = $_COOKIE['loggedIn'];
                            $date = date("Y-m-d H:i:s");
                            $commState = "insert into comments (user_name, post_id, com_date, com_content) ";
                            $commState .= "values ('$user_name', '$id', '$date', '$comment')";
                            $result = mysqli_query($conn, $commState);
                            if ($result){
                                echo "<h3>Comment sent to Admin to review.</h3>";
                            }else{
                                die(mysqli_error($conn));
                            }
                        }
                    }
                }
                ?>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment: (You need to be logged in :)  )</h4>
                    <form action= "post.php?id=<?php echo $id;?>" role="form" method="post">
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="comment"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                <?php
                    $comState = "select * from comments where post_id = '$id' and com_status = 'public'";
                    $comments = mysqli_query($conn, $comState);
                    while ($row = mysqli_fetch_assoc($comments)){
                        echo "<div class='media'>";
                        echo "<a class='pull-left' href='#'>";
                        echo "<img class='media-object' src='http://placehold.it/64x64' alt=''>";
                        echo "</a>";
                        echo "<div class='media-body'>";
                        echo "<h4 class='media-heading'>{$row['user_name']} <small>{$row['com_date']}</small></h4>";
                        echo $row['com_content'];
                        echo "</div></div>";
                    }
                ?>
                
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        <!-- Nested Comment -->
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Nested Start Bootstrap
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div>
                        <!-- End Nested Comment -->
                    </div>
                </div>

            </div>

            <!-- Blog Sidebar Widgets Column -->
      <?php include "includes/sidebar.php"; ?>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
<?php include "includes/footer.php"; ?>