<?php include("includes/header.php"); ?>

<?php 
$photos = Photo::find_all();
?>
        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-12">
                <div class="thumnail row">
                    <?php foreach ($photos as $photo): ?>
                            <div class="col-xs-6 col-md-3">
                                <a href="photo.php?id=<?php echo $photo->id; ?>" class="thumbnail">
                                    <img src="admin/<?php echo $photo->picture_path(); ?>" alt="" class="img-responsive home_page_photo">
                                </a>
                            </div>
                    <?php endforeach; ?>
                </div>
            </div>



        </div>
        <!-- /.row -->

        <?php include("includes/footer.php"); ?>
