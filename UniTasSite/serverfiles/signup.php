<?php

$showAlert = false;
$showError = false;
$exists = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){

  //Include database connection file.
  include 'dbconnect.php';

  $firstname = $_POST["firstname"];
  $lastname = $_POST["lastname"];
  $email = $_POST["email"];
  $mobile = $_POST["mobile"];
  $pass = $_POST["pass"];
  $cpass = $_POST["cpass"];
  $address = $_POST["address"];
  $city = $_POST["inputCity"];

  $sql = "Select * from userhost where Email='$email'";
  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);

  //The above sql query is used to ensure a user is unique
  //This is done so by checking for the email in the database

  if($num == 0){
    if(($pass == $cpass) && $exists == false) {
      //password hashing
      $hash = password_hash($password, PASSWORD_DEFAULT);

      $sql = "INSERT INTO `userhost` ( `Firstname`, `Lastname`, `Email`, `Mobilenumber`, `Password`, `Address`, `City`) VALUES ('$firstname', '$lastname', '$email', '$mobile', '$hash', '$address', '$city')";
      $result = mysqli_query($conn, $sql);

      if($result){
        $showAlert = true;
      }
    }else {
      $showError = "Password fields do not match";
    }

      
    }

    if($num>0){
      $exists="An existing user is already using the provided email address";
    }


  }

?>






<!DOCTYPE html>
<html lang="en">
<head>
  <title>UniTas Accomodation Sign Up</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="./css/signup.css">


</head>
<body>
  <!--Signup page navigation-->
  <div class="container-fluid">
    <ul class="nav justify-content-center" id="navrego">
      <li class="nav-item">
        <a class="nav-link" href="index.html">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="signup.html">Sign Up</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="houselist.html">Listing</a>
      </li>
      <!-- Dropdown -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
          Admin
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="hostdashdemo.html">Host Dashboard</a>
          <a class="dropdown-item" href="admindashdemo.html">Admin Dashboard</a>
        </div>
      </li>
    </ul>
</div>
<?php
    
    if($showAlert) {
    
        echo ' <div class="alert alert-success 
            alert-dismissible fade show" role="alert">
    
            <strong>Success!</strong> Your account is 
            now created and you can login. 
            <button type="button" class="close"
                data-dismiss="alert" aria-label="Close"> 
                <span aria-hidden="true">×</span> 
            </button> 
        </div> '; 
    }
    
    if($showError) {
    
        echo ' <div class="alert alert-danger 
            alert-dismissible fade show" role="alert"> 
        <strong>Error!</strong> '. $showError.'
    
       <button type="button" class="close" 
            data-dismiss="alert aria-label="Close">
            <span aria-hidden="true">×</span> 
       </button> 
     </div> '; 
   }
        
    if($exists) {
        echo ' <div class="alert alert-danger 
            alert-dismissible fade show" role="alert">
    
        <strong>Error!</strong> '. $exists.'
        <button type="button" class="close" 
            data-dismiss="alert" aria-label="Close"> 
            <span aria-hidden="true">×</span> 
        </button>
       </div> '; 
     }
   
?>
<div class="pagetitle">
    <div class="container-fluid">
        <center><b><h>UTAS Accomodation Registration</h></b></center>
    </div>
  </div>
  <div class="institle">
    <div class="container-fluid">
        <center><b><h>Create an Account</h></b></center>
    </div>
  </div>

  <!--Form to capture user information with relevant built in bootstrap validation-->
  <div class="container-fluid">
      <form class="needs-validation" id="mainform" action="signup.php" method="post">

        <div class = "form-row">
          <div class = "form-group col-sm-12">
            <label for="inputUserType">Are you registering as a client or a host?</label>
            <select id="inputUserType" class="form-control">
              <option>Client</option>
              <option>Host</option>
            </select>
          </div>
        </div>
          <div class = "form-row">
            <div class="form-group col-sm-6">
              <label for="firstname">First Name</label>
              <input type="text" class="form-control" id="firstname" placeholder="Enter your first name" name="fnameinput" required>
              <div class="valid-feedback">Valid.</div>
              <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group col-sm-6">
              <label for="lastname">Last Name</label>
              <input type="text" class="form-control" id="lastname" placeholder="Enter your last name" name="lnameinput" required>
              <div class="valid-feedback">Valid.</div>
              <div class="invalid-feedback">Please fill out this field.</div>
            </div>
          </div>
          <div class = "form-row">
            <div class="form-group col-sm-6">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" placeholder="Enter your email" name="emailinput" required>
              <div class="valid-feedback">Valid.</div>
              <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group col-sm-6">
              <label for="mobile">Mobile Number</label>
              <input type="text" class="form-control" id="mobile" placeholder="Enter your mobile number" name="mobileinput" required>
              <div class="valid-feedback">Valid.</div>
              <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class = "form-group col-sm-12">
              <div class="confidentialityconfirmation">
                <p>We will never disclose your personal information........</p>
              </div>
            </div>
          </div>
          <div class = "form-row">
            <div class="form-group col-sm-6">
              <label for="pass">Password</label>
              <input type="password" class="form-control" id="pass" placeholder="Enter your password" name="passinput" required>
              <div class="valid-feedback">Valid.</div>
              <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group col-sm-6">
              <label for="cpass">Confirm Password</label>
              <input type="password" class="form-control" id="cpass" placeholder="Re-enter your password" name="cpassinput" required>
              <div class="valid-feedback">Valid.</div>
              <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class = "form-group col-sm-12">
              <div class="passwordstrength">
                <p>The password needs to be 6 to 12 characters long and must contain 1 lower case letter, 1 number and a special character</p>
              </div>
            </div>
          </div>
          <div class = "form-row">
            <div class="form-group col-sm-6">
              <label for="address">Address</label>
              <input type="text" class="form-control" id="address" placeholder="Enter your address" name="addressinput" required>
              <div class="valid-feedback">Valid.</div>
              <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group col-sm-6">
              <label for="inputCity">City</label>
                <select id="inputCity" class="form-control" required>
                  <option selected>None</option>
                  <option>Hobart</option>
                  <option>Burnie</option>
                  <option>Launceston</option>
                </select>
            </div>
          </div>
          <div class = "clientAbn" id="abndetails">
              
          </div>
          <div class = "form-row">
            <div class="col-sm-6" id=cancelcol>
              <button type="button" class="btn btn-danger" id="cancel">Cancel</button>
            </div>
            <div class ="col-sm-6" id=submitcol>
              <button type="submit" class="btn btn-primary" id="submitbtn">Submit</button>
            </div>
          </div>
        </form>
    </div>
 
  <!--JS script to add ABN input row if user selects Host from the user type selection dropdown-->
  <script type="text/javascript">
   document.addEventListener('input', function (event) {
    var elem = document.getElementById('abndetails')
      // Only run on our select menu
      if (event.target.id !== 'inputUserType') return;

      // The selected value

      if (event.target.value === 'Host'){
        elem.innerHTML = '<div class = "form-row"><div class="form-group col-sm-12"><label for="abn">ABN</label><input type="text" class="form-control" id="abn" placeholder="Enter your ABN" name="abninput" required></div></div>'
      }

      else{
        elem.innerHTML = ''
      }
      }, false);
  </script>
  <script type="text/javascript">
      

  </script>

</body>
</html>