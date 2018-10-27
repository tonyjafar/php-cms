<?php include "db.php"; ?>
         <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Home</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-right navbar-nav">
                <?php
                    $logged = $user -> LoggedIn();
                    if ($logged){
                        $value = explode(",", $_COOKIE['loggedIn']);
                        $username = $value[0];
                        $admin = $user -> IsAdmin($username);
                        if ($admin){
                            echo "<li><a href='admin/index.php'>Admin</a></li>";
                        }
                        echo "<li><a href='logout.php'>logout</a></li>";
                        echo "<li><a href='get_user.php'>{$username}</a></li>";
                    }else{
                        echo "<li><a href='register.php'>Register</a></li>";
                    }
                    ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
