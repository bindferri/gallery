<?php include("includes/header.php");
if (!$session->checkSignIn()){
    redirect("login.php");
}
$user = new User();
$users = $user->findAllUsers();
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
                    <h1 class="page-header">Users   <a class="glyphicon glyphicon-plus btn btn-primary" href="add_user.php"></a></h1>
                    <?php flash("user_added"); ?>
                    <?php flash("user_deleted") ?>
                    <div class="col-md-12">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($users as $allUsers): ?>
                            <tr>
                                <td><?php echo $allUsers->id ?></td>
                                <td><img src="<?php echo $user->user_image($allUsers->user_image) ?>" alt="" height="80" width="100"></td>
                                <td><?php echo $allUsers->username ?></td>
                                <td><?php echo $allUsers->password ?></td>
                                <td><?php echo $allUsers->user_firstname ?></td>
                                <td><?php echo $allUsers->user_lastname ?></td>
                                <td><a class="btn btn-success" href="#">View</a></td>
                                <td><a class="btn btn-primary" href="edit_user.php?id=<?php echo $allUsers->id?>">Edit</a></td>
                                <td><a class="btn btn-danger" href="delete_user.php?id=<?php echo $allUsers->id;?>">Delete</a></td>
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