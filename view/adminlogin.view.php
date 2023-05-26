<?php
session_start();

if(isset($_SESSION['isadmin']) && $_SESSION['isadmin']==1 ){
  header("Location:./admin.dashboard.php");
}

?>

<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register here</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  </head>

  <body>
    <div class="container-fluid mt-3">
      <div class="row">
        <div class="col-10 mx-auto">
          <a href="<?=$_SERVER['HTTP_REFERER'];?>" class="btn btn-warning btn-sm">Back</a>
        </div>
      </div>
    </div>

    <div class="container-fluid p-5">
      <div class="row">
        <div class="col-10 col-md-6 mx-auto">
          <form action="../controllers/AdminController.php" method="POST">
             <div class="form-group">
              <label for="" class="form-label">Admin Email</label>
              <input type="email" name="email" placeholder="Enter Admin Email" class="form-control">
              <small class="text-muted ">Email Address</small>
            </div>
            <div class="form-group mt-3">
              <label for="" class="form-label">Admin Password</label>
              <input type="password" name="password" placeholder="Enter Admin Password" class="form-control">
              <small class="text-muted ">Unique admin password</small>
            </div>
           
            <div class="form-group mt-4">
              <input type="submit" value="Login" name="admin-login" class="btn btn-success">
            </div>
          </form>
        </div>
      </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
  </body>

</html>