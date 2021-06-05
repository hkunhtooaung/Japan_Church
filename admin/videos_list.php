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

      if (!empty($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
      } else {
        $pageno = 1;
      }

      $numOfrecs = 4;
      $offset = ($pageno - 1) * $numOfrecs;



      if (empty($_POST['search'])) {

        $stmt = $pdo->prepare("SELECT * FROM videos ORDER BY id DESC");
        $stmt->execute();
        $rawresult = $stmt->fetchAll();
        $total_pages = ceil(count($rawresult)/ $numOfrecs);

        $stmt = $pdo->prepare("SELECT * FROM videos ORDER BY id DESC LIMIT $offset,$numOfrecs");
        $stmt->execute();
        $result = $stmt->fetchAll();

      } else {

        $searchKey = $_POST['search'];
        $stmt = $pdo->prepare("SELECT * FROM videos WHERE title LIKE '%$searchKey%' ORDER BY id DESC");
        $stmt->execute();
        $rawresult = $stmt->fetchAll();
        $total_pages = ceil(count($rawresult)/ $numOfrecs);

        $stmt = $pdo->prepare("SELECT * FROM videos WHERE title LIKE '%$searchKey%' ORDER BY id DESC LIMIT $offset,$numOfrecs");
        $stmt->execute();
        $result = $stmt->fetchAll();

      }



      ?>

    <!-- Main content -->
    <section class="content">
      <div class="container">
        <a href="logout.php" class="btn btn-outline-danger" style="float: right; margin: 10px;">Logout</a>
        <a href="video_add.php" class="btn btn-success" style="float: left; margin: 10px;">Create New Video</a>
        <div class="table">
          <table class="table table-bordered">
           
            <tr>
              <th>No</th>
              <th>Title</th>
              <th>Description</th>
              <th>Date</th>
              <th>Action</th>
            </tr>
            <?php 
            $i = 1;
            foreach ($result as $value) { ?>
              <tr>
              <td><?php echo $i; ?></td>
              <td><?php echo escape($value['title']); ?></td>
              <td><?php echo escape(substr($value['description'],0,20)); ?></td>
              <td><?php echo escape(date("y-M-d h:i", strtotime($value['created_at'])))." "; ?><i class="far fa-clock"></i>hours ago</td>


              <td>
                <a href="video_edit.php?id=<?php echo $value['id']; ?>" class="btn btn-primary">Edit</a>
                <a href="video_delete.php?id=<?php echo $value['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure want to delete this item')">Delete</a>
              </td>
            </tr>
            <?php 
            $i++;
            }
            ?>
          </table>

          <!-- Pagination -->
            <div class="row">
                <!--Grid column-->
                <div class="col-lg-12 col-md-12 mb-12">

                    <nav>
                      <ul class="pagination pg-dark d-flex justify-content-center">
                        <li class="page-item active"><a href="?pageno=1" class="page-link">First</a></li>
                        <li class="page-item <?php if($pageno <= 1) { echo "disabled"; } ?>">
                          <a href="<?php if($pageno <= 1) { echo '#';} else { echo "?pageno=".($pageno - 1); } ?>" class="page-link" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                          </a>
                        </li>
                        <li class="page-item <?php if($pageno <= 1) { echo "disabled"; } ?>">
                          <a href="?pageno=<?php echo ($pageno-1); ?>" class="page-link"><?php echo ($pageno - 1); ?></a>
                        </li>
                        <li class="page-item active"><a class="page-link"><?php echo $pageno; ?></a></li>
                        <li class="page-item <?php if($pageno >= $total_pages){echo "disabled"; } ?>">
                          <a href="?pageno=<?php echo $pageno+1; ?>" class="page-link"><?php echo ($pageno + 1); ?></a>
                        </li>
                        <li class="page-item <?php if($pageno >= $total_pages){ echo "disabled"; } ?>">
                          <a href="<?php if($pageno >= $total_pages) { echo '#';} else { echo "?pageno=".($pageno + 1); } ?>" class="page-link" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                          </a>
                        </li>
                        <li class="page-item active"><a href="?pageno=<?php echo $total_pages; ?>" class="page-link">Last</a></li>
                      </ul>
                    </nav>

                </div>
                <!--Grid column-->

                </div>
                <!--End Pagination -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
<?php include('footer.html') ?>