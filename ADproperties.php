<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="create-listing.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js" integrity="sha512-72WD92hLs7T5FAXn3vkNZflWG6pglUDDpm87TeQmfSg8KnrymL2G30R7as4FmTwhgu9H7eSzDCX3mjitSecKnw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" type="text/css"/>
  <script src="https://kit.fontawesome.com/8e985a096f.js" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Abril Fatface' rel='stylesheet'>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Khula">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
  <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css"/>
  <link href="https://cdn.datatables.net/searchpanes/2.1.2/css/searchPanes.bootstrap5.min.css"/>
  <link href="https://cdn.datatables.net/select/1.6.2/css/select.bootstrap5.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" integrity="sha384-8z/cw+N+a0ul3q4EyPe+S/X/Ql8UBpx9fNVYhRGb+xzjSGxsv/xGwzXM1Mk5if6C" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-ZGjKb29brEiZWT8DZAtfKdGAb3qg3IClZH8HvpmXERbBKTsKsBYWwY8ZdjBhE7nRuGxKjW69J8Dv9VRbERJ1LQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="style/createListing.css">
  <link rel="stylesheet" href="style/login.css">
  <link rel="stylesheet" href="style/adStyle.css">
  <link rel="stylesheet" href="style/ADproperties.css">
  <title>Create Listing - Real Estate Portal</title>
</head>
<body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-light p-2 px-3" style="background-color: #ffffff">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">DAS</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                <a class="nav-link mx-2"  href="ADagentDashboard.html">Dashboard</a>
              </li>
              <li class="nav-item">
                <a class="nav-link  active mx-2" aria-current="page" href="ADproperties.html">Properties</a>
              </li>
              <li class="nav-item">
                <a class="nav-link mx-2" href="ADclients.html">Clients</a>
              </li>
              <li class="nav-item">
                <a class="nav-link mx-2" href="#">Logout</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <div class="mx-5 my-2">
        <button class="btn btn-primary create-listing-button">
          Create a new listing
          <i class="fa-solid fa-square-plus fa-xl" style="color: #ffffff;"></i>          
        </button>
      </div>
      <?php
            // Your PHP code to fetch data from the database goes here
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "mini";
            $conn = mysqli_connect($servername,$username,$password,$dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Get the username of the logged-in user from the session variable
            $username = $_SESSION['user']['email'];

            // Modify the SQL query to fetch only those rows where the username matches the logged-in user's username
            $sql = "SELECT id, listing_title, listing_type, listing_address, listing_price, listing_date FROM listing WHERE username='$username'";
            $result = mysqli_query($conn, $sql);

            // Display data in a table
            if(mysqli_num_rows($result) > 0) {
                echo '<div class="table-responsive mx-5 my-2">';
                echo '<table class="table table-striped table-bordered" id="propertyTable">';
                echo '<thead>';
                echo '<tr>';
                echo '<th scope="col" data-orderable="#!">Property ID</th>';
                echo '<th scope="col" data-orderable="true">Property Name</th>';
                echo '<th scope="col" data-orderable="true">Property Type</th>';
                echo '<th scope="col" data-orderable="true">Location</th>';
                echo '<th scope="col" data-orderable="true">Price</th>';
                echo '<th scope="col" data-orderable="true">Date Listed</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                while($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>'.$row['id'].'</td>';
                    echo '<td>'.$row['listing_title'].'</td>';
                    echo '<td>'.$row['listing_type'].'</td>';
                    echo '<td>'.$row['listing_address'].'</td>';
                    echo '<td>'.$row['listing_price'].'</td>';
                    echo '<td>'.$row['listing_date'].'</td>';
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
                echo '</div>';
            } else {
                echo "0 results";
            }

            // Close connection
            mysqli_close($conn);
        ?>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-KTtFQg7VxfNCDHWSuzkXZvbu3rSlxovx+HYLwWV7LpqCtQsVbd21g8ruKmkvn7b9" crossorigin="anonymous"></script>
        <script>
        $(document).ready(function() {
            $('#propertyTable').DataTable();
        });
        </script>
        
</body>      