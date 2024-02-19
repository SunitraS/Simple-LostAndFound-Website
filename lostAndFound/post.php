<?php
require('conn.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Lost And Found</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="main.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    .navbar-brand {
      padding-right: 50px;
    }

    .nav-item {
      padding-right: 50px;
    }

    .navbar-nav {
      padding-right: 50px;
    }

    .form-inline {
      padding-top: 8px;
    }
  </style>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">Lost And Found</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="post.php">Post an Item <span class="sr-only">(current)</span></a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container mt-5">
    <h2>Lost Items Form</h2>
    <form action="process_form.php" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="image">Upload Image:</label>
        <input type="file" class="form-control" id="image" name="image" required>
      </div>
      <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name" required>
      </div>
      <div class="form-group">
        <label for="description">Description:</label>
        <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
      </div>
      <div class="form-group">
        <label for="status">Status:</label>
        <input type="text" class="form-control" id="status" name="status" value="Not Received" readonly>
      </div>
      <div class="form-group">
        <label for="type">Item Type:</label>
        <select class="form-control" id="type" name="type" required>
          <!-- Fetch and populate dropdown with ItemTypes from the database -->
          <?php
          require('conn.php');
          $sql = "SELECT * FROM ItemTypes";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo '<option value="' . $row["ID"] . '">' . $row["Name"] . '</option>';
            }
          }
          $conn->close();
          ?>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
      <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>