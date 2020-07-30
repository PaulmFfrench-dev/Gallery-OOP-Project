<?php include("includes/header.php"); ?>

<?php if(!$session->is_signed_in()) { redirect("login.php"); } ?>
<?php 

if(empty($_GET['id'])) {
    redirect("users.php");
}else{
    $user = User::find_by_id($_GET['id']);

    if(isset($_POST['update'])) {
        if($user) {
            $user->username = $_POST['username'];
            $user->first_name = $_POST['first_name'];
            $user->last_name = $_POST['last_name'];
            $user->description = $_POST['description'];
        
            $user->save();
        }
    }
}
//$users= user::find_all();


?>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            
<?php include("includes/top_nav.php")?>


            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<?php include("includes/side_nav.php")?>     
            <!-- /.navbar-collapse -->
        </nav>




        <div id="page-wrapper">
        <div class="container-fluid">

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            users
            <small>Subheading</small>
        </h1>
        <form action="" method="post">
            <div class="col-md-8">
                <div class="form-group">
                    <input type="text" name="username" class="form-control" value="<?php echo $user->username; ?>">
                </div>
                <div class="form-group">
                    <a class="thumbnail" href="#"><img src="<?php echo $user->image_path_and_placeholder(); ?>" alt=""></a>
                </div>
                <div class="form-group">
                    <label for="caption">Caption</label>
                    <input type="text" name="first_name" class="form-control" value="<?php echo $user->first_name; ?>">
                </div>
                <div class="form-group">
                    <label for="caption">Alternate Text</label>
                    <input type="text" name="last_name" class="form-control" value="<?php echo $user->last_name; ?>">
                </div>
                <div class="form-group">
                    <label for="caption">Description</label>
                    <textarea class="form-control" name="description" id="" cols="30" rows="10"><?php //echo $user->description; ?></textarea>
                </div>
            </div>
            <div class="col-md-4" >
            <div  class="user-info-box">
                <div class="info-box-header">
                <h4>Save <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>
                </div>
                <div class="inside">
                    <div class="box-inner">
                        <p class="text">
                        <span class="glyphicon glyphicon-calendar"></span> Uploaded on: April 22, 2030 @ 5:26
                        </p>
                        <p class="text ">
                            user Id: <span class="data user_id_box">34</span>
                        </p>
                        <p class="text">
                            Filename: <span class="data">image.jpg</span>
                        </p>
                        <p class="text">
                        File Type: <span class="data">JPG</span>
                        </p>
                        <p class="text">
                        File Size: <span class="data">3245345</span>
                        </p>
                    </div>
                    <div class="info-box-footer clearfix">
                        <div class="info-box-delete pull-left">
                            <a  href="delete_user.php?id=<?php echo $user->id; ?>" class="btn btn-danger btn-lg ">Delete</a>   
                        </div>
                        <div class="info-box-update pull-right ">
                            <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg ">
                        </div>   
                    </div>
                </div>          
            </div>
        </form>
    </div>
</div>
<!-- /.row -->

</div>

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>