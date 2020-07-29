<div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Admin
                            <small>Subheading</small>
                        </h1>
<?php 
$user = new User();
$user->username = "Student";
$user->password = "password";
$user->first_name = "Testfirstname";
$user->last_name = "Testlastname";
$user->create();

// $user = User::find_user_by_id(15);
// $user->username = "DW50";
// $user->password = "password";
// $user->first_name = "David";
// $user->last_name = "Williams";
// $user->update();

// $user = User::find_user_by_id(5);
// $user->delete();

// $user = User::find_user_by_id(4);
// $user->username = "WHATEVER";
// $user->save();

// $user = new User();
// $user->username = "password";
// $user->save();
?>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

</div>