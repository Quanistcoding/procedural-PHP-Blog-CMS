<?php include "includes/admin_header.php"?>

    <div id="wrapper">
        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small><?php echo $_SESSION["user_lastname"] ?></small>
                        </h1>
                        
                    </div>
                </div>
                <!-- /.row -->
       
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
                    <?php
                        $query = "SELECT * FROM posts";
                        $query_result = mysqli_query($conn,$query);
                        $post_count = mysqli_num_rows($query_result);
                        echo "<div class='huge'>" . $post_count . "</div>";
                    ?>
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
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
                    <?php
                        $query = "SELECT * FROM comments";
                        $query_result = mysqli_query($conn,$query);
                        $comment_count =  mysqli_num_rows($query_result);
                        echo "<div class='huge'>" . $comment_count . "</div>";
                    ?>
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
                    <?php
                        $query = "SELECT * FROM users";
                        $query_result = mysqli_query($conn,$query);
                        $user_count = mysqli_num_rows($query_result);
                        echo "<div class='huge'>" . $user_count . "</div>";
                    ?>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
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
                    <?php
                        $query = "SELECT * FROM categories";
                        $query_result = mysqli_query($conn,$query);
                        $category_count = mysqli_num_rows($query_result);
                        echo "<div class='huge'>" .  $category_count . "</div>";
                    ?>
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
    <div id="columnchart_material" style="width:auto;height:500px"></div>
</div>
              


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    <?php //GET ALL DATA 
                        $query = "SELECT * FROM posts WHERE post_status = 'draft'";
                        $query_result = mysqli_query($conn,$query);
                        $draft_post_count = mysqli_num_rows($query_result);

                        $query = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
                        $query_result = mysqli_query($conn,$query);
                        $pending_commnet_count = mysqli_num_rows($query_result);

                        $query = "SELECT * FROM users WHERE user_role = 'subscriber'";
                        $query_result = mysqli_query($conn,$query);
                        $subscriber_count = mysqli_num_rows($query_result);
    ?>



    </div>
    <!-- /#wrapper -->
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Date', 'Counts'],
          ['Posts', <?php echo $post_count;?>],
          ['Draft Posts', <?php echo $draft_post_count;?>],
          ['Comments', <?php echo $comment_count;?>],
          ['Pending Comments', <?php echo $pending_commnet_count;?>],
          ['Users', <?php echo $user_count;?>],
          ['Subscribers', <?php echo $subscriber_count;?>],
          ['Categories',<?php echo $category_count;?>]
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    <?php include "includes/admin_footer.php"?>