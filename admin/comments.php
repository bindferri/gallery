<?php include("includes/header.php");
if (!$session->checkSignIn()){
    redirect("login.php");
}
$comment = new Comment();
$allComments = $comment->findAll();
?>


    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->

        <?php include "includes/top_nav.php"?>

        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->

        <?php include "includes/side_nav.php"?>

        <!-- /.navbar-collapse -->
    </nav>

    <div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Users</h1>
                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Photo_id</th>
                            <th>Username</th>
                            <th>Comment</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($allComments as $comments): ?>
                            <tr>
                                <td><?php echo $comments->id ?></td>
<!--                                <td><img src="--><?php //echo $user->user_image($allUsers->user_image) ?><!--" alt="" height="80" width="100"></td>-->
                                <td><?php echo $comments->photo_id ?></td>
                                <td><?php echo $comments->username ?></td>
                                <td><?php echo $comments->body ?></td>
                                <td><a class="btn btn-danger" href="delete_comment.php?id=<?php echo $comments->id;?>">Delete</a></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>