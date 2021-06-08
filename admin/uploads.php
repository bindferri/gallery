<?php include("includes/header.php");
if (!$session->checkSignIn()){
    redirect("login.php");
}
$message = '';
if (isset($_POST['upload'])){
    $photos = new Photo();
    $photos->photo_title = $_POST['photo_title'];
    $photos->set_file($_FILES['photo_file']);

    if ($photos->createPhoto()){
        flash("photo_added","Photo added successfully");
        redirect("photos.php");
    }else{
        $message = join("<br>",$photos->errors);
    }
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
        <div class="continer-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">UPLOAD</h1>
                    <div class="col-md-6">
                        <?php echo $message ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" name="photo_title" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="file" name="photo_file">
                        </div>
                        <input type="submit" name="upload" value="Upload">
                    </form>
                    </div>
                </div>
            </div>
        </div>

<!--        --><?php //include "includes/admin_content.php"?>

    </div>
    <!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>