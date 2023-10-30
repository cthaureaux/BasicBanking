<?php
  include('db_connection.php');
  include('LoginCheck.php');
  include 'admin_navbar.php';
  
  // Check if the form has been submitted
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Check if the delete button has been clicked
    if (isset($_POST['delete_announcement'])) {
      $announcement_id = $_POST['delete_announcement'];
      $stmt = $db->prepare("DELETE FROM announcements WHERE announcementID = ?");
      $stmt->bind_param("i", $announcement_id);
      if ($stmt->execute()) {
        echo "<script>alert('Announcement deleted successfully!');</script>";
      } else {
        echo "<script>alert('Error deleting announcement.');</script>";
      }
    }
    
    // Check if the create button has been clicked
    if (isset($_POST['create_announcement'])) {
      $title = $_POST['title'];
      $description = $_POST['description'];
      
      $stmt = $db -> prepare("INSERT INTO announcements (title, description) VALUES (?, ?)");
      $stmt -> bind_param("ss", $title, $description);
      
      if ($stmt -> execute()) {
        echo "<script>alert('Announcement created successfully!');</script>";
      } else {
        echo "<script>alert('Error creating announcement.');</script>";
      }
    }
  }
?>

<html>
<head>
  <title>Announcements - Manage Announcements</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body class ="bg-light">
  <div class="container mt-4">
    <h1>Manage Announcements</h1>
    
    <h2>Create Announcement</h2>
    
    <form method="POST">
      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" required>
      </div>
      
      <div class="form-group">
        <label for="description">Description</label>
        <i class="far fa-comment"></i>
        <textarea class="form-control" id="description" name="description" rows="5" placeholder = "Enter description here..." required></textarea>
      </div>
      
      <button type="submit" name="create_announcement" class="btn btn-primary">Create Announcement</button>
    </form>
    
    <hr>
    
    <h2>Delete Announcement</h2>
    
    <table class="table table-bordered">
      <thead class = "bg-white">
        <tr>
          <th>Title</th>
          <th>Description <i class="far fa-comment"></i></th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody class = "bg-white">
        <?php
          $sql = "SELECT * FROM announcements";
          $result = $db->query($sql);
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>" . $row['title'] . "</td>";
              echo "<td>" . $row['description'] . "</td>";
              echo "<td>";
              echo "<form method='POST'>";
              echo "<input type='hidden' name='delete_announcement' value='" . $row['announcementID'] . "'>";
              echo "<button type='submit' class='btn btn-danger'>Delete</button>";
              echo "</form>";
              echo "</td>";
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='3'>No announcements found.</td></tr>";
          }
        ?>
      </tbody>
    </table>
      <a href="update_announcement.php" class="btn btn-primary mb-5">Edit Announcements</a><br><br><br>
  </div>
  
</body>
<?php
  include 'footer.html';
?>
</html>