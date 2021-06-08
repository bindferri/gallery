<?php require_once "includes/header.php";
require_once "includes/init.php";
if (!$session->checkSignIn()){
    redirect("login.php");
}
$comments = new Comment();
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
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Photos</h1>
                    <?php flash("photo_added") ?>
                    <div class="col-md-12">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Type</th>
                                <th>Size</th>
                                <th>Comments</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $photo = new Photo();
                            $allPhotos = $photo->findAll();
                             foreach ($allPhotos as $all): ?>
                            <tr>
                                <td><?php echo $all->id ?></td>
                                <td><img src="uploads\<?php echo trim($all->photo_filename) ?>" alt="" width="100" height="70">
                                <div class="picture_link">
                                    <a href="../photo.php?id=<?php echo $all->id?>">View</a>
                                    <a href="edit_photo.php?id=<?php echo $all->id?>">Edit</a>
                                    <a href="delete_photo.php?id=<?php echo $all->id;?>">Delete</a>
                                </div>
                                </td>
                                <td><?php echo substr($all->photo_filename,0,20) ?></td>
                                <td><?php echo $all->photo_title ?></td>
                                <td><?php echo $all->photo_description ?></td>
                                <td><?php echo $all->photo_type ?></td>
                                <td><?php echo $all->photo_size ?></td>
                                <td><a href="specific_photo.php?id=<?php echo $all->id?>"><?php echo $comments->countCommentsById($all->id) ?></a></td>
                            </tr>
                                 <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>