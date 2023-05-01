<?php
session_start();
$search = $_SESSION['search'];
$buyRent = $_SESSION['buyRent'];
$budget = $_SESSION['budget'];

// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'mini');

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Create a SQL query based on user input
$sql = "SELECT * FROM listing WHERE listing_title LIKE '%$search%' AND listing_type = '$buyRent'";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Abril Fatface' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Khula">
    <link rel="stylesheet" href="style/login.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>Document</title>
</head>
<body>
    <!--NAV BAR-->
    <nav class="navbar sticky-top navbar-expand-lg navbar-light p-2 px-3" style="background-color: #ffffff">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">DAS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link mx-3 active" aria-current="page" href="#">HOME</a>
                    <a class="nav-link mx-3" href="#">ABOUT US</a>
                    <a class="nav-link mx-3 "  href="login.html">LOGIN</a>
                </div>
            </div>
        </div>
    </nav>
    <!--BODY-->
    <div class="container my-4">
        <div class="row">
          <div class="col">
            <form>
              <div class="row g-3">
                <div class="col-md-3">
                    <label for="Searchgrp" class="form-label">Search</label> 
                    <div class="input-group" id="Searchgrp">
                        <input type="text" class="form-control" placeholder="" id="Search">
                    </div>
                </div>
                <div class="col-md-3">
                  <label for="property-type" class="form-label">Property Type</label>
                  <select class="form-select" id="property-type">
                    <option selected>Choose...</option>
                    <option value="apartment">Apartment</option>
                    <option value="house">House</option>
                    <option value="villa">Villa</option>
                    <!-- Add more property types here -->
                  </select>
                </div>
                <div class="col-md-3">
                  <label for="property-status" class="form-label">Status</label>
                  <select class="form-select" id="property-status">
                    <option selected>Choose...</option>
                    <option value="buy">Buy</option>
                    <option value="rent">Rent</option>
                  </select>
                </div>
                <div class="col-md-3">
                    <label for="property-status" class="form-label">Budget</label>
                    <select class="form-select" id="property-status">
                      <option selected>Choose...</option>
                      <option value="0">Less than $500</option>
                      <option value="1">$500 - $1000</option>
                      <option value="2">$1000 - $2000</option>
                      <option value="3">2000 - $5000</option>
                      <option value="4">More than $5000</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex">
                    <button type="button" class="btn btn-primary">Search</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    
    <!--CARDS-->
    <div class="container">
    <div class="row">
      <?php
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $imageData = base64_encode($row['listing_image']);
          echo '<div class="col-lg-4 d-flex align-items-stretch">';
          echo '<div class="card">';
          echo '<img src="data:image/jpeg;base64,' . $imageData . '" class="card-img-top" alt="...">';
          echo '<div class="card-body">';
          echo '<h5 class="card-title">' . $row['listing_title'] . '</h5>';
          echo '<p class="card-text">' . $row['listing_description'] . '</p>';
          echo '<a href="#" class="btn btn-primary">View Property</a>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
        }
      } else {
        echo '<div class="col-12"><p>No results found.</p></div>';
      }
      ?>
    </div>
  </div>
  <?php
$conn->close();
?>
</body>
</html>