<?php include("includes/header.php");
if (!$session->checkSignIn()){
    redirect("login.php");
}
$user = new User();
if (isset($_POST['create'])){
    $user->username = $_POST['username'];
    $user->user_password = $_POST['user_password'];
    $user->user_firstname = $_POST['user_firstname'];
    $user->user_lastname = $_POST['user_lastname'];
    $user->new_user_image = $_FILES['user_photo']['name'];
    $user->tmp_name = $_FILES['user_photo']['tmp_name'];

    move_uploaded_file($user->tmp_name,"user_images/".$user->new_user_image);
    $user->createUser($user->username,$user->user_password,$user->user_firstname,$user->user_lastname,$user->new_user_image);
    flash("user_added","User added successfully");
    redirect("users.php");

}
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
                    <h1 class="page-header">
                        <small>Create User</small>
                    </h1>
                    <form action="" enctype="multipart/form-data" method="post">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Username: </label>
                                <input type="text" name="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Photo: </label>
                                <input type="file" name="user_photo">
                            </div>
                            <div class="form-group">
                                <label for="">Password: </label>
                                <input type="password" name="user_password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Firstname: </label>
                                <input type="text" name="user_firstname" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Lastname: </label>
                                <input type="text" name="user_lastname" class="form-control">
                            </div>
                            <input type="submit" value="Create" name="create" class="btn btn-primary btn-lg center-block">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


    </div>

    <!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>