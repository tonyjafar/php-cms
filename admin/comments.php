<?php include "includes/header.php"; ?>
<?php include "../includes/db.php"; ?>
<?php
if (isset($_GET['acc'])){
    $id = $_GET['acc'];
    $acState = "update comments set com_status = 'public' where com_id = '$id'";
    $acc = mysqli_query($conn, $acState);
    header("Location: comments.php");
}elseif (isset($_GET['del'])){
    $id = $_GET['del'];
    $delState = "delete from comments where com_id = '$id'";
    $del = mysqli_query($conn, $delState);
    header("Location: comments.php");
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
                    <table class='table table-hover'>
  <thead>
    <tr>
      <th scope='col'>#</th>
      <th scope='col'>ID</th>
      <th scope='col'>User</th>
      <th scope="col">Content</th>
      <th scope="col">Post</th>
      <th scope="col">Date</th>
    </tr>
  </thead>
  <tbody>
                    <?php
                    $comsStat = "select * from comments where com_status = 'draft'";
                    $comments = mysqli_query($conn, $comsStat);
                    $x = 1;
                    while ($row = mysqli_fetch_assoc($comments)){
                        $id = $row['com_id'];
                        $user_name = $row['user_name'];
                        $content = $row['com_content'];
                        $post_id = $row['post_id'];
                        $date = $row['com_date'];
                        $getPost = "select post_title from posts where post_id = '$post_id'";
                        $query = mysqli_query($conn, $getPost);
                        $title = mysqli_fetch_assoc($query);
                        $title = $title['post_title'];
                        echo "<tr><th scope='row'>$x</th><td>$id</td><td>$user_name</td><td>$content</td><td>$title</td><td>$date</td><td><a class='btn btn-success' href='comments.php?acc={$row['com_id']}'>Accept<span class='glyphicon glyphicon-chevron-right'></span></a><hr></td><td><a class='btn btn-danger' href='comments.php?del={$row['com_id']}'>Delete<span class='glyphicon glyphicon-chevron-right'></span></a><hr></td></tr>";
                        
                        $x++;
                    }
                    ?>
                </div>
            </div>
        </div>
<?php include "includes/footer.php"; ?>