<?php include "includes/header.php"; ?>
<?php include "../includes/db.php"; ?>
<?php
if (isset($_POST['Category'])){
    $cat = mysqli_real_escape_string($conn, $_POST['Category']);
    if($cat != ""){
        $check = "select cat_title from categories";
        $check_res = mysqli_query($conn, $check);
        $titles = array();
        while ($row = mysqli_fetch_row($check_res)){
            array_push($titles, $row[0]);
        }
        if (!in_array($cat, $titles)){
            $query = "insert into categories (cat_title) values ('$cat')";
            $result = mysqli_query($conn, $query);
            if (!$result){
                echo mysqli_error($conn);
            }
        }
    }else{
        $url = "categories.php";
        header('Location: '.$url);
    }
}elseif (isset($_POST['old-Category']) && isset($_POST['new-Category'])){
    $cat_old = mysqli_real_escape_string($conn, $_POST['old-Category']);
    $cat_new = mysqli_real_escape_string($conn, $_POST['new-Category']);
    if($cat_old != "" && $cat_new != ""){
        $query = "update categories set cat_title = '$cat_new' where cat_title = '$cat_old'";
        $result = mysqli_query($conn, $query);
        if (!$result){
            echo mysqli_error($conn);
        }
    }else{
        $url = "categories.php";
        header('Location: '.$url);
    }
}elseif (isset($_POST['Del-Category'])){
    $cat = mysqli_real_escape_string($conn, $_POST['Del-Category']);
    if($cat != ""){
        $query = "delete from categories where cat_title = '$cat'";
        $result = mysqli_query($conn, $query);
        if (!$result){
            echo mysqli_error($conn);
        }
    }else{
        $url = "categories.php";
        header('Location: '.$url);
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
<table class='table table-hover'>
  <thead>
    <tr>
      <th scope='col'>#</th>
      <th scope='col'>ID</th>
      <th scope='col'>Category</th>
      <th scope='col'>Nr.Articles</th>
    </tr>
  </thead>
  <tbody>

<?php
$catState = "select * from categories";
$result = mysqli_query($conn, $catState);
if ($result) {
    $x = 1;
    while ($row = mysqli_fetch_assoc($result)){
        $id = $row['cat_id'];
        $category = $row['cat_title'];
        $countState = "select count(post_category_id) from posts where post_category_id = '$id'";
        $result_count = mysqli_query($conn, $countState);
        $count = mysqli_fetch_assoc($result_count);
        $count2 = $count['count(post_category_id)'];
        echo "<tr><th scope='row'>$x</th><td>$id</td><td>$category</td><td>$count2</td></tr>";
        $x++;
    }
    
}
?>
</tbody>
</table>
</div>
</tbody>
</table>
<div class="col-xs-6">
<form action="categories.php" method="post">
      <div class="form-group">
       <label for="Category">Add Category</label>
        <input class="form-control" id="Category" type="text" name="Category" placeholder="Add Category">
       </div>
        <input class="btn btn-primary" type="submit" value="Add" name="submit">
</form>
</div>
<br><br>
<div class="col-xs-6">
<form action="categories.php" method="post">
      <div class="form-group">
       <label for="Category">Old Category</label>
        <input class="form-control" id="Category" type="text" name="old-Category" placeholder="Old Category">
       </div>
       <div class="form-group">
       <label for="Category">New Category</label>
        <input class="form-control" id="Category" type="text" name="new-Category" placeholder="New Category">
       </div>
        <input class="btn btn-success" type="submit" value="Edit" name="submit">
</form>
</div>
<div class="col-xs-6">
<form action="categories.php" method="post">
      <div class="form-group">
       <label for="Category">Delete Category</label>
        <input class="form-control" id="Category" type="text" name="Del-Category" placeholder="Delete Category">
       </div>
        <input class="btn btn-danger" type="submit" value="Delete" name="submit">
</form>
</div>
</div>
                </div>
            </div>
        </div>
<?php include "includes/footer.php"; ?>
