<?php include("includes/header.php");
require_once "includes/photo_modal.php";
if (!$session->checkSignIn()){
    redirect("login.php");
}
if (empty($_GET['id'])){
    redirect("photos.php");
}
$user = new User();
if ($_GET['id']){
    $id = $_GET['id'];
    $data = $user->findUserById($id);
}else{
    redirect("users.php");
}
if (isset($_POST['update'])){
    $data->username = $_POST['username'];
    $data->user_password = $_POST['user_password'];
    $data->user_firstname = $_POST['user_firstname'];
    $data->user_lastname = $_POST['user_lastname'];
    $data->new_user_image = $_FILES['user_photo']['name'];
    $data->tmp_name = $_FILES['user_photo']['tmp_name'];

    if ($data->user_image != $data->new_user_image){
        unlink("user_images/".$data->user_image);
        move_uploaded_file($data->tmp_name,"user_images/".$data->new_user_image);
    }

    $user->updateUserCostum($id,$data->username,$data->user_password,$data->user_firstname,$data->user_lastname,$data->new_user_image);
    redirect("edit_user.php");
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
                        <small>Subheading</small>
                    </h1>
                    <form action="" enctype="multipart/form-data" method="post">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Username: </label>
                                <input  type="text" name="username" class="form-control" value="<?php echo $data->username ?>">
                            </div>
                            <div class="form-group photo_shower">
                                <label for="">Photo: </label>
                                <a id="user-id" class="thumbnail" href="" data-toggle="modal" data-target="#photo-library"><img src="user_images/<?php echo trim($data->user_image) ?>" alt="" width="300" height="250"></a>
                                <input type="file" name="user_photo">
                            </div>
                            <div class="form-group">
                                <label for="">Password: </label>
                                <input type="password" name="user_password" class="form-control" value="<?php echo $data->password ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Firstname: </label>
                                <input type="text" name="user_firstname" class="form-control" value="<?php echo $data->user_firstname ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Lastname: </label>
                                <input type="text" name="user_lastname" class="form-control" value="<?php echo $data->user_lastname ?>">
                            </div>
                            <input type="submit" value="Update" name="update" class="btn btn-primary btn-lg center-block">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


    </div>

    <!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>