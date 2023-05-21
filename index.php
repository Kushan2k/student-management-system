<?php
if(session_status()!=PHP_SESSION_ACTIVE){
  session_start();
}

?>

<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
          integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>

  <body>

    <div class="container-fluid p-5" style="height: 100vh;background-color: #192145;">
      <div class="row ">
        <div class="col-6 offset-6">
          <a href="./view/register.view.php" class="btn btn-primary btn-lg">
            <i class="fa-solid fa-plus"></i>
            Register New Student
          </a>
        </div>
      </div>
      <?php
      if(isset($_SESSION['error'])){?>
      <div class="container my-2">
        <p class="alert alert-danger text-center"><?=ucfirst($_SESSION['error']) ?></p>
      </div>
      <?php $_SESSION['error'] = null;}
     ?>
      <div class="row mt-5">
        <div class="col-12 col-lg-6 mx-auto">
          <h3 class="display-5 my-2 text-center fw-bold text-white">Certificate Verification</h3>
          <form action="./controllers/GradeController.php" method="post">
            <div class="form-group d-flex flex-row mt-2" style="border-radius: 10px;">
              <input required placeholder="Enter Certificate Number Here" type="text" name="certificate_num"
                     class="form-control border-0" style="border-radius: 10px 0px 0px 10px;">
              <button name="serach" type="submit" class="border-0"
                      style="background-color: lightgray;border-radius: 0px 7px 7px 0px;"><i
                   class="fa-solid fa-magnifying-glass"></i></button>
            </div>
            <div class="mt-4 form-group d-flex justify-content-center">
              <input type="submit" name="serach" value="Verify the certificate" class="btn btn-primary btn-lg">
            </div>
          </form>
        </div>
      </div>
      <div class="box">
        <a href="./view/adminlogin.view.php" target="_self">Admin Login</a>
      </div>
    </div>

    <style>
      .box {
        position: absolute;
        bottom: 10px;
        left: 10px;
      }
    </style>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>


    <script>
      document.addEventListener("DOMContentLoaded", () => {
        clear()
      })

      function clear() {
        setTimeout(() => {
          let error = document.querySelector('.alert')
          if (error) {
            error.remove()
          }
        }, 2000)
      }
    </script>

  </body>


</html>