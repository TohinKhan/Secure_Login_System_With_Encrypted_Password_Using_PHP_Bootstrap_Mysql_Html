<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SignUp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
    <?php
    
    require "partials/navbar.php";
    include "dbconnection.php";

    $showalert = false;

    if ( $_SERVER["REQUEST_METHOD"] == "POST")
    {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $cpassword = $_POST["cpassword"];
        //$exists = false; 

        $existSql = "SELECT * FROM `newusers` where email = '$email' ";
        $result = mysqli_query($conn, $existSql);
        $numExistRows = mysqli_num_rows($result);

        if ($numExistRows >0)
        {
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>You Have Already An Account !!</strong> Please SignUp With A New E-Mail. 
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        else
        {

          if ($password == $cpassword)
          {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `newusers` (`email`, `password`) VALUES ('$email', '$hash') ";
            $result = mysqli_query($conn, $sql);
            
            if($result)
            {
              $showalert = true;
              echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Record Inserted Successfully !!</strong> Now You Can Login. 
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
              
              
            }
            
          }
          else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error !!</strong> Password Does not Match . 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            
          }
        }
    }


    
    ?>




    <div class="container py-3 col-md-8">

        <div class="container bg-dark">

            <h3 class ="text-center text-white py-2"> Sign Up Here </h3>
        </div>

        <form class ="py-3" action = "/PHP/login system/signup.php" method = "POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" maxlength="20" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name= "password">
            </div>

            <div class="mb-3">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name = "cpassword">
            </div>
          
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>