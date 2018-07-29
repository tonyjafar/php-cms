
                

                                      <div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="POST">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    </form>
                    <!-- /.input-group -->
                </div>
                <?php
                if (!$user -> LoggedIn()){
                    echo "<div class='well'>";
                    echo "<h4>Login</h4>";
                    echo "<form action='index.php' method='POST'>";
                    echo "<div class='form-group'>";
                       echo "<label for='email'>Email</label>";
                        echo "<input id='email' type='email' class='form-control' name='username'>";
                        echo "</div>";
                        echo "<div class='form-group'>";
                        echo "<label for='password'>Password</label>";
                        echo "<input id='password' type='password' class='form-control' name='password'>";
                        echo "</div>";
                        echo "<span class='input-group-btn'>";
                            echo "<input class='btn btn-success form-group' type='submit' value='Log in' name='login'>";
                        echo "</span>";
                         echo "</form>";
                    echo "</div>";
                           }
                    ?>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                               <?php
                                $query = "select DISTINCT cat_title from categories";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($result)){
                                    echo "<li><a href='#'>{$row['cat_title']}</a>";
                                }
                                ?>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
 
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>

            </div>