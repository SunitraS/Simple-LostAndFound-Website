<?php
function getLostItems($selectedCategory = null, $searchTerm = null)
{
    require('conn.php');

    $sql = "SELECT ID, Name, Description, Image FROM LostItems WHERE Status = 'Not Received'";

    if ($selectedCategory) {
        $sql .= " AND TypeID = $selectedCategory";
    }

    if ($searchTerm) {
        $sql .= " AND (Name LIKE '%$searchTerm%' OR Description LIKE '%$searchTerm%')";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    } else {
        return array();
    }
}

$selectedCategory = isset($_GET['category']) ? $_GET['category'] : null;
$searchTerm = isset($_GET['search']) ? $_GET['search'] : null;
$lostItems = getLostItems($selectedCategory, $searchTerm);
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

        .caption p {
            padding-left: 25px;
        }

        .modal-header h4 {
            font-size: 20px;
        }

        .dropdown-menu {
            background-color: black;
        }

        .dropdown-item {
            color: white;
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
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="post.php">Post an Item</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Categories
                    </a>
                    <?php
                    require('conn.php');
                    $sql = "SELECT * FROM ItemTypes";
                    $result = $conn->query($sql);


                    if ($result->num_rows > 0) {
                        echo '<div class="dropdown-menu" aria-labelledby="navbarDropdown">';
                        echo '<a class="dropdown-item" href="javascript:void(0);" onclick="changeCategory(\'all\')">All</a>';

                        while ($row = $result->fetch_assoc()) {
                            echo '<a class="dropdown-item" href="javascript:void(0);" onclick="changeCategory(' . $row['ID'] . ')">' . $row['Name'] . '</a>';
                        }

                        echo '</div>';
                    } else {
                        echo '<div class="dropdown-menu" aria-labelledby="navbarDropdown">';
                        echo '<a class="dropdown-item" href="javascript:void(0);" onclick="changeCategory(\'all\')">All</a>';
                        echo '</div>';
                        echo "No categories found";
                    }
                    ?>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="received.php">Received</a>
                </li>
                <li>
                    <form class="form-inline my-2 my-lg-0 ml-auto" method="GET" action="index.php">
                        <input class="form-control mr-sm-4" type="search" placeholder="Search" aria-label="Search" name="search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>

                </li>
            </ul>
        </div>
    </nav>


    <div class="container">
        <center>
            <h1>Lost And Found</h1>
        </center>
        <div class="row">
            <?php foreach ($lostItems as $item) : ?>
                <div class="col-md-4">
                    <div class="thumbnail">
                        <a href="#" data-toggle="modal" data-target="#myModal<?= $item['ID']; ?>">
                            <img src="<?= $item['Image']; ?>" style="width:100%">
                            <div class="caption">
                                <br>
                                <p><b><?= $item['Name']; ?></b></p>
                                <hr>
                                <p><?= $item['Description']; ?></p>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Modal -->
                <div id="myModal<?= $item['ID']; ?>" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <b>
                                    <h4 class="modal-title"><?= $item['Name']; ?></h4>
                                </b>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <img src="<?= $item['Image']; ?>" alt="<?= $item['Name']; ?>" style="width:100%">
                                <br><br>
                                <hr>
                                <p><?= $item['Description']; ?></p>
                            </div>
                            <div class="modal-footer">
                                <a href="#" class="btn btn-success" onclick="confirmReceived(<?= $item['ID']; ?>)">Confirm Received</a>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>

            <?php endforeach; ?>
        </div>
    </div>

    <script>
        function changeCategory(category) {
            if (category === 'all') {
                window.location.href = "index.php";
            } else {
                window.location.href = "index.php?category=" + category;
            }
        }
    </script>

    <script>
        function confirmReceived(itemId) {
            var isConfirmed = confirm("Are you sure?");

            if (isConfirmed) {
                window.location.href = 'process_confirm_received.php?itemId=' + itemId;
            }
        }
    </script>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>