<?php 
session_start();
require "../config/config.php";
require "../config/common.php";


if (empty($_SESSION['username']) && empty($_SESSION['user_id'])) {
	header("location: login.php");
}

if ($_POST) {
if (empty($_POST['title']) || empty($_POST['description']) || empty($_FILES['image']['name'])) {
	if (empty($_POST['title'])) {
		$titleError = "Title should not be empty!!";
	}
	if (empty($_POST['description'])) {
		$descriptionError = "description should not be empty!!";
	}
    if (empty($_FILES['image']['name'])) {
      $imageError = 'Image is required';
    }
} else {
	
	$title = $_POST['title'];
	$description = $_POST['description'];
	$image = $_FILES['image']['name'];
	$file = 'images/'.($_FILES['image']['name']);
	$fileType = pathinfo($file, PATHINFO_EXTENSION);

		if ($fileType != 'png' && $fileType != 'jpg' && $fileType != 'jpeg') {
			echo "<script>alert('Image must be PNG,JPG,JPEG');</script>";
		} else {

		move_uploaded_file($_FILES['image']['tmp_name'], $file);
		$stmt = $pdo->prepare('INSERT INTO news (title,description,image) VALUES (:title,:description,:image)');
		$result = $stmt->execute(
			[':title'=>$title, ':description'=>$description, ':image'=>$image]
		);

		if ($result) {
			echo "<script>alert('Successfully Created');location.href='index.php';</script>";
		}
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
        <a href="logout.php" class="btn btn-outline-danger" style="float: right; margin: 10px;">Logout</a>
       
		<div>
			
		<h1>CREATE NEW</h1>
			<form action="" method="POST" class="" enctype="multipart/form-data">
				<input name="_token" type="hidden" value="<?php echo $_SESSION['_token']; ?>">
				<div class="form-outline mb-4">
					<label for="">Title</label><p style="color:red"><?php echo empty($titleError) ? '' : '*'.$titleError; ?></p>
					<input type="text" name="title" id="form1Example1" class="form-control" />
					</div>
				<div class="form-group">
					<label for="">Description</label><p style="color:red"><?php echo empty($descriptionError) ? '' : '*'.$descriptionError; ?></p>
					<textarea cols="8" name="description" rows="5" class="form-control"></textarea>
				</div>
				<div class="form-group">
                    <label for="">Image</label><p style="color: red;"><?php echo empty($imageError) ? '' : '*'.$imageError; ?></p>
                    <input type="file" name="image" value="">
                  </div>
				<div class="form-outline mb-4">
					<input type="submit" class="btn btn-primary" />
					</div>
				
			</form>
      	</div>
    </section>
    <!-- /.content -->
  </div>
<?php include('footer.html') ?>