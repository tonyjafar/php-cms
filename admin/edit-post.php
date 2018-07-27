<?php include "includes/header.php"; ?>
    <?php include "../includes/db.php"; ?>
    
<?php
    $field_error = False;
    $insert_error = False;
    if (isset($_POST['submit'])){
        foreach ($_POST as $key => $value){
            if ($value == ""){
                $field_error = True;
                break;
            }
        }
    }
    if (isset($_POST['submit']) && !$field_error){
                $id = $_GET['id'];
                $cat_id_new = mysqli_real_escape_string($conn, $_POST['cat_id']);
                $post_title = mysqli_real_escape_string($conn, $_POST['post_title']);
                $post_author = mysqli_real_escape_string($conn, $_POST['post_author']);
                $date = mysqli_real_escape_string($conn, $_POST['date']);
                $image = mysqli_real_escape_string($conn, $_POST['image']);
                $content = mysqli_real_escape_string($conn, $_POST['content']);
                $tags = mysqli_real_escape_string($conn, $_POST['tags']);
                $user = mysqli_real_escape_string($conn, $_POST['user']);
                $status = mysqli_real_escape_string($conn, $_POST['status']);
                $statePart1 = "update posts set post_category_id = '$cat_id_new', post_title = '$post_title', post_author = '$post_author', post_date = '$date', ";
                $statPart2 = "post_image = '$image', post_content = '$content', post_tags = '$tags', post_user = '$user', post_status = '$status' where post_id = '$id'";
                $stat = $statePart1 . $statPart2;
                $result = mysqli_query($conn, $stat);
                if (!$result){
                   echo mysqli_error($conn);
                }
                $url = "all_posts.php";
                header('Location: '.$url);
        }

    elseif (isset($_GET['edit'])){
        $id = mysqli_real_escape_string($conn, $_GET['edit']);
        $state = "select * from posts where post_id = '$id'";
        $result = mysqli_query($conn, $state);
        if ($result){
            while ($row = mysqli_fetch_assoc($result)){
                $cat = $row['post_category_id'];
                $title = $row['post_title'];
                $author = $row['post_author'];
                $date = $row['post_date'];
                $tags = $row['post_tags'];
                $image = $row['post_image'];
                $content = $row['post_content'];
                $user = $row['post_user'];
                $status = $row['post_status'];
            }
        }
    }else{
        $url = "all_posts.php";
        header('Location: '.$url);
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
                     <form action="edit-post.php?id=<?php echo $id; ?>" method="post">
    
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
                        if ($row['cat_id'] == $cat){
                            echo "<option selected='selected' value='{$row['cat_id']}'>{$row['cat_title']}</option>";
                        }else{
                            echo "<option value='{$row['cat_id']}'>{$row['cat_title']}</option>";
                        }
                    }
               ?>
           </select>

           </div>
           <div class="form-group">

               <label for="status">Post Status</label>
                <select  class="form-control" name="status" id="status">
                    <?php
                        if ($status == 'draft'){
                            echo "<option selected='selected' value='draft'>draft</option>";
                            echo "<option value='public'>public</option>";
                        }else{
                            echo "<option selected='selected' value='public'>public</option>";
                            echo "<option value='draft'>draft</option>";
                        }
                    ?>
                </select>

        </div>
           <div class="form-group">
 
           <label for="post_title">Post Tiltle</label>
            <input class="form-control" id="post_title" type="text" name="post_title" value='<?php echo $title; ?>'>

        </div>
        <div class="form-group">

           <label for="post-author">Post Author</label>
            <input class="form-control" id="post-author" type="text" name="post_author" value='<?php echo $author; ?>'>
        </div>
        <?php $create_date = date("Y-m-d H:i:s"); ?>
        <div class="form-group">
            <label for="date">Post Date</label>
            <input class="form-control" id="date" type="text" name="date" value="<?php echo $date; ?>">
        </div>
        <div class="form-group">
            <label for="post_image">Post Image</label>
            <input class="form-control" id="post_image" type="text" name="image" value='<?php echo $image; ?>'>
        </div>
        <div class="form-group">
            <label for="post_tags">Post Tags</label>
            <input class="form-control" id="post_tags" type="text" name="tags" value='<?php echo $tags; ?>'>
        </div>
        <div class="form-group">
            <label for="post_user">Post User</label>
            <input class="form-control" id="post_user" type="text" name="user" value='<?php echo $user; ?>'>
        </div>
        <div class="media-body form-group">
            <label for="post_content">Post Content</label>
            <textarea class="form-control" id="post_content" rows="20" name="content"><?php echo $content; ?></textarea>
        </div>
        <br><br>
        <div class="form-group">
        <input class="btn btn-success form-group" type="submit" value="Edit Post" name="submit">
        </div>
    </form>
            
    <?php
    if ($field_error){
        echo "<div class='alert alert-danger' role='alert'>";
        echo "<h3>Please fill in all fields</h3>";
        echo "</div>";
    }elseif ($insert_error){
        echo "<div class='alert alert-danger' role='alert'>";
        echo "<h3>Could not Insert DB Error</h3>";
        echo "</div>";
    }
?>

                </div>
            </div>
            </div>
        <br><br>
</div>
<?php include "includes/footer.php"; ?>
