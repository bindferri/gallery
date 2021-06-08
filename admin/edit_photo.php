<?php include("includes/header.php");
if (!$session->checkSignIn()){
    redirect("login.php");
}
if (empty($_GET['id'])){
    redirect("photos.php");
}
$photo = new Photo();
if ($_GET['id']){
    $id = $_GET['id'];
    $data = $photo->findById($id);
}
if (isset($_POST['update'])){
    $data->photo_title = $_POST['photo_title'];
    $data->photo_caption = $_POST['photo_caption'];
    $data->photo_alternate_text = $_POST['photo_alternative'];
    $data->photo_description = $_POST['photo_description'];

    $photo->update($id,$data->photo_title,$data->photo_caption,$data->photo_description,null,$data->photo_alternate_text);
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
            <form action="" method="post">
        <div class="col-md-8">
            <div class="form-group">
                <label for="">Title: </label>
                <input type="text" name="photo_title" class="form-control" value="<?php echo $data->photo_title ?>">
            </div>
            <div class="form-group">
                <label for="">Photo: </label>
                <a class="thumbnail" href="#"><img src="uploads\<?php echo trim($data->photo_filename) ?>" alt="" width="300" height="250"></a>
            </div>
            <div class="form-group">
                <label for="">Caption: </label>
                <input type="text" name="photo_caption" class="form-control" value="<?php echo $data->photo_caption ?>">
            </div>
            <div class="form-group">
                <label for="">Alternative Text: </label>
                <input type="text" name="photo_alternative" class="form-control" value="<?php echo $data->photo_alternate_text ?>">
            </div>
            <div class="form-group">
                <label for="">Description: </label>
                <textarea class="form-control" name="photo_description" id="" cols="30" rows="10"><?php echo $data->photo_description ?></textarea>
            </div>
        </div>
            <div class="col-md-4" >
                <div  class="photo-info-box">
                    <div class="info-box-header">
                        <h4>Save <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>
                    </div>
                    <div class="inside">
                        <div class="box-inner">
                            <p class="text">
                                <span class="glyphicon glyphicon-calendar"></span> Uploaded on: April 22, 2030 @ 5:26
                            </p>
                            <p class="text ">
                                Photo Id: <span class="data photo_id_box"><?php echo $data->id ?></span>
                            </p>
                            <p class="text">
                                Filename: <span class="data"><?php echo $data->photo_filename ?></span>
                            </p>
                            <p class="text">
                                File Type: <span class="data"><?php echo $data->photo_type ?></span>
                            </p>
                            <p class="text">
                                File Size: <span class="data"><?php echo $data->photo_size ?></span>
                            </p>
                        </div>
                        <div class="info-box-footer clearfix">
                            <div class="info-box-delete pull-left">
                                <a  href="delete_photo.php?id=<?php echo $data->id; ?>" class="btn btn-danger btn-lg ">Delete</a>
                            </div>
                            <div class="info-box-update pull-right ">
                                <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg ">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>

        </div>
    </div>
    </div>
    </div>


    </div>

    <!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>