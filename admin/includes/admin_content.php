<div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Admin
                            <small>Subheading</small>
                        </h1>
<?php 
// $user = new User();
// $user->username = "Example_username";
// $user->password = "Example_password";
// $user->first_name = "John";
// $user->last_name = "Doe";
// $user->create();

$user = User::find_user_by_id(1);
$user->username = "WILLIAMS";
$user->update();

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