<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
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

          $sql = "SELECT * FROM newusers WHERE email='$email'";
          $result = mysqli_query($conn, $sql);
          $num = mysqli_num_rows($result); 

          if($num == 1)
          {
            while($row= mysqli_fetch_assoc($result))
            {
              if (password_verify($password, $row['password']))
              {
                $showalert = true;
                $login = true;
    
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $email;
                header("location: welcome.php");

              }
              else 
              {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>Error !!</strong> Invalid Credentials. 
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
      
              }
            }
            

        
          }

          else 
          {
             echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
               <strong>Error !!</strong> Invalid Credentials. 
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>';
   
          }
          
      }

    
    ?>




    <div class="container py-3 col-md-8">

        <div class="container bg-dark">

            <h3 class ="text-center text-white py-2"> Login Here </h3>
        </div>

        <form class ="py-3" action = "/PHP/login system/login.php" method = "POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name= "password">
            </div>
          
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>