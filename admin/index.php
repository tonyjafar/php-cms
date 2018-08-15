<?php include "includes/header.php"; ?>
     <?php include "../includes/db.php"; ?>
<?php
    $posts = mysqli_query($conn, "select * from posts");
    $postsCount = mysqli_num_rows($posts);
    $postsActive = mysqli_query($conn, "select * from posts where post_status = 'public'");
    $postsNotActive = mysqli_query($conn, "select * from posts where post_status = 'draft'");
    $postsActiveCount = mysqli_num_rows($postsActive);
    $postsNotActiveCount = mysqli_num_rows($postsNotActive);

    $comments = mysqli_query($conn, "select * from comments");
    $commentsCount = mysqli_num_rows($comments);
    $commentsActive = mysqli_query($conn, "select * from comments where com_status = 'public'");
    $commentsNotActive = mysqli_query($conn, "select * from comments where com_status = 'draft'");
    $commentsActiveCount = mysqli_num_rows($commentsActive);
    $commentsNotActiveCount =mysqli_num_rows($commentsNotActive);

    $users = mysqli_query($conn, "select * from users");
    $usersCount = mysqli_num_rows($users);
    $usersActive = mysqli_query($conn, "select * from users where active='yes'");
    $usersNotActive = mysqli_query($conn, "select * from users where active='no'");
    $usersActiveCount = mysqli_num_rows($usersActive);
    $usersNotActiveCount = mysqli_num_rows($usersNotActive);
    
    $cats = mysqli_query($conn, "select * from categories");
    $catCount = mysqli_num_rows($cats);
    $catsActiveCount = 0;
     while ($row = mysqli_fetch_assoc($cats)){
        $postsC = "select count(*) from posts where post_category_id = '{$row['cat_id']}' and post_status = 'public'";
        $count = mysqli_query($conn, $postsC);
        $count = mysqli_fetch_assoc($count);
        if ($count['count(*)'] > 0){
            $catsActiveCount++;
        }
    }
    $catsNotActiveCount =  $catCount - $catsActiveCount;

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
                </div>
                       
                <!-- /.row -->
                
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                  <div class='huge'><?php echo $postsCount; ?></div>
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="all_posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                     <div class='huge'><?php echo $commentsCount; ?></div>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <div class='huge'><?php echo $usersCount; ?></div>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="all_users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class='huge'><?php echo $catCount; ?></div>
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
                <!-- /.row -->
            <div class="row">
                <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'All', 'Active', 'Not Active'],
          ['Posts', <?php echo $postsCount; ?>, <?php echo $postsActiveCount; ?>, <?php echo $postsNotActiveCount; ?>],
          ['Users', <?php echo $usersCount; ?>, <?php echo $usersActiveCount; ?>, <?php echo $usersNotActiveCount; ?>],
          ['Comments', <?php echo $commentsCount; ?>, <?php echo $commentsActiveCount; ?>, <?php echo $commentsNotActiveCount; ?>],
          ['Categories', <?php echo $catCount; ?>, <?php echo $catsActiveCount; ?>, <?php echo $catsNotActiveCount; ?>]
        ]);

        var options = {
          chart: {
            title: 'Elements Overview',
            subtitle: 'Posts, Users, Comments and Categories',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
<div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>

            </div>
            </div>
        </div>
<?php include "includes/footer.php"; ?>