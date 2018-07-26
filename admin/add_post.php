<?php include "includes/header.php"; ?>
    <?php include "../includes/db.php"; ?>
    
<?php
    $field_error = False;
    $insert_error = False;
    $title_error = False;
    $noErrors = False;
    if (isset($_POST['submit'])){
        foreach ($_POST as $key => $value){
            if ($value == ""){
                $field_error = True;
                break;
            }
        }
    }
    if (isset($_POST['submit']) && !$field_error){
                $post_title = mysqli_real_escape_string($conn, $_POST['post_title']);
                $check_title = "select post_title from posts where post_title = '$post_title'";
                $result = mysqli_query($conn, $check_title);
                if (mysqli_num_rows($result) == 0){
                    $cat_id = mysqli_real_escape_string($conn, $_POST['cat_id']);
                    $post_author = mysqli_real_escape_string($conn, $_POST['post_author']);
                    $date = mysqli_real_escape_string($conn, $_POST['date']);
                    $image = mysqli_real_escape_string($conn, $_POST['image']);
                    $content = mysqli_real_escape_string($conn, $_POST['content']);
                    $tags = mysqli_real_escape_string($conn, $_POST['tags']);
                    $user = mysqli_real_escape_string($conn, $_POST['user']);
                    $status = mysqli_real_escape_string($conn, $_POST['status']);
                    $statePart1 = "insert into posts (post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_user, post_status) ";
                    $statePart2 = "values ('$cat_id', '$post_title', '$post_author', '$date', '$image', '$content', '$tags', '$user', '$status')";
                    $stat = $statePart1 . $statePart2;
                    $result = mysqli_query($conn, $stat);
                    if (!$result){
                        $insert_error = True;
                        echo mysqli_error($conn);

                    }else{
                        $noErrors = True;
                    }
                }else{
                    $title_error = True;
                    
                }
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
                            <small>Author</small>
                        </h1>
                    </div>
                    
                    <div class="col-xs-6">
                    <?php
    if ($field_error){
        echo "<div class='alert alert-danger' role='alert'>";
        echo "<h3>Please fill in all fields</h3>";
        echo "</div>";
    }elseif ($insert_error){
        echo "<div class='alert alert-danger' role='alert'>";
        echo "<h3>Could not Insert DB Error</h3>";
        echo "</div>";
    }elseif ($title_error){
        echo "<div class='alert alert-danger' role='alert'>";
        echo "<h3>Post Title is already taken!!</h3>";
        echo "</div>";
    }elseif ($noErrors){
        echo "<div class='alert alert-success' role='alert'>";
        echo "Post created successfully";
        echo "</div>";
    }
?>

                     <form action="add_post.php" method="post">
        
        <div class="form-group">
           <label for="cat_id">Post Category</label>
           
           <select  class="form-control" name="cat_id" id="cat_id">
              <?php
                    $getCat = "select * from categories";
                    $result = mysqli_query($conn, $getCat);
                    if (!$result){
                        echo mysqli_error($conn);
                    }
                    while ($row = mysqli_fetch_assoc($result)){
                        echo "<option value='{$row['cat_id']}'>{$row['cat_title']}</option>";
                    }
               ?>
           </select>

           </div>
           <div class="form-group">

               <label for="status">Post Status</label>
                <select  class="form-control" name="status" id="status">
                    <option value='draft'>draft</option>
                    <option value='public'>public</option>
                </select>

        </div>
           <div class="form-group">
 
           <label for="post_title">Post Tiltle</label>
            <input class="form-control" id="post_title" type="text" name="post_title" placeholder="Post Title">

        </div>
        <div class="form-group">

           <label for="post-author">Post Author</label>
            <input class="form-control" id="post-author" type="text" name="post_author" placeholder="Post Author">
        </div>
        <?php $create_date = date("Y-m-d H:i:s"); ?>
        <div class="form-group">
            <label for="date">Post Date</label>
            <input class="form-control" id="date" type="text" name="date" value="<?php echo $create_date; ?>">
        </div>
        <div class="form-group">
            <label for="post_image">Post Image</label>
            <input class="form-control" id="post_image" type="text" name="image" placeholder="Post Image">
        </div>
        <div class="form-group">
            <label for="post_tags">Post Tags</label>
            <input class="form-control" id="post_tags" type="text" name="tags" placeholder="Post Tags">
        </div>
        <div class="form-group">
            <label for="post_user">Post User</label>
            <input class="form-control" id="post_user" type="text" name="user" placeholder="Post User">
        </div>
        <div class="media-body form-group">
            <label for="post_content">Post Content</label>
            <textarea class="form-control" id="post_content" rows="20" name="content" placeholder="Post Content"></textarea>
        </div>
        <br><br>
        <div class="form-group">
        <input class="btn btn-success form-group" type="submit" value="Add Post" name="submit">
        </div>
    </form>
                </div>
            </div>
            </div>
        <br><br>
</div>
<?php include "includes/footer.php"; ?>
