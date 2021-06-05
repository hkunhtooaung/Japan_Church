<?php 
session_start();
require "../config/config.php";

if (empty($_SESSION['username']) && empty($_SESSION['user_id'])) {
  header("location: login.php");
}


if ($_POST) {
  if (empty($_POST['title']) || empty($_POST['description']) || empty($_POST['vlink'])) {
    if (empty($_POST['title'])) {
      $titleError = "Title should not be empty!!";
    }
    if (empty($_POST['description'])) {
      $descriptionError = "description should not be empty!!";
    }
     if (empty($_POST['vlink'])) {
      $vlinkError = "Video link should not be empty!!";
    } 

  } else {
    if (!empty($_FILES['image']['name'])) {
      $title = $_POST['title'];
      $description = $_POST['description'];
      $vlink = $_POST['vlink'];
      $image = $_FILES['image']['name'];
      $file = 'videos/'.$_FILES['image']['name'];
      $fileType = pathinfo($file, PATHINFO_EXTENSION);

      if ($fileType != 'png' && $fileType != 'jpg' && $fileType != 'jpeg') {
        echo "<script>alert('Image must be PNG,JPG,JPEG');</script>";
      } else {
        move_uploaded_file($_FILES['image']['tmp_name'], $file);
        $stmt = $pdo->prepare("UPDATE videos set title='$title',description='$description',image='$image',video_link='$vlink' WHERE id=".$_GET['id']);
        $result = $stmt->execute();

        if ($result) {
          echo "<script>alert('Successfully Updated');location.href='index.php';</script>";
        }
      }
    } else {
      $title = $_POST['title'];
      $description = $_POST['description'];
      $vlink = $_POST['vlink'];

      $stmt = $pdo->prepare("UPDATE videos set title='$title',description='$description',video_link='$vlink' WHERE id=".$_GET['id']);
      $result = $stmt->execute();

      if ($result) {
        echo "<script>alert('Successfully Updated');location.href='videos_list.php';</script>";
      }
    }
    //
  }
  
}


$stmt = $pdo->prepare("SELECT * FROM videos WHERE id=".$_GET['id']);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

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
            <h1>Video Edit</h1>
            <form action="" method="POST" class="" enctype="multipart/form-data">
              <div class="form-outline mb-4">
                <label for="title">Title<p style="color:red"><?php echo empty($titleError) ? '' : '*'.$titleError; ?></p></label>
                  <input type="text" name="title" id="form1Example1" class="form-control"  value="<?php echo $result['title'] ?>" />
                </div>
              <div class="form-group">
                <label for="">Description<p style="color:red"><?php echo empty($descriptionError) ? '' : '*'.$descriptionError; ?></p></label>
                <textarea cols="8" name="description" rows="5" class="form-control"><?php echo $result['title']; ?></textarea>
              </div>
              <div class="form-group">
                <label for="">Image</label><br>
                <input type="file" name="image" class=""  style="display: block" />
                <img src="videos/<?php echo $result['image']; ?>" width="200" height="200" class="mt-2">
              </div>
              <div class="form-group">
                <label for="">Video Link<p style="color:red"><?php echo empty($vlink) ? '' : '*'.$vlink; ?></p></label>
               <input type="text" value="<?php echo $result['video_link'] ?>" name="vlink" class="form-control">
              </div>
              <div class="form-outline mb-4">
                  <input type="submit" class="btn btn-primary" value="Edit" />
                </div>
              
            </form>
      </div>
    </section>
    <!-- /.content -->
  </div>
<?php include('footer.html') ?>