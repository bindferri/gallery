<?php include("includes/header.php");
$photos = new Photo();
$page = !empty($_GET['page']) ? $_GET['page'] : 1;
$items_per_page = 4;
$allItems = $photos->countData();
$paginate = new Pagination($page,$items_per_page,$allItems);
$allPhotos = $photos->limitPhotos($paginate->offset(),$items_per_page);
?>


        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-12">
                <div class="thumbnails row">
                <?php foreach ($allPhotos as $photo): ?>
                    <div class="col-xs-6 col-md-3">
                        <a href="photo.php?id=<?php echo $photo->id ?>" class="thumbnail">
                            <img src="admin/uploads/<?php echo trim($photo->photo_filename) ?>" alt="">
                        </a>
                    </div>
                <?php endforeach; ?>
                </div>
                <div class="row">
                    <ul class="pager">
                        <?php if ($paginate->has_next()){ ?>
                        <li class='next'><a href="index.php?page=<?php echo $paginate->next(); ?>">Next</a></li>

                        <?php } ?>

                        <?php for ($i = 1; $i <= $paginate->page_total();$i++){
                            if ($i == $paginate->current_page){?>
                                <li class="active"><a href="index.php?page=<?php echo $i ?>"><?php echo $i?></a></li>
                                <?php } else{ ?>
                        <li><a href="index.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                        <?php }} ?>

                        <?php if ($paginate->has_previous()){?>
                        <li class='previous'><a href="index.php?page=<?php $paginate->previous();?>">Previous</a></li>
                        <?php } ?>
                    </ul>
                </div>
          
            </div>

            </div>




            <!-- Blog Sidebar Widgets Column -->
<!--            <div class="col-md-4">-->
<!---->
<!--            -->
<!--                 --><?php //include("includes/sidebar.php"); ?>
<!---->
<!---->
<!---->
<!--        </div>-->
        <!-- /.row -->

        <?php include("includes/footer.php"); ?>
