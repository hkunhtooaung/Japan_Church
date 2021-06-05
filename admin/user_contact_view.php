<?php 
session_start();
require "../config/config.php";
require "../config/common.php";

if (empty($_SESSION['username']) && empty($_SESSION['user_id'])) {
  header("location: login.php");
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
    <?php 
    	$stmt = $pdo->prepare("SELECT * FROM user_contact WHERE id=".$_GET['id']);
    	$stmt->execute();
    	$result = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>

    <!-- Main content -->
    <section class="content">
      <div class="container">
        <p align="center">Date::<?php echo " ".escape(date('d-M-Y h:i:s',strtotime($result['created_at']))); ?></a>
        <div style="width: 450px; margin: auto;" class="mt-5">
        	<table class="table" align="center">
        	<tr>
        		<th>Name</th>
        		<td><?php echo $result['name']; ?></td>
        	</tr>
        	<tr>
        		<th>Email</th>
        		<td><?php echo $result['email']; ?></td>
        	</tr>
        	<tr>
        		<th>subject</th>
        		<td><?php echo $result['name']; ?></td>
        	</tr>
        	<tr>
        		<th>Description</th>
        		<td><?php echo $result['description']; ?></td>
        	</tr>

        </table>
        </div>
        
      </div>
    </section>
    <!-- /.content -->
  </div>
<?php include('footer.html') ?>