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
                                
            <?php
                    
                    $query = "select * from posts order by post_date DESC";
                    $posts = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($posts)){
                        echo "<h2><a href='../post.php?id={$row['post_id']}'>{$row['post_title']}</a></h2>";
                        echo "<p class='lead'>by <a href='#'>{$row['post_author']}</a></p>";
                        echo "<p><span class='glyphicon glyphicon-time'></span>{$row['post_date']}</p><hr>";
                        echo "<img class='img-responsive' src='../images/{$row['post_image']}' alt=''><hr>";
                        echo "<p>{$row['post_content']}</p>";
                        echo "<a class='btn btn-primary' href='edit-post.php?edit={$row['post_id']}'>Edit Post <span class='glyphicon glyphicon-chevron-right'></span></a><hr>";
                    }
                    
                ?>
                </div>
            </div>
        
       </div>
        
<?php include "includes/footer.php"; ?>