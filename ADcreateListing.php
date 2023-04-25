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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.2/Chart.min.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Abril Fatface' rel='stylesheet'>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Khula">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style/createListing.css">
  <link rel="stylesheet" href="style/login.css">
  <link rel="stylesheet" href="style/adStyle.css">
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

<main class="container">
    <h1 class="text-center my-5">Create a New Listing</h1>
    <form method="POST" enctype="multipart/form-data">
        <div class="row mb-3">
            <?php
            if(isset($_POST['submit']))
            {
                $listing_title = $_POST["listingTitle"];
                $listing_description = $_POST["listingDescription"];
                $listing_price = $_POST["listingPrice"];
                $listing_address = $_POST["listingAddress"];
                $listing_city = $_POST["listingCity"];
                $listing_state = $_POST["listingState"];
                $listing_zipcode = $_POST["listingZipcode"];
                $listing_type = $_POST['inlineRadioOptions'];
                $listing_date = $_POST['date'];
            
                // Get the uploaded file information
                $listing_imgname = $_FILES['listingImage']['name'];
                $fileTmpName = $_FILES['listingImage']['tmp_name'];
                $listing_imgsize = $_FILES['listingImage']['size'];
                $listing_imgtype = $_FILES['listingImage']['type'];
            
                // Open the file for reading
                $fileHandle = fopen($fileTmpName, 'r');
                $listing_image = fread($fileHandle, $listing_imgsize);
                fclose($fileHandle);
            
                //Connnect to the database
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "mini";
                $conn = mysqli_connect($servername,$username,$password,$dbname);
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }
            
                // Prepare the SQL statement with placeholders for values
                $sql = "INSERT INTO listings (listing_title, listing_description, listing_price, listing_address, listing_city, listing_state, listing_zipcode, listing_image, listing_imgname, listing_imgsize, listing_imgtype, listing_type, listing_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
                // Create a prepared statement object
                $stmt = mysqli_prepare($conn, $sql);
            
                // Bind parameters to the statement
                mysqli_stmt_bind_param($stmt, "sssssssssisss", $listing_title, $listing_description, $listing_price, $listing_address, $listing_city, $listing_state, $listing_zipcode, $listing_image, $listing_imgname, $listing_imgsize, $listing_imgtype, $listing_type, $listing_date);
            
                // Execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    echo "<script>alert('Data Inserted');</script>";
                }else{
                  echo "<script>alert('Error in inserting data: " . mysqli_error($conn) . "');</script>";
                }
            
                // Close the statement and database connection
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
            }            
            ?>
            <label for="listingTitle" class="col-sm-2 col-form-label">Listing Title</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="listingTitle" name="listingTitle" required minlength="5" maxlength="50">
              <span id="titleError" style="color: red; display: none;">Title should be between 5 and 50 characters</span>
            </div>
          </div>
          <div class="row mb-3">
            <label for="listingDescription" class="col-sm-2 col-form-label">Listing Description</label>
            <div class="col-sm-10">
              <textarea class="form-control" id="listingDescription" name="listingDescription" required minlength="10" maxlength="500"></textarea>
              <span id="descriptionError" style="color: red; display: none;">Description should be between 10 and 500 characters</span>
            </div>
          </div>
          <div class="row mb-3">
            <label for="listingPrice" class="col-sm-2 col-form-label">Price</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="listingPrice" name = "listingPrice" required min="1" max="10000">
              <span id="priceError" style="color: red; display: none;">Price should be between 1 and 10,000</span>
            </div>
          </div>
          <div class="row mb-3">
            <label for="listingAddress" class="col-sm-2 col-form-label">Address</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="listingAddress" name = "listingAddress" required>
              <span id="addressError" style="color: red; display: none;">Please enter a valid address</span>
            </div>
          </div>
          <div class="row mb-3">
            <label for="listingCity" class="col-sm-2 col-form-label">City</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="listingCity" name="listingCity"  required>
              <span id="cityError" style="color: red; display: none;">Please enter a valid city</span>
            </div>
          </div>
          <div class="row mb-3">
            <label for="listingState" class="col-sm-2 col-form-label">State</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="listingState" name="listingState" required minlength="2" maxlength="20">
              <span id="stateError" style="color: red; display: none;">State should be a valid two-letter abbreviation</span>
            </div>
          </div>
          <div class="row mb-3">
            <label for="listingZipcode" class="col-sm-2 col-form-label">Zipcode</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="listingZipcode" name="listingZipcode" required pattern="[0-9]{5}">
              <span id="zipcodeError" style="color: red; display: none;">Please enter a valid 5-digit zipcode</span>
            </div>
          </div>
          <div class="d-none">
            <input type="date" name="date" id="date" >
          </div>

          <script>
            // Get the form element
            const form = document.querySelector('form');
          
            // Get the input fields
            const titleInput = document.getElementById('listingTitle');
            const descriptionInput = document.getElementById('listingDescription');
            const priceInput = document.getElementById('listingPrice');
            const addressInput = document.getElementById('listingAddress');
            const cityInput = document.getElementById('listingCity');
            const stateInput = document.getElementById('listingState');
            const zipcodeInput = document.getElementById('listingZipcode');
          
            // Add event listeners to the input fields
            titleInput.addEventListener('input', validateTitle);
            descriptionInput.addEventListener('input', validateDescription);
            priceInput.addEventListener('input', validatePrice);
            addressInput.addEventListener('input', validateAddress);
            cityInput.addEventListener('input', validateCity);
            stateInput.addEventListener('input', validateState);
            zipcodeInput.addEventListener('input', validateZipcode);
          
            // Define the validation functions
            function validateTitle() {
              const titleValue = titleInput.value.trim();
              if (titleValue === '') {
                titleInput.setCustomValidity('Please enter a title.');
              } else {
                titleInput.setCustomValidity('');
              }
            }
          
            function validateDescription() {
              const descriptionValue = descriptionInput.value.trim();
              if (descriptionValue === '') {
                descriptionInput.setCustomValidity('Please enter a description.');
              } else {
                descriptionInput.setCustomValidity('');
              }
            }
          
            function validatePrice() {
              const priceValue = priceInput.value.trim();
              if (priceValue === '') {
                priceInput.setCustomValidity('Please enter a price.');
              } else if (!(/^\d+(\.\d{1,2})?$/.test(priceValue))) {
                priceInput.setCustomValidity('Please enter a valid price.');
              } else {
                priceInput.setCustomValidity('');
              }
            }
          
            function validateAddress() {
              const addressValue = addressInput.value.trim();
              if (addressValue === '') {
                addressInput.setCustomValidity('Please enter an address.');
              } else {
                addressInput.setCustomValidity('');
              }
            }
          
            function validateCity() {
              const cityValue = cityInput.value.trim();
              if (cityValue === '') {
                cityInput.setCustomValidity('Please enter a city.');
              } else {
                cityInput.setCustomValidity('');
              }
            }
          
            function validateState() {
              const stateValue = stateInput.value.trim();
              if (stateValue === '') {
                stateInput.setCustomValidity('Please enter a state.');
              } else {
                stateInput.setCustomValidity('');
              }
            }
          
            function validateZipcode() {
              const zipcodeValue = zipcodeInput.value.trim();
              if (zipcodeValue === '') {
                zipcodeInput.setCustomValidity('Please enter a zipcode.');
              } else if (!(/^\d{5}$/.test(zipcodeValue))) {
                zipcodeInput.setCustomValidity('Please enter a valid 5-digit zipcode.');
              } else {
                zipcodeInput.setCustomValidity('');
              }
            }
          
            // Add submit event listener to the form
            form.addEventListener('submit', (event) => {
              // Validate all input fields
              validateTitle();
              validateDescription();
              validatePrice();
              validateAddress();
              validateCity();
              validateState();
              validateZipcode();
              
          
              // Check if any input field is invalid
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
          
              form.classList.add('was-validated');
            });
          </script>
          
        <div class="row mb-3">
            <label for="listingImage" class="col-sm-2 col-form-label">Listing Image</label>
            <div class="col-sm-10">
              <input type="file" class="form-control" id="listingImage" name="listingImage" multiple accept="image/*" onchange="validateImageSize()">
              <span id="imageSizeError" style="color: red; display: none;">Image size should be less than 2MB</span>
            </div>
          </div>
          
          <script>
          function validateImageSize() {
            const maxSizeInBytes = 2 * 1024 * 1024; // 2MB
            const fileList = document.getElementById('listingImage').files;
            const fileSize = fileList[0].size;
            if (fileSize > maxSizeInBytes) {
              document.getElementById('imageSizeError').style.display = 'block';
              document.getElementById('listingImage').value = ''; // clear the file input field
            } else {
              document.getElementById('imageSizeError').style.display = 'none';
            }
          }

          </script>

          <script>
              // Get the current date and format it as YYYY-MM-DD
              var today = new Date();
              var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
              
              // Set the value of the hidden input field to the current date
              document.getElementById("date").value = date;
           </script>





          
        <div class="row mb-3">
                <label class="col-sm-2" for="gridCheck">
                    Listing Type
                </label>
                <div class="col-sm-10">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radBuy" value="Sale">
                        <label class="form-check-label" for="inlineRadio1">Sale</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radAgent" value="Rent">
                        <label class="form-check-label" for="inlineRadio2">Rent</label>
                    </div>
              </div>
        </div>
          
        <div class="row mb-3">
          <div class="col-sm-10 offset-sm-2">
            <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </form>
</main>
</body>      