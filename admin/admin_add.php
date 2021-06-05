<?php 
session_start();
require "../config/config.php";
require "../config/common.php";

if (empty($_SESSION['username']) && empty($_SESSION['user_id'])) {
  header("location: login.php");
}



if ($_POST) {
	if (empty($_POST['name']) || empty($_POST['name'])) {

		if (empty($_POST['name'])) {
			$nameError = "Username Shouldn't be empty!!";
		}
    if (empty($_POST['pwd'])) {
      $pwdError = "Password Shouldn't be empty!!";
    }

	}elseif((!empty($_POST['pwd']) && strlen($_POST['pwd']) < 4) || (!empty($_POST['name']) && strlen($_POST['name']) < 4)) {
    if ((!empty($_POST['pwd']) && strlen($_POST['pwd']) < 4)) {
      $pwdError = "Password should be at least 4 character!!";
    }
    if ((!empty($_POST['name']) && strlen($_POST['name']) < 4)) {
      $nameError = "Username should be at least 4 character!!";
    }
		

	} else {
    $name = $_POST['name'];
    $password =password_hash($_POST['pwd'], PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO admin SET username='$name', password='$password'");
    $result = $stmt->execute();
    if ($result) {
      echo "<script>alert('Successfully Added!!');location.href='admins_list.php'</script>";
    }
	}
}




?>

<?php include('header.php') ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container">
            <h1>Admin Add</h1>
            <form action="" method="POST" class="" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
	            <div class="form-outline mb-4">
	                <label for="name">Username<p style="color:red"><?php echo empty($nameError) ? '' : '*'.$nameError; ?></p></label>
	                <input type="text" name="name" id="form1Example1" class="form-control"  value="" />
	            </div>
	            <div class="form-group">
	                <label for="password">Password<p style="color:red"><?php echo empty($pwdError) ? '' : '*'.$pwdError; ?></p></label>
	              	<input type="password" name="pwd" class="form-control" value="">
	            </div>
	            <div class="form-outline mb-4">
	                <input type="submit" class="btn btn-primary" value="Add" />
	            </div>
              
            </form>
      </div>
    </section>
    <!-- /.content -->
  </div>
<?php include('footer.html') ?>